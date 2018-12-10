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
                <i class="fa-folder-open fa"></i> {{$objCredito->vehiculo->vehiculo_nombre}}
            </span>
        </h5>
    </div>

    <div class="col-md-6 text-right m-t-20">
        <a href="/panel/vehiculos/perfil_veh/{{$objCredito->pk_vehiculo}}" class="btn btn-dark"><i class="fa fa-book"></i> Ficha Veh&iacute;culo</a>
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
            <div class="panel-body">
                <div class="panel-heading">
                    <h4 class="text-white">DETALLES DE CR&Eacute;DITO</h4>
                </div>

                <div class="panel-body">
                    {!! Form::open(['route' => 'update-vehiculo-credito', 'method' => 'put' , 'id' => 'creditoForm']) !!}
                        <input type="hidden" name="hddPkVehiculo" value="{{$objCredito->pk_vehiculo}}" />

                        <div class="row form-group">
                            <div class="col-md-6">
                                <label for="txt">Periodo Cr&eacute;dito</label>
                                <div class="input-group">
                                    <input id="txtFechaPeriodo" name="txtFechaInicial" type="text" class="form-control" data-fecha_inicial="{{$objCredito->fecha_inicial}}" />
                                    <span class="input-group-addon"> - </span>
                                    <input id="txtFechaPeriodo2" name="txtFechaFinal" type="text" class="form-control" data-fecha_final="{{$objCredito->fecha_final}}" />
                                </div>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-3">
                                <label for="txtPagoMensual">Pago Mensual</label>
                                <input type="text" id="txtPagoMensual" name="txtPagoMensual" class="form-control" value="{{$objCredito->pago_mensual}}" />
                            </div>

                            <div class="col-md-3">
                                <label for="txtMontoFinanciado">Monto Financiado</label>
                                <input type="text" id="txtMontoFinanciado" name="txtMontoFinanciado" class="form-control" value="{{$objCredito->monto_financiado}}" />
                            </div>

                            <div class="col-md-3">
                                <label for="txtTasaInteres">Tasa de Inter&eacute;s</label>
                                <input type="text" id="txtTasaInteres" name="txtTasaInteres" class="form-control" value="{{$objCredito->tasa_interes}}" />
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-3">
                                <label for="txtValorResidual">Valor Residual</label>
                                <input type="text" id="txtValorResidual" name="txtValorResidual" class="form-control" value="{{$objCredito->valor_residual}}" />
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-4">
                                <label for="txtInstitucion">Institución Financiera</label>
                                <input type="text" id="txtInstitucion" name="txtInstitucion" class="form-control" value="{{$objCredito->institucion_financiera}}" />
                            </div>

                            <div class="col-md-4">
                                <label for="txtNumeroCuenta">No. de Cuenta</label>
                                <input type="text" id="txtNumeroCuenta" name="txtNumeroCuenta" class="form-control" value="{{$objCredito->numero_cuenta}}" />
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-4">
                                <label for="txtNotas">Notas</label>
                                <textarea id="txtNotas" name="txtNotas" class="form-control">{{$objCredito->notas}}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <input class="submit btn btn-primary" type="submit" value="Guardar">
                            <a href="/panel/vehiculos/perfil_veh/{{$objCredito->pk_vehiculo}}" role="button" class="btn btn-default">Cancelar</a>
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
        //FECHA INICIAL
        $('#txtFechaPeriodo').bootstrapMaterialDatePicker({ format: 'DD/MM/YYYY', weekStart : 0, time: false});
        if($('#txtFechaPeriodo').data('fecha_inicial') != "") {
            var date = $('#txtFechaPeriodo').data('fecha_inicial');
            var arrDate = date.split("-");
            $('#txtFechaPeriodo').bootstrapMaterialDatePicker('setDate', arrDate[2] + "/" + arrDate[1] + "/" + arrDate[0]);
        }

        //FECHA FINAL
        $('#txtFechaPeriodo2').bootstrapMaterialDatePicker({ format: 'DD/MM/YYYY', weekStart : 0, time: false});
        if($('#txtFechaPeriodo2').data('fecha_final') != "") {
            var date = $('#txtFechaPeriodo2').data('fecha_final');
            var arrDate = date.split("-");
            $('#txtFechaPeriodo2').bootstrapMaterialDatePicker('setDate', arrDate[2] + "/" + arrDate[1] + "/" + arrDate[0]);
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