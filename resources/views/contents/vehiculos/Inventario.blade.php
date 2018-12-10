@section('title', 'Vehiculos')

@section('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/plugins/datatables.bootstrap.min.css') }}"/>
@endsection

@section('panel')
    <h3 class="animated fadeInLeft">
        <span class="fa-truck fa"></span> Vehículos  
        <a href="/panel/vehiculos/registrar" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Registrar</a>
    </h3>
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
                <h4>INVENTARIO</h4>
            </div>

            <div class="panel-body">
                <div class="responsive-table">
                    <table id="dtInventario" class="table table-striped" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-left">Veh&iacute;culo</th>
                                <th class="text-center">Uso</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Tipo</th>
                                <th class="text-center">Grupo</th>
                                <th class="text-center">Acci&oacute;n</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($lstVehiculos as $itemVehiculo)
                                <tr>
                                    <td class="text-center">{{ $itemVehiculo->pk_vehiculo }}</td>
                                    <td class="text-left">
                                        <a href="/panel/vehiculos/perfil_veh/{{ $itemVehiculo->pk_vehiculo}}">{{ $itemVehiculo->vehiculo_nombre }}</a>
                                    </td>
                                    <td class="text-center">{{ $itemVehiculo->vehiculoUltimoOdometro->latest('creacion_fecha')->first()->odometro }} Km</td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <button id="status_{{$itemVehiculo->pk_vehiculo}}" type="button" class="btn btn-sm btn-{{$itemVehiculo->vehiculoStatus->clase_nombre}} dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                {{ $itemVehiculo->vehiculoStatus->vehiculo_status }}
                                                <span class="fa fa-angle-down"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                @foreach($lstStatus as $itemStatus)
                                                    <li><a href="javascript:void(0);" onclick="cambioStatus('/panel/vehiculos/cambio_status/', {{$itemVehiculo->pk_vehiculo}}, {{$itemStatus->pk_vehiculo_status}});"> {{ $itemStatus->vehiculo_status }}</a></li>
                                                @endforeach
                                            </ul>
                                        </div>                                        
                                    </td>
                                    <td class="text-center">{{ $itemVehiculo->vehiculoTipo->vehiculo_tipo }}</td>
                                    <td class="text-center">{{ (($itemVehiculo->pk_vehiculo_grupo != null)?$itemVehiculo->vehiculoGrupo->vehiculo_grupo:'-') }}</td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="fa fa-cog"></span>
                                                <span class="fa fa-angle-down"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a href="#"><i class="fa fa-print"></i> Imprimir Ficha</a></li>
                                                <li><a href="/panel/vehiculos/editar/{{ $itemVehiculo->pk_vehiculo }}"><i class="fa fa-pencil"></i> Editar</a></li>
                                                <li><a href="/panel/vehiculos/inspecciones/{{ $itemVehiculo->pk_vehiculo }}"><i class="fa fa-check"></i> Inspecciones</a></li>
                                                <li><a href="#"><i class="fa fa-tint"></i> Cargar Combustible</a></li>
                                                <li><a href="#"><i class="fa fa-archive"></i> Archivar</a></li>
                                                <li><a href="#"><i class="fa fa-trash"></i> Eliminar</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-left">Veh&iacute;culo</th>
                                <th class="text-center">Uso</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Tipo</th>
                                <th class="text-center">Grupo</th>
                                <th class="text-center">Acci&oacute;n</th>
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
        $('#dtInventario').DataTable();
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