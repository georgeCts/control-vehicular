@section('title', 'Operadores')

@section('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/plugins/bootstrap-material-datetimepicker.css') }}"/>
@endsection

@section('panel')
    <div class="col-md-6">
        <h3 class="animated fadeInLeft">
            <span class="fa-truck fa"></span> Vehículos              
        </h3>
        <h5 style="margin-left: 15px;">
            <span clas="text-muted">
                <i class="fa-money fa"></i> Gastos Adicionales
            </span>
        </h5>
    </div>

    <div class="col-md-6 text-right m-t-20">
        <a href="/panel/vehiculos/gastos" class="btn btn-primary"><i class="fa fa-money"></i> Bit&aacute;cora de Gastos</a>
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
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h4 class="text-white">REGISTRAR GASTO DE VEH&Iacute;CULO</h4>
            </div>

            <div class="panel-body">
                {!! Form::open(['route' => 'new-gasto-adicional', 'method' => 'post' , 'id' => 'gastoAdicionalForm']) !!}
                    <div class="row form-group">
                        <div class="col-md-4">
                            <label for="txtFecha">Fecha *</label>
                            <div class="input-group">
                                <input id="txtFecha" name="txtFecha" type="text" class="form-control" required />
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            </div>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-6">
                            <label for="txtConcepto">Concepto *</label>
                            <input id="txtConcepto" name="txtConcepto" type="text" class="form-control" required />
                        </div>

                        <div class="col-md-3">
                            <label for="txtReferencia">Referencia</label>
                            <input id="txtReferencia" name="txtReferencia" type="text" class="form-control" />
                        </div>

                        <div class="col-md-3">
                            <label for="txtImporte">Monto *</label>
                            <div class="input-group">
                                <span class="input-group-addon">$</span>
                                <input id="txtImporte" name="txtImporte" type="text" class="form-control" required />
                            </div>
                        </div>
                    </div>
                    
                    <div class="row form-group">
                        <div class="col-md-4">
                            <label for="cmbVehiculo">Veh&iacute;culo *</label>
                            <select id="cmbVehiculo" name="cmbVehiculo" class="form-control">
                                <option value="0">Selecciona el veh&iacute;culo</option>
                                @foreach($lstVehiculos as $itemVehiculo)
                                    <option value="{{ $itemVehiculo->pk_vehiculo }}">{{ $itemVehiculo->vehiculo_nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="cmbOperador">Operador</label>
                            <select id="cmbOperador" name="cmbOperador" class="form-control">
                                <option value="0">Ninguno</option>
                                @foreach($lstOperadores as $itemOperador)
                                    <option value="{{ $itemOperador->pk_operador }}">{{ $itemOperador->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="cmbProveedor">Proveedor</label>
                            <select id="cmbProveedor" name="cmbProveedor" class="form-control">
                                <option value="0">Ninguno</option>
                                @foreach($lstProveedores as $itemProveedor)
                                    <option value="{{ $itemProveedor->pk_proveedor }}">{{ $itemProveedor->nombre_comercial }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-4">
                            <label for="txtComentarios">Comentarios</label>
                            <textarea class="form-control" id="txtComentarios" name="txtComentarios"></textarea>
                        </div>
                    </div>


                    <div class="form-group">
                        <input class="submit btn btn-primary" type="submit" value="Guardar">
                        <a href="/panel/vehiculos/gastos" role="button" class="btn btn-default">Cancelar</a>
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

            $('#txtFecha').bootstrapMaterialDatePicker({ format: 'DD/MM/YYYY', weekStart : 0, time: false});

            $("#gastoAdicionalForm").validate({
                errorElement: "em",
                errorPlacement: function(error, element) {
                    $(element).addClass("danger");
                    error.appendTo(element.parent("div"));
                },
                success: function(label) {
                    $(label.parent("div").children("input")).removeClass("danger");
                },
                rules: {
                    txtConcepto: {
                        required: true,
                        minlength: 4
                    },
                    txtImporte: {
                        minlength: 1,
                        number: true
                    }
                },
                messages: {
                    txtConcepto: {
                        required:"Por favor ingresa el concepto",
                        minlength: "El concepto debe ser mayor a 3 caracteres"
                    },
                    txtImporte: {
                        minlength: "El importe debe tener al menos un números.",
                        number: "Este campo acepta únicamente números"
                    }
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