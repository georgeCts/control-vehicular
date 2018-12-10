@section('title', 'Incidentes')

@section('stylesheets')

@endsection

@section('panel')
    <div class="col-md-6">
        <h3 class="animated fadeInLeft">
            <span class="fa-users fa"></span> Usuarios              
        </h3>
    </div>

    <div class="col-md-6 text-right m-t-20">
        <a href="/panel/usuarios" class="btn btn-dark"><i class="fa fa-bolt"></i> Consultar</a>
    </div>
@endsection

@section('content')
    <div class="col-md-6 col-md-offset-3">
    @if(Session::has('error_message'))
        <div class="alert alert-danger col-md-12 col-sm-12  alert-icon alert-dismissible fade in" role="alert">
            <div class="col-md-2 col-sm-2 icon-wrapper text-center">
                <span class="fa fa-times fa-2x"></span></div>
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
                <h4 class="text-white">REGISTRAR USUARIO</h4>
            </div>

            <div class="panel-body">
                {!! Form::open(['route' => 'new-usuario', 'method' => 'POST' , 'id' => 'usuarioForm']) !!}
                    <div class="row form-group">
                        <div class="col-md-4">
                            <label for="cmbTipoUsuario">Tipo de Usuario *</label>
                            <select id="cmbTipoUsuario" name="cmbTipoUsuario" class="form-control" required>
                                @foreach($lstUsuariosTipos as $item)
                                    <option value="{{ $item->pk_usuario_tipo }}">{{ $item->usuario_tipo }}</option>
                                @endforeach
                            </select>
                        </div>                        
                    </div>

                    <div class="row form-group">
                        <div class="col-md-3">
                                <label for="txtNombre">Nombre *</label>
                                <input id="txtNombre" name="txtNombre" type="text" class="form-control" required />
                        </div>

                        <div class="col-md-3">
                            <label for="txtApellidoP">Apellido Paterno</label>
                            <input id="txtApellidoP" name="txtApellidoP" type="text" class="form-control" required />
                        </div>

                        <div class="col-md-3">
                            <label for="txtApellidoM">Apellido Materno</label>
                            <input id="txtApellidoM" name="txtApellidoM" type="text" class="form-control" />
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-3">
                                <label for="txtCorreo">Correo *</label>
                                <input id="txtCorreo" name="txtCorreo" type="text" class="form-control" required />
                        </div>

                        <div class="col-md-3">
                            <label for="txtUsuario">Usuario *</label>
                            <input id="txtUsuario" name="txtUsuario" type="text" class="form-control" required />
                        </div>

                        <div class="col-md-3">
                            <label for="txtContrasena">Contrase&ntilde;a *</label>
                            <input id="txtContrasena" name="txtContrasena" type="password" class="form-control" required />
                        </div>
                    </div>                    

                    <div class="form-group">
                        <input class="submit btn btn-primary" type="submit" value="Guardar">
                        <a href="/panel/usuarios" role="button" class="btn btn-default">Cancelar</a>
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

            $('#txtFecha').bootstrapMaterialDatePicker({ format: 'DD/MM/YYYY', weekStart : 0, time: false});
            $('#txtFechaVencimiento').bootstrapMaterialDatePicker({ format: 'DD/MM/YYYY', weekStart : 0, time: false});

            $('.select2-multiple').select2();

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