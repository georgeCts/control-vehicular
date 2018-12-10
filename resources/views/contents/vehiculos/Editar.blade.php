@section('title', 'Vehículos')

@section('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/plugins/bootstrap-material-datetimepicker.css') }}"/>
@endsection

@section('panel')
    <h3 class="animated fadeInLeft">
        <span class="fa-truck fa"></span> Veh&iacute;culos  
        <a href="/panel/vehiculos" class="btn btn-dark pull-right"><i class="fa fa-table"></i> Inventario</a>
    </h3>
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
                <h4 class="text-white">MODIFICAR VEH&Iacute;CULO</h4>
            </div>

            <div class="panel-body">
                {!! Form::open(['route' => 'update-vehiculo', 'method' => 'put' , 'id' => 'vehiculoForm']) !!}
                    <input type="hidden" value="{{$objVehiculo->pk_vehiculo}}" name="pk_vehiculo" />

                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <legend>INFORMACIÓN B&Aacute;SICA</legend>   
                            
                            <div class="row form-group">
                                <div class="col-md-12">
                                    <label for="txtNombreVehiculo">Nombre del veh&iacute;culo *</label>
                                    <input id="txtNombreVehiculo" name="txtNombreVehiculo" type="text" class="form-control" placeholder="Ej. Civic Rojo, Jetta02, etc." value="{{$objVehiculo->vehiculo_nombre}}" required>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md-12">
                                    <label for="txtVehiculoMarca">Marca *</label>
                                    <input id="txtVehiculoMarca" name="txtVehiculoMarca" type="text" class="form-control" placeholder="Ej. Honda, VW, etc." value="{{$objVehiculo->vehiculo_marca}}" required>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md-12">
                                    <label for="txtVehiculoModelo">Modelo *</label>
                                    <input id="txtVehiculoModelo" name="txtVehiculoModelo" type="text" class="form-control" placeholder="Ej. Civic EX, Jetta, etc." value="{{$objVehiculo->vehiculo_modelo}}" required />
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md-12">
                                    <label for="txtVehiculoAno">A&ntilde;o *</label>
                                    <input id="txtVehiculoAno" name="txtVehiculoAno" type="text" class="form-control" value="{{$objVehiculo->vehiculo_ano}}" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6">
                            <legend>CONFIGURACI&Oacute;N</legend>

                            <div class="row form-group">
                                <div class="col-md-12">
                                    <label for="cmbTipoVehiculo">Tipo de Veh&iacute;culo</label>
                                    <select name="cmbTipoVehiculo" class="form-control">                                        
                                        @foreach($lstVehiculosTipos as $itemTipo)
                                            @if($objVehiculo->pk_vehiculo_tipo == $itemTipo->pk_vehiculo_tipo)
                                                <option value="{{ $itemTipo->pk_vehiculo_tipo }}" selected>{{ $itemTipo->vehiculo_tipo }}</option>
                                            @else
                                                <option value="{{ $itemTipo->pk_vehiculo_tipo }}">{{ $itemTipo->vehiculo_tipo }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>                        

                            <div class="row form-group">
                                <div class="col-md-6">
                                    <label for="cmbMedidaUso">Medida de Uso</label>
                                    <select name="cmbMedidaUso" class="form-control">
                                        @foreach($lstVehiculoMedidasUso as $itemUso)
                                            @if($objVehiculo->pk_vehiculo_medida_uso == $itemUso->pk_vehiculo_medida_uso)
                                                <option value="{{ $itemUso->pk_vehiculo_medida_uso }}" selected>{{ $itemUso->vehiculo_medida_uso }}</option>
                                            @else
                                                <option value="{{ $itemUso->pk_vehiculo_medida_uso }}">{{ $itemUso->vehiculo_medida_uso }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
        
                                <div class="col-md-6">
                                    <label for="cmbMedidaCombustible">Medida de Combustible</label>
                                    <select name="cmbMedidaCombustible" class="form-control">
                                        @foreach($lstVehiculoMedidasCombustible as $itemCombustible)
                                            @if($objVehiculo->pk_vehiculo_medida_combustible == $itemCombustible->pk_vehiculo_medida_combustible)
                                                <option value="{{ $itemCombustible->pk_vehiculo_medida_combustible }}" selected>{{ $itemCombustible->vehiculo_medida_combustible }}</option>
                                            @else
                                                <option value="{{ $itemCombustible->pk_vehiculo_medida_combustible }}">{{ $itemCombustible->vehiculo_medida_combustible }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>                                        

                    <div class="row">
                        <div class="col-md-12">
                            <legend>INFORMACI&Oacute;N ADICIONAL</legend>

                            <div class="row">                            
                                <div class="col-md-6 col-sm-6">
                                    <div class="row form-group">
                                        <div class="col-md-12">
                                            <label for="cmbGrupo">Grupo</label>
                                            <select name="cmbGrupo" class="form-control">
                                                <option value="0">- Por Seleccionar -</option>
                                                @foreach($lstVehiculosGrupos as $itemGrupo)
                                                    @if($objVehiculo->pk_vehiculo_grupo == $itemGrupo->pk_vehiculo_grupo)
                                                        <option value="{{ $itemGrupo->pk_vehiculo_grupo }}" selected>{{ $itemGrupo->vehiculo_grupo }}</option>
                                                    @else
                                                        <option value="{{ $itemGrupo->pk_vehiculo_grupo }}">{{ $itemGrupo->vehiculo_grupo }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col-md-12">
                                            <label for="txtNumeroSerie">N&uacute;mero de Serie</label>
                                            <input type="text" id="txtNumeroSerie" name="txtNumeroSerie" class="form-control" value="{{$objVehiculo->vehiculo_numero_serie}}" />
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col-md-12">
                                            <label for="txtLicenciaPlaca">Licencia o Placa</label>
                                            <input type="text" id="txtLicenciaPlaca" name="txtLicenciaPlaca" class="form-control" value="{{$objVehiculo->vehiculo_placa}}" />
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col-md-12">
                                            <label for="txtColor">Color</label>
                                            <input type="text" id="txtColor" name="txtColor" class="form-control" value="{{$objVehiculo->vehiculo_color}}" />
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-6">
                                    <div class="row form-group">
                                        <div class="col-md-12">
                                            <label for="txtCompaniaSeguro">Compa&ntilde;ia de Seguros</label>
                                            <input type="text" id="txtCompaniaSeguro" name="txtCompaniaSeguro" class="form-control" value="{{$objVehiculo->vehiculo_seguro}}" />
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col-md-12">
                                            <label for="txtPolizaSeguro">P&oacute;liza de Seguro</label>
                                            <input type="text" id="txtPolizaSeguro" name="txtPolizaSeguro" class="form-control" value="{{$objVehiculo->vehiculo_poliza}}" />
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col-md-12">
                                            <label for="txtVigenciaPoliza">Vigencia P&oacute;liza</label>
                                            <div class="input-group">
                                                <input id="txtVigenciaPoliza" name="txtVigenciaPoliza" type="text" class="form-control" data-vigencia_poliza="{{$objVehiculo->vehiculo_poliza_vigencia}}" />
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                
                    </div>

                    <div class="form-group">
                        <input class="submit btn btn-primary" type="submit" value="Guardar">
                        <a href="/panel/vehiculos" role="button" class="btn btn-default">Cancelar</a>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/plugins/bootstrap-material-datetimepicker.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function(){

            $('#txtVigenciaPoliza').bootstrapMaterialDatePicker({ format: 'DD/MM/YYYY', weekStart : 0, time: false});
            
            if($('#txtVigenciaPoliza').data('vigencia_poliza') != "") {
                var date = $('#txtVigenciaPoliza').data('vigencia_poliza');
                var arrDate = date.split("-");
                $('#txtVigenciaPoliza').bootstrapMaterialDatePicker('setDate', arrDate[2] + "/" + arrDate[1] + "/" + arrDate[0]);
            }

            $("#vehiculoForm").validate({
                errorElement: "em",
                errorPlacement: function(error, element) {
                    $(element).addClass("danger");
                    error.appendTo(element.parent("div"));
                },
                success: function(label) {
                    $(label.parent("div").children("input")).removeClass("danger");
                },
                rules: {
                    txtNombreVehiculo: {required: true},
                    txtVehiculoMarca: {required: true},
                    txtVehiculoAno: {
                        required: true,
                        digits: true
                    },
                    txtVehiculoModelo: {required: true}
                },
                messages: {
                    txtNombreVehiculo: {required:"Por favor ingresa un nombre del vehículo"},
                    txtVehiculoMarca: {required:"Por favor ingresa una marca de vehículo"},
                    txtVehiculoAno: {
                        required: "Por favor ingresa un año del modelo del vehículo",
                        digits: "Este campo acepta únicamente digitos"
                    },
                    txtVehiculoModelo: {required: "Por favor ingresa un modelo del vehículo"}
                }
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