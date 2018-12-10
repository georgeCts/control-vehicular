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

    <div class="col-md-8 padding-20">
        <div class="panel panel-warning">
            <div class="panel-heading">
                <h4 class="text-white">MODIFICAR GASTO DE VEH&Iacute;CULO ({{ $objGastoAdicional->vehiculo->vehiculo_nombre }})</h4>
            </div>

            <div class="panel-body">
                {!! Form::open(['route' => 'update-gasto-adicional', 'method' => 'PUT' , 'id' => 'gastoAdicionalForm']) !!}
                    <input type="hidden" name="hddPkGastoAdicional" value="{{$objGastoAdicional->pk_gasto_adicional}}" />
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
                            <input id="txtConcepto" name="txtConcepto" type="text" class="form-control" value="{{$objGastoAdicional->concepto}}" required />
                        </div>

                        <div class="col-md-3">
                            <label for="txtReferencia">Referencia</label>
                            <input id="txtReferencia" name="txtReferencia" type="text" class="form-control" value="{{$objGastoAdicional->referencia}}" />
                        </div>

                        <div class="col-md-3">
                            <label for="txtImporte">Monto *</label>
                            <div class="input-group">
                                <span class="input-group-addon">$</span>
                                <input id="txtImporte" name="txtImporte" type="text" class="form-control" value="{{$objGastoAdicional->importe}}" required />
                            </div>
                        </div>
                    </div>
                    
                    <div class="row form-group">
                        <div class="col-md-4">
                            <label for="cmbVehiculo">Veh&iacute;culo *</label>
                            <select id="cmbVehiculo" name="cmbVehiculo" class="form-control">
                                <option value="0">Selecciona el veh&iacute;culo</option>
                                @foreach($lstVehiculos as $itemVehiculo)
                                    @if($itemVehiculo->pk_vehiculo == $objGastoAdicional->pk_vehiculo)
                                        <option value="{{ $itemVehiculo->pk_vehiculo }}" selected>{{ $itemVehiculo->vehiculo_nombre }}</option>
                                    @else
                                        <option value="{{ $itemVehiculo->pk_vehiculo }}">{{ $itemVehiculo->vehiculo_nombre }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="cmbOperador">Operador</label>
                            <select id="cmbOperador" name="cmbOperador" class="form-control">
                                <option value="0">Ninguno</option>
                                @foreach($lstOperadores as $itemOperador)
                                    @if($itemOperador->pk_operador == $objGastoAdicional->pk_operador)
                                        <option value="{{ $itemOperador->pk_operador }}" selected>{{ $itemOperador->nombre }}</option>
                                    @else
                                        <option value="{{ $itemOperador->pk_operador }}">{{ $itemOperador->nombre }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="cmbProveedor">Proveedor</label>
                            <select id="cmbProveedor" name="cmbProveedor" class="form-control">
                                <option value="0">Ninguno</option>
                                @foreach($lstProveedores as $itemProveedor)
                                    @if($itemProveedor->pk_proveedor)
                                        <option value="{{ $itemProveedor->pk_proveedor }}" selected>{{ $itemProveedor->nombre_comercial }}</option>
                                    @else
                                        <option value="{{ $itemProveedor->pk_proveedor }}">{{ $itemProveedor->nombre_comercial }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-4">
                            <label for="txtComentarios">Comentarios</label>
                            <textarea class="form-control" id="txtComentarios" name="txtComentarios">{{$objGastoAdicional->comentarios}}</textarea>
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

    <div class="col-md-4 padding-20">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h4 class="text-white">ADJUNTAR DOCUMENTO</h4>
            </div>
            <div class="panel-body">
                <div id="load-doc-msg"></div>
                <div id="doc-loaded">   
                    @if($objGastoAdicional->url_documento != null)
                        <p>Este gasto tiene un documento anexo que puedes consultar a continuaci&oacute;n:</p>
                        <a href="{{ Storage::disk('s3')->url($objGastoAdicional->url_documento) }}" class="btn btn-sm btn-primary waves-effect waves-light" target="_blank">Ver Documento</a>
                    @else
                        <div class="alert alert-warning">
                            <strong>No hay documento anexo</strong>
                        </div>
                    @endif
                </div>
                <hr />

                <div class="form-group">
                    <form id="docGastoForm">
                        <p>Puedes anexar un nuevo documento o manipular uno existente mediante las siguientes opciones:</p>
                        <input type="file" name="documento" id="documento" required />
                        <br />

                        <div class="form-group">
                            <button type="submit" class="btn btn-danger" onclick="subirDocGastoAdicional({{$objGastoAdicional->pk_gasto_adicional}}, '{{csrf_token()}}')"> Cargar</button>
                            @if($objGastoAdicional->url_documento != null)
                                <a href="javascript:void(0)" class="btn btn-sm btn-warning waves-effect waves-light" onClick="confAccion('/panel/vehiculos/eliminar_doc_gasto/{{$objGastoAdicional->pk_gasto_adicional}}', '/panel/vehiculos/editar_gasto/{{$objGastoAdicional->pk_gasto_adicional}}', 'El documento será eliminado')">
                                    <i class="fa fa-trash"></i> Eliminar
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/plugins/bootstrap-material-datetimepicker.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function(){

            $('#txtFecha').bootstrapMaterialDatePicker({ format: 'DD/MM/YYYY', weekStart : 0, time: false});
            var date =  '{{$objGastoAdicional->fecha}}';
            var arrDate = date.split("-");
            $('#txtFecha').bootstrapMaterialDatePicker('setDate', arrDate[2] + "/" + arrDate[1] + "/" + arrDate[0]);

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