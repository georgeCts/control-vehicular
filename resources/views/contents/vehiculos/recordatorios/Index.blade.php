@section('title', 'Recordatorios')

@section('panel')
    <div class="col-md-6">
        <h3 class="animated fadeInLeft">
            <span class="fa-truck fa"></span> Vehículos              
        </h3>
        <h5 style="margin-left: 15px;">
            <span clas="text-muted">
                <i class="fa-clock-o fa"></i> Recordatorios
            </span>
        </h5>
    </div>
    
    <div class="col-md-6 text-right m-t-20">
        <a href="/panel/vehiculos/agregar_recordatorio" class="btn btn-primary"><i class="fa fa-plus"></i> Agregar Recordatorio</a>
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
                <h4>LISTADO DE RECORDATORIOS</h4>
            </div>

            <div class="panel-body">
                <div class="responsive-table">
                    <table id="dtRecordatorios" class="table table-striped" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">ID</th>                                
                                <th class="text-left">Veh&iacute;culo</th>
                                <th class="text-left">Nombre</th>
                                <th class="text-left">Descripci&oacute;n</th>
                                <th class="text-left">Fechas</th>
                                <th class="text-center">Notificaciones</th>
                                <th class="text-center">Creado por:</th>
                                <th class="text-center">Acci&oacute;nes</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($lstRecordatorios as $item)
                                <tr>
                                    <td class="text-center">{{ $item->pk_recordatorio }}</td>
                                    <td class="text-left">
                                        <a href="/panel/vehiculos/perfil_veh/{{$item->vehiculo->pk_vehiculo}}">{{ $item->vehiculo->vehiculo_nombre  }}</a>
                                    </td>
                                    <td class="text-left">{{ $item->nombre}}</td>
                                    <td class="text-left">{{ $item->descripcion}}</td>
                                    <td class="text-left">
                                        <small>Recordatorio: <strong>{{$item->fecha_notificacion}}</strong></small>
                                        <br />
                                        <small>Vencimiento: <strong>{{$item->fecha_vencimiento}}</strong></small>
                                    </td>
                                    <td class="text-center">
                                        @if(sizeof($item->notificados) > 0)
                                            <span class="badge badge-success ttip" data-toggle="tooltip" data-placement="bottom"
                                                @php
                                                    $html = 'title="';
                                                    foreach($item->notificados as $notificado) {
                                                        $html .= $notificado->usuario->correo.'&#010;';
                                                    }
                                                    $html .= '"';

                                                    echo $html;
                                                @endphp>{{sizeof($item->notificados)}}</span> usuario(s)
                                        @else
                                            <span class="badge badge-danger">0</span> usuario(s)
                                        @endif
                                    </td>                                  
                                    <td class="text-center">{{$item->creacionUsuario->nombre}} {{ $item->creacionUsuario->apellido_paterno}}</td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="fa fa-cog"></span>
                                                <span class="fa fa-angle-down"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                            <li><a href="/panel/vehiculos/editar_recordatorio/{{$item->pk_recordatorio}}"><i class="fa fa-pencil"></i> Editar</a></li>
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
                                <th class="text-left">Nombre</th>
                                <th class="text-left">Descripci&oacute;n</th>
                                <th class="text-left">Fechas</th>
                                <th class="text-center">Notificaciones</th>
                                <th class="text-center">Creado por:</th>
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
        $('#dtRecordatorios').DataTable();
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