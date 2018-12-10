@section('title', 'Inspecciones')

@section('panel')
    <div class="col-md-6">
        <h3 class="animated fadeInLeft">
            <span class="fa-truck fa"></span> Vehículos              
        </h3>
        <h5 style="margin-left: 15px;">
            <span clas="text-muted">
                <i class="fa-check fa"></i> Inspecciones
            </span>
        </h5>
    </div>

    <div class="col-md-6 text-right m-t-20">
        <a href="/panel/vehiculos/inspecciones/{{$objInspeccion->pk_vehiculo}}" class="btn btn-dark"><i class="fa fa-check"></i> Inspecciones</a>
    </div>
@endsection

@section('content')
    <div class="col-md-6 col-md-offset-3">
    @if(Session::has('error_message'))
        <div class="alert alert-danger col-md-12 col-sm-12  alert-icon alert-dismissible fade in" role="alert">
            <div class="col-md-2 col-sm-2 icon-wrapper text-center">
                <span class="fa fa-check fa-2x"></span></div>
                <div class="col-md-10 col-sm-10">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <p><strong>{{ Session::get('error_title' )}}!</strong> {{ Session::get('error_message' )}}</p>
                </div>
            </div>
        </div>
    @endif
    </div>

    <div class="col-md-8 padding-20">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h4 class="text-white">IMAGENES DE INSPECCI&Oacute;N</h4>
            </div>

            <div class="panel-body">
                <div id="dvImagenes" class="row">
                    @foreach($lstFicheros as $item)
                        <div class="col-md-6">
                            <a href="{{ Storage::disk('s3')->url($item->url_imagen) }}" target="_blank">
                                <img height="250px" class="img-thumbnail img-fluid" src="{{ Storage::disk('s3')->url($item->url_imagen) }}" />
                            </a>
                            <button class="btn btn-danger" onclick="confAccion('/panel/vehiculos/eliminar_foto_ins/{{$item->pk_vehiculo_inspeccion_fichero}}', '/panel/vehiculos/inspecciones/subir_fotos/{{$item->pk_vehiculo_inspeccion}}', 'La imagen será eliminada')">Eliminar</button>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 padding-20">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h4 class="text-white">ADJUNTAR FOTOGRAFÍA</h4>
            </div>

            <div class="panel-body">
                <form id="inspeccionPhotoForm">
                    <div class="row form-group">
                        <div id="load-photo-msg"></div>
                    </div>
                    <div class="form-group">
                        <input type="file" name="image" id="image" accept="image/*" required />
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-danger" onclick="subirFotoIns({{$objInspeccion->pk_vehiculo_inspeccion}}, '{{csrf_token()}}')"> Subir Imagen</button>
                        {{--<a href="javascript:void(0)" onclick="confAccion('/panel/vehiculos/eliminar_foto_inc/{{$objIncidente->pk_incidente}}', '/panel/vehiculos/editar_inc/{{$objIncidente->pk_incidente}}', 'La imagen será eliminada')" class="btn btn-warning"><i class="fa fa-trash"></i> Eliminar</a>--}}
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function(){

        });
    </script>
@endsection

{{-- INICIO DECLARACIONES OBLIGATORIAS --}}

@include('components.LeftSideMenu')
@include('components.LeftSideMenuMobile')
@include('components.Header')
@include('components.Scripts')
@include('components.Panel')
@include('components.Stylesheets')
@include('components.Favicon')

@extends('components.Main')