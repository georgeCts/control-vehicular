@section('title', 'Incidentes')

@section('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/plugins/bootstrap-material-datetimepicker.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/plugins/select2.min.css') }}"/>
@endsection

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

    <div class="col-md-6 text-right m-t-20"></div>
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
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h4 class="text-white">REGISTRAR RECORDATORIO</h4>
            </div>

            <div class="panel-body">
                {!! Form::open(['route' => 'new-recordatorio', 'method' => 'POST' , 'id' => 'recordatorioForm']) !!}
                    <div class="row form-group">
                        <div class="col-md-4">
                            <label for="cmbVehiculo">Veh&iacute;culo *</label>
                            <select id="cmbVehiculo" name="cmbVehiculo" class="form-control" required>
                                <option value="0">Selecciona el veh&iacute;culo</option>
                                @foreach($lstVehiculos as $itemVehiculo)
                                    <option value="{{ $itemVehiculo->pk_vehiculo }}">{{ $itemVehiculo->vehiculo_nombre }}</option>
                                @endforeach
                            </select>
                        </div>                        
                    </div>

                    <div class="row form-group">
                        <div class="col-md-4">
                            <label for="txtNombre">Nombre</label>
                            <input id="txtNombre" name="txtNombre" type="text" class="form-control" placeholder="Nombra tu recordatorio" required />
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-6">
                            <label for="txtDescripcion"></label>
                            <textarea name="txtDescripcion" id="txtDescripcion" rows="4" class="form-control" placeholder="Describe tu recordatorio" required></textarea>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-3">
                            <label for="txtFecha">Fecha de Vencimiento</label>
                            <div class="input-group">
                                <input id="txtFechaVencimiento" name="txtFechaVencimiento" type="text" class="form-control" required />
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="txtFecha">Fecha de Notificaci&oacute;n</label>
                            <div class="input-group">
                                <input id="txtFechaNotificacion" name="txtFechaNotificacion" type="text" class="form-control" required />
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            </div>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-4">
                            <label for="cmbUsuarios">Usuario(s) a notificar:</label>
                            <select id="cmbUsuarios" name="cmbUsuarios[]" class="form-control select2-multiple" multiple="multiple">
                                @foreach($lstUsuarios as $item)
                                    <option value="{{$item->pk_usuario}}">{{ $item->nombre }} {{ $item->apellido_paterno }}</option>
                                @endforeach
                            </select>
                            <span class="help-block">
                                <small>No olvides seleccionar los usuarios que deseas que sean notificados.</small>
                            </span>
                        </div>
                    </div>


                    <div class="form-group">
                        <input class="submit btn btn-primary" type="submit" value="Guardar" id="submit" />
                        <a href="/panel/vehiculos/recordatorios" role="button" class="btn btn-default">Cancelar</a>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/plugins/bootstrap-material-datetimepicker.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/select2.full.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function(){

            $('#txtFechaNotificacion').bootstrapMaterialDatePicker({ format: 'DD/MM/YYYY', weekStart : 0, time: false});
            $('#txtFechaVencimiento').bootstrapMaterialDatePicker({ format: 'DD/MM/YYYY', weekStart : 0, time: false});

            $('.select2-multiple').select2();

            $('#recordatorioForm').submit(function() {
                $('#submit').addClass('disabled');
            });
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