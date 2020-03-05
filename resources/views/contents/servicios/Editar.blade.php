@section('title', 'Servicios')

@section('panel')
    <div class="col-md-6">
        <h3 class="animated fadeInLeft">
            <span class="fa-wrench fa"></span> Servicios
        </h3>
    </div>

    <div class="col-md-6 text-right m-t-20">
        <a href="/panel/servicios" class="btn btn-primary"><i class="fa fa-table"></i> Catálogo Servicios</a>
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

    <div class="col-md-12 padding-20">
        <div class="panel panel-warning">
            <div class="panel-heading">
                <h4 class="text-white">MODIFICAR SERVICIO</h4>
            </div>

            <div class="panel-body">
                {!! Form::open(['route' => 'update-servicio', 'method' => 'put' , 'id' => 'servicioForm']) !!}
                    <input type="hidden" name="hddPkServicio" value="{{$objServicio->pk_servicio}}" />

                    <div class="row form-group">
                        <div class="col-md-4 col-sm-6">
                            <label for="txtNombre">Nombre</label>
                            <input id="txtNombre" name="txtNombre" type="text" class="form-control" value="{{$objServicio->nombre}}" required />
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-4 col-sm-6">
                            <label for="txtDescripcion">Descripci&oacute;n</label>
                            <textarea name="txtDescripcion" id="txtDescripcion" rows="5" class="form-control">{{$objServicio->descripcion}}</textarea>
                        </div>
                    </div>

                    <div class="rowform-group">
                        <input class="submit btn btn-primary" type="submit" value="Guardar">
                        <a href="/panel/servicios" role="button" class="btn btn-default">Cancelar</a>
                    </div>
                {!! Form::close() !!}
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