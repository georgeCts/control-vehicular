@section('title', 'Vehiculos')

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
                <i class="fa-folder-open fa"></i> {{$objCompra->vehiculo->vehiculo_nombre}}
            </span>
        </h5>
    </div>

    <div class="col-md-6 text-right m-t-20">
        <a href="/panel/vehiculos/perfil_veh/{{$objCompra->pk_vehiculo}}" class="btn btn-dark"><i class="fa fa-book"></i> Ficha Veh&iacute;culo</a>
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

    <div class="col-md-6 padding-20">
        <div class="panel panel-primary">            
            <div class="panel-body">
                <div class="panel-heading">
                    <h4 class="text-white">DETALLES DE COMPRA</h4>
                </div>

                <div class="panel-body">
                    {!! Form::open(['route' => 'update-vehiculo-compra', 'method' => 'put' , 'id' => 'compraForm']) !!}
                        <input type="hidden" name="hddPkVehiculo" value="{{$objCompra->pk_vehiculo}}" />

                        <div class="row form-group">
                            <div class="col-md-6">
                                <label for="txtFechaCompra">Fecha de Compra</label>
                                <div class="input-group">
                                    <input id="txtFechaCompra" name="txtFechaCompra" type="text" class="form-control" data-fecha_compra="{{$objCompra->compra_fecha}}" />
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-6">
                                <label for="txtPrecioCompra">Precio de Compra</label>
                                <input type="text" id="txtPrecioCompra" name="txtPrecioCompra" class="form-control" value="{{$objCompra->compra_precio}}" />
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-6">
                                <label for="cmbProveedor">Proveedor</label>
                                <select name="cmbProveedor" class="form-control">
                                    <option value="0">- Por Seleccionar -</option>
                                    @foreach($lstProveedores as $item)
                                        @if($objCompra->pk_proveedor == $item->pk_proveedor) 
                                            <option value="{{ $item->pk_proveedor }}" selected>{{ $item->nombre_comercial }}</option>
                                        @else
                                            <option value="{{ $item->pk_proveedor }}">{{ $item->nombre_comercial }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-6">
                                <label for="txtOdometroCompra">Od&oacute;metro al Comprar</label>
                                <input type="text" id="txtOdometroCompra" name="txtOdometroCompra" class="form-control" value="{{$objCompra->compra_odometro}}" />
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-6">
                                <label for="txtFechaGarantia">Fecha L&iacute;mite de Garant&iacute;a</label>
                                <div class="input-group">
                                    <input id="txtFechaGarantia" name="txtFechaGarantia" type="text" class="form-control" data-fecha_garantia="{{$objCompra->garantia_limite_fecha}}" />
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-6">
                                <label for="txtOdometroGarantia">L&iacute;mite de Garant&iacute;a por Uso (Km)</label>
                                <input type="text" id="txtOdometroGarantia" name="txtOdometroGarantia" class="form-control" value="{{$objCompra->garantia_limite_odometro}}" />
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-6">
                                <label for="txtNotas">Notas</label>
                                <textarea id="txtNotas" name="txtNotas" class="form-control">{{$objCompra->notas}}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <input class="submit btn btn-primary" type="submit" value="Guardar">
                            <a href="/panel/vehiculos/perfil_veh/{{$objCompra->pk_vehiculo}}" role="button" class="btn btn-default">Cancelar</a>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script src="{{ asset('assets/js/plugins/bootstrap-material-datetimepicker.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        //FECHA DE COMPRA
        $('#txtFechaCompra').bootstrapMaterialDatePicker({ format: 'DD/MM/YYYY', weekStart : 0, time: false});
        if($('#txtFechaCompra').data('fecha_compra') != "") {
            var date = $('#txtFechaCompra').data('fecha_compra');
            var arrDate = date.split("-");
            $('#txtFechaCompra').bootstrapMaterialDatePicker('setDate', arrDate[2] + "/" + arrDate[1] + "/" + arrDate[0]);
        }

        //FECHA LIMITE DE GARANTIA
        $('#txtFechaGarantia').bootstrapMaterialDatePicker({ format: 'DD/MM/YYYY', weekStart : 0, time: false});
        if($('#txtFechaGarantia').data('fecha_garantia') != "") {
            var date = $('#txtFechaGarantia').data('fecha_garantia');
            var arrDate = date.split("-");
            $('#txtFechaGarantia').bootstrapMaterialDatePicker('setDate', arrDate[2] + "/" + arrDate[1] + "/" + arrDate[0]);
        }
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