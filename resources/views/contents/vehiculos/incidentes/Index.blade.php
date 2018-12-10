@section('title', 'Incidentes')

@section('panel')
    <div class="col-md-6">
        <h3 class="animated fadeInLeft">
            <span class="fa-truck fa"></span> Vehículos              
        </h3>
        <h5 style="margin-left: 15px;">
            <span clas="text-muted">
                <i class="fa-bolt fa"></i> Incidentes
            </span>
        </h5>
    </div>
    
    <div class="col-md-6 text-right m-t-20">
        <a href="/panel/vehiculos/reportar_inc" class="btn btn-primary"><i class="fa fa-plus"></i> Reportar Incidente</a>
        <a href="/panel/vehiculos" class="btn btn-dark"><i class="fa fa-table"></i> Inventario</a>
    </div>
@endsection

@section('content')
    <div class="col-md-6 col-md-offset-3">
    @if(Session::has('success_message'))
        <div class="alert alert-success col-md-12 col-sm-12  alert-icon alert-dismissible fade in" role="alert">
            <div class="col-md-2 col-sm-2 icon-wrapper text-center">
                <span class="fa fa-check fa-2x"></span></div>
                <div class="col-md-10 col-sm-10">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <p><strong>{{ Session::get('success_title' )}}!</strong> {{ Session::get('success_message' )}}</p>
                </div>
            </div>
        </div>
    @endif
    </div>

    <div class="col-md-12 padding-20">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>INCIDENTES REPORTADOS</h4>
            </div>

            <div class="panel-body">
                <div class="responsive-table">
                    <table id="dtIncidentes" class="table table-striped" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-left">Fechas</th>
                                <th class="text-center">Veh&iacute;culo</th>
                                <th class="text-left">Incidente</th>
                                <th class="text-center">Reportó</th>
                                <th class="text-left">Estatus</th>
                                <th class="text-center">Imagen</th>
                                <th class="text-center">Acci&oacute;nes</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($lstIncidentes as $item)
                                <tr>
                                    <td class="text-center">{{ $item->pk_incidente }}</td>
                                    <td class="text-left">
                                        <small>Reporte: <strong>{{$item->fecha_reporte}}</strong></small>
                                        <br />
                                        <small>Vencimiento: <strong>{{(($item->fecha_vencimiento != null)?$item->fecha_vencimiento:'N/A')}}</strong></small>
                                    </td>
                                    <td class="text-center">
                                        <a href="/panel/vehiculos/perfil_veh/{{$item->vehiculo->pk_vehiculo}}">{{ $item->vehiculo->vehiculo_nombre  }}</a>
                                    </td>
                                    <td class="text-left">
                                        @if($item->incidenteImportancia->incidente_importancia == 'Baja')
                                            <span class="label label-primary">{{$item->descripcion}}</span>
                                        @elseif($item->incidenteImportancia->incidente_importancia == 'Moderada')
                                            <span class="label label-warning">{{$item->descripcion}}</span>
                                        @else
                                            <span class="label label-danger">{{$item->descripcion}}</span>
                                        @endif                                                                                                                        
                                        <br />
                                        <br />
                                        <span data-toggle="tooltip" data-placement="bottom" class="ttip label label-primary" title="{{$item->descripcion_detallada}}"> Ver detalles </span>
                                        <br />
                                        <small>Odómetro: <strong>{{$item->medicion}}</strong></small>
                                    </td>                                    
                                    <td class="text-center">{{$item->creacionUsuario->nombre}} {{ $item->creacionUsuario->apellido_paterno}}</td>
                                    <td class="text-left">
                                        <span class="label label-{{(($item->estatus != 'PENDIENTE')?'primary':'warning')}}">{{$item->estatus}}</span>
                                        @if($item->fecha_cerrado != null)
                                            <br /><br />
                                            <small>Fecha: <strong>{{$item->fecha_cerrado}}</strong></small>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($item->url_imagen != null)
                                            <a href="{{ Storage::disk('s3')->url($item->url_imagen) }}" target="_blank">
                                                <img class="img-thumbnail img-fluid" src="{{ Storage::disk('s3')->url($item->url_imagen) }}" style="max-width: 150px;" />
                                            </a>
                                        @else
                                            <a href="{{ asset('images/no_imagen.png') }}" target="_blank">
                                                <img class="img-thumbnail img-fluid" src="{{ asset('images/no_imagen.png') }}" style="max-width: 150px;" />
                                            </a>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="fa fa-cog"></span>
                                                <span class="fa fa-angle-down"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                            <li><a href="/panel/vehiculos/editar_inc/{{ $item->pk_incidente }}"><i class="fa fa-pencil"></i> Editar</a></li>
                                            <li><a href="#"><i class="fa fa-thumbs-up"></i> Cerrar</a></li>
                                            <li><a href="#"><i class="fa fa-trash"></i> Eliminar</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-left">Fechas</th>
                                <th class="text-center">Veh&iacute;culo</th>
                                <th class="text-left">Incidente</th>
                                <th class="text-center">Reportó</th>
                                <th class="text-left">Estatus</th>
                                <th class="text-center">Imagen</th>
                                <th class="text-center">Acci&oacute;nes</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script src="{{ asset('assets/js/plugins/jquery.datatables.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/datatables.bootstrap.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#dtIncidentes').DataTable();
        $('.ttip').tooltip();
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