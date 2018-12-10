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
                <i class="fa-bolt fa"></i> Incidentes
            </span>
        </h5>
    </div>

    <div class="col-md-6 text-right m-t-20">
        <a href="/panel/vehiculos/incidentes" class="btn btn-dark"><i class="fa fa-bolt"></i> Incidentes</a>
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
                <h4 class="text-white">MODIFICAR INCIDENTE</h4>
            </div>

            <div class="panel-body">
                {!! Form::open(['route' => 'update-incidente', 'method' => 'PUT' , 'id' => 'incidenteForm']) !!}
                    <input type="hidden" name="hddPkIncidente" value="{{$objIncidente->pk_incidente}}" />

                    <div class="row form-group">
                        <div class="col-md-4">
                            <label for="cmbVehiculo">Veh&iacute;culo *</label>
                            <select id="cmbVehiculo" name="cmbVehiculo" class="form-control" required>
                                @foreach($lstVehiculos as $item)
                                    @if($item->pk_vehiculo == $objIncidente->pk_vehiculo)
                                        <option value="{{ $item->pk_vehiculo }}" selected>{{ $item->vehiculo_nombre }}</option>
                                    @else
                                        <option value="{{ $item->pk_vehiculo }}" selected>{{ $item->vehiculo_nombre }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>                        
                    </div>

                    <div class="row form-group">
                        <div class="col-md-3">
                            <label for="txtFecha">Fecha de Reporte</label>
                            <div class="input-group">
                                <input id="txtFecha" name="txtFecha" type="text" class="form-control" required />
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="txtDescripcion">Descripci&oacute;n Corta</label>
                            <input id="txtDescripcion" name="txtDescripcion" type="text" class="form-control" placeholder="Ej. Falla luz freno" value="{{$objIncidente->descripcion}}" required />
                        </div>

                        <div class="col-md-3">
                            <label for="cmbImportancia">Importancia</label>
                            <select id="cmbImportancia" name="cmbImportancia" class="form-control">
                                @foreach($lstImportancia as $item)
                                    @if($item->pk_incidente_importancia == $objIncidente->pk_incidente_importancia)
                                        <option value="{{ $item->pk_incidente_importancia }}" selected>{{ $item->incidente_importancia }}</option>
                                    @else
                                    <option value="{{ $item->pk_incidente_importancia }}">{{ $item->incidente_importancia }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="row form-group">
                        <div class="col-md-6">
                            <label for="txtDetallada">Descripci&oacute;n Detallada</label>
                            <textarea class="form-control" id="txtDetallada" name="txtDetallada" rows="5">{{$objIncidente->descripcion_detallada}}</textarea>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-5">
                            <label for="txtMedicion">Medici&oacute;n al momento (Km, Horas) (Opcional)</label>
                            <input type="text" name="txtMedicion" id="txtMedicion" placeholder="Ej. 12300" value="{{$objIncidente->medicion}}" />
                        </div>

                        <div class="col-md-4">
                            <label for="txtFechaVencimiento">Fecha de Vencimiento (Opcional)</label>
                            <div class="input-group">
                                <input id="txtFechaVencimiento" name="txtFechaVencimiento" type="text" class="form-control" />
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <input class="submit btn btn-primary" type="submit" value="Guardar">
                        <a href="/panel/vehiculos/incidentes" role="button" class="btn btn-default">Cancelar</a>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

    <div class="col-md-4 padding-20">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h4 class="text-white">ADJUNTAR FOTOGRAFÍA</h4>
            </div>

            <div class="panel-body">
                <form id="incidentePhotoForm">
                    <div class="row form-group">
                        <div id="load-photo-msg"></div>                    
                        <div id="photo-loaded">
                            @if($objGastoFichero != null)
                                <a href="{{ Storage::disk('s3')->url($objIncidente->url_imagen) }}" target="_blank">
                                    <img class="img-thumbnail img-fluid" src="{{ Storage::disk('s3')->url($objIncidente->url_imagen) }}" />
                                </a>
                            @else                            
                                <a href="{{ asset('images/no_imagen.png') }}" target="_blank">
                                    <img class="img-thumbnail img-fluid" src="{{ asset('images/no_imagen.png') }}" />
                                </a>
                            @endif
                        </div>
                    </div>
                    <hr />
                    <div class="form-group">
                        <input type="file" name="image" id="image" accept="image/*" required />
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-danger" onclick="subirFotoInc({{$objIncidente->pk_incidente}}, '{{csrf_token()}}')"> Cambiar Imagen</button>
                        <a href="javascript:void(0)" onclick="confAccion('/panel/vehiculos/eliminar_foto_inc/{{$objIncidente->pk_incidente}}', '/panel/vehiculos/editar_inc/{{$objIncidente->pk_incidente}}', 'La imagen será eliminada')" class="btn btn-warning"><i class="fa fa-trash"></i> Eliminar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/plugins/bootstrap-material-datetimepicker.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/select2.full.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function(){

            //FECHA DE REPORTE
            $('#txtFecha').bootstrapMaterialDatePicker({ format: 'DD/MM/YYYY', weekStart : 0, time: false});
            var dateReporte =  '{{ $objIncidente->fecha_reporte }}';
            var arrDateReporte = dateReporte.split("-");
            $('#txtFecha').bootstrapMaterialDatePicker('setDate', arrDateReporte[2] + "/" + arrDateReporte[1] + "/" + arrDateReporte[0]);
            
            //FECHA VENCIMIENTO
            $('#txtFechaVencimiento').bootstrapMaterialDatePicker({ format: 'DD/MM/YYYY', weekStart : 0, time: false});
            var dateVencimiento =  '{{ $objIncidente->fecha_vencimiento }}';
            if(dateVencimiento != "") {
                var arrDateVencimiento = dateVencimiento.split("-");
                $('#txtFechaVencimiento').bootstrapMaterialDatePicker('setDate', arrDateVencimiento[2] + "/" + arrDateVencimiento[1] + "/" + arrDateVencimiento[0]);
            }


            $("#incidenteForm").validate({
                errorElement: "em",
                errorPlacement: function(error, element) {
                    $(element).addClass("danger");
                    error.appendTo(element.parent("div"));
                },
                success: function(label) {
                    $(label.parent("div").children("input")).removeClass("danger");
                },
                rules: {
                    txtMedicion: {
                        minlength: 1,
                        number: true
                    }
                },
                messages: {
                    txtMedicion: {
                        minlength: "El importe debe tener al menos un número.",
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