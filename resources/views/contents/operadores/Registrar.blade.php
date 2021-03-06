@section('title', 'Operadores')

@section('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/plugins/bootstrap-material-datetimepicker.css') }}"/>
@endsection

@section('panel')
    <h3 class="animated fadeInLeft">
        <span class="fa-drivers-license fa"></span> Operadores  
        <a href="/panel/proveedores" class="btn btn-dark pull-right"><i class="fa fa-building"></i> Operadores</a>
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
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h4 class="text-white">REGISTRAR OPERADOR</h4>
            </div>

            <div class="panel-body">
                {!! Form::open(['route' => 'new-operador', 'method' => 'post' , 'id' => 'operadorForm', 'files' => true]) !!}
                    <legend>INFORMACIÓN GENERAL</legend>
                    <div class="row form-group">
                        <div class="col-md-4">
                            <label for="txtNombre">Nombre Completo</label>
                            <input id="txtNombre" name="txtNombre" type="text" class="form-control" required>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-4">
                            <label for="txtTelefono">Tel&eacute;fono</label>
                            <input id="txtTelefono" name="txtTelefono" type="text" class="form-control">
                        </div>
                    </div>
                    
                    <div class="row form-group">
                        <div class="col-md-4">
                            <label for="txtDomicilio">Domicilio</label>
                            <input id="txtDomicilio" name="txtDomicilio" type="text" class="form-control">
                        </div>
                    </div>

                    <legend>DATOS DE LICENCIA</legend>

                    <div class="row form-group">
                        <div class="col-md-4">
                            <label for="txtLicenciaFolio">Folio</label>
                            <input id="txtLicenciaFolio" name="txtLicenciaFolio" type="text" class="form-control" required />
                        </div>

                        <div class="col-md-4">
                            <label for="txtLicenciaVencimiento">Fecha de Vencimiento</label>
                            <div class="input-group">
                                <input id="txtLicenciaVencimiento" name="txtLicenciaVencimiento" type="text" class="form-control" required />
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="licenciaFichero">Fichero</label>
                            <div class="input-group fileupload-v1">
                                <input id="licenciaFichero" name="licenciaFichero" type="file" name="manualfile" class="fileupload-v1-file hidden" required/>
                                <input type="text" class="form-control fileupload-v1-path" placeholder="File Path..." disabled>
                                <span class="input-group-btn">
                                    <button class="btn fileupload-v1-btn" type="button"><i class="fa fa-folder"></i> Choose File</button>
                                </span>
                            </div><!-- /input-group -->
                        </div>
                    </div>

                    <div class="form-group">
                        <input class="submit btn btn-primary" type="submit" value="Guardar">
                        <a href="/panel/operadores" role="button" class="btn btn-default">Cancelar</a>
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

            $('#txtLicenciaVencimiento').bootstrapMaterialDatePicker({ format: 'DD/MM/YYYY', weekStart : 0, time: false});

            $("#operadorForm").validate({
                errorElement: "em",
                errorPlacement: function(error, element) {
                    $(element).addClass("danger");
                    error.appendTo(element.parent("div"));
                },
                success: function(label) {
                    $(label.parent("div").children("input")).removeClass("danger");
                },
                rules: {
                    txtNombre: {
                        required: true,
                        minlength: 4
                    },
                    txtTelefono: {
                        minlength: 7,
                        digits: true
                    },
                    txtLicenciaFolio: {
                        required: true,
                        minlength: 4
                    }
                },
                messages: {
                    txtNombre: {
                        required:"Por favor ingresa el nombre completo",
                        minlength: "El nombre completo debe ser mayor a 3 caracteres"
                    },
                    txtTelefono: {
                        minlength: "El número teléfonico debe ser mayor a 6 digitos",
                        digits: "Este campo acepta unicamente digitos"
                    },
                    txtNombre: {
                        required:"Por favor ingresa el folio de la licencia",
                        minlength: "El folio de la licencia debe ser mayor a 3 caracteres"
                    },
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