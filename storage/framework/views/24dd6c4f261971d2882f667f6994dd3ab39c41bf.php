<?php $__env->startSection('title', 'Proveedores'); ?>

<?php $__env->startSection('panel'); ?>
    <h3 class="animated fadeInLeft">
        <span class="fa-building fa"></span> Proveedores  
        <a href="/panel/proveedores" class="btn btn-dark pull-right"><i class="fa fa-building"></i> Proveedores</a>
    </h3>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="col-md-6 col-md-offset-3">
    <?php if(Session::has('error_message')): ?>
        <div class="alert alert-danger col-md-12 col-sm-12  alert-icon alert-dismissible fade in" role="alert">
            <div class="col-md-2 col-sm-2 icon-wrapper text-center">
                <span class="fa fa-check fa-2x"></span></div>
                <div class="col-md-10 col-sm-10">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <p><strong><?php echo e(Session::get('error_title' )); ?>!</strong> <?php echo e(Session::get('error_message' )); ?></p>
                </div>
            </div>
        </div>
    <?php endif; ?>
    </div>

    <div class="col-md-12 padding-20">
        <div class="panel panel-warning">
            <div class="panel-heading">
                <h4>MODIFICAR PROVEEDOR</h4>
            </div>

            <div class="panel-body">
                <?php echo Form::open(['route' => 'update-proveedor', 'method' => 'put' , 'id' => 'proveedorForm']); ?>

                    <input type="hidden" name="pkProveedor" value="<?php echo e($objProveedor->pk_proveedor); ?>" />

                    <legend>INFORMACIÓN GENERAL</legend>
                    <div class="row form-group">
                        <div class="col-md-4">
                            <label for="txtNombreComercial">Nombre Comercial</label>
                            <input id="txtNombreComercial" name="txtNombreComercial" type="text" class="form-control" value="<?php echo e($objProveedor->nombre_comercial); ?>" required>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-4">
                            <label for="txtTelefono">Tel&eacute;fono</label>
                            <input id="txtTelefono" name="txtTelefono" type="text" class="form-control" value="<?php echo e($objProveedor->telefono); ?>">
                        </div>
                    </div>
                    
                    <div class="row form-group">
                        <div class="col-md-4">
                            <label for="txtDomicilio">Domicilio</label>
                            <input id="txtDomicilio" name="txtDomicilio" type="text" class="form-control" value="<?php echo e($objProveedor->domicilio); ?>" />
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-4">
                            <label for="txtCiudad">Ciudad</label>
                            <input id="txtCiudad" name="txtCiudad" type="text" class="form-control" value="<?php echo e($objProveedor->ciudad); ?>" />
                        </div>

                        <div class="col-md-4">
                            <label for="txtEstado">Estado</label>
                            <input id="txtEstado" name="txtEstado" type="text" class="form-control" value="<?php echo e($objProveedor->estado); ?>" />
                        </div>
                    </div>

                    <legend>CONTACTO DIRECTO</legend>

                    <div class="row form-group">
                        <div class="col-md-4">
                            <label for="txtContacto">Persona de Contacto</label>
                            <input id="txtContacto" name="txtContacto" type="text" class="form-control" value="<?php echo e($objProveedor->contacto_nombre); ?>" />
                        </div>

                        <div class="col-md-4">
                            <label for="txtContactoTelefono">Tel&eacute;fono</label>
                            <input id="txtContactoTelefono" name="txtContactoTelefono" type="text" class="form-control" value="<?php echo e($objProveedor->contacto_telefono); ?>" />
                        </div>

                        <div class="col-md-4">
                            <label for="txtContactoCorreo">Correo Electr&oacute;nico</label>
                            <input id="txtContactoCorreo" name="txtContactoCorreo" type="text" class="form-control" value="<?php echo e($objProveedor->contacto_correo); ?>" />
                        </div>
                    </div>

                    <div class="form-group">
                        <input class="submit btn btn-primary" type="submit" value="Guardar">
                        <a href="/panel/proveedores" role="button" class="btn btn-default">Cancelar</a>
                    </div>
                <?php echo Form::close(); ?>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script type="text/javascript">
        $(document).ready(function(){

            $("#proveedorForm").validate({
                errorElement: "em",
                errorPlacement: function(error, element) {
                    $(element).addClass("danger");
                    error.appendTo(element.parent("div"));
                },
                success: function(label) {
                    $(label.parent("div").children("input")).removeClass("danger");
                },
                rules: {
                    txtNombreComercial: {
                        required: true,
                        minlength: 4
                    },
                    txtTelefono: {
                        minlength: 7,
                        digits: true
                    },
                    txtContactoTelefono: {
                        minlength: 7,
                        digits: true
                    },
                    txtContactoCorreo: "email"
                },
                messages: {
                    txtNombreComercial: {
                        required:"Por favor ingresa un nombre comercial",
                        minlength: "El nombre comercial debe ser mayor a 3 caracteres"
                    },
                    txtTelefono: {
                        minlength: "El número teléfonico debe ser mayor a 6 digitos",
                        digits: "Este campo acepta unicamente digitos"
                    },
                    txtContactoTelefono: {
                        minlength: "El número teléfonico debe ser mayor a 6 digitos",
                        digits: "Este campo acepta unicamente digitos"
                    }
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('components.LeftSideMenu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('components.LeftSideMenuMobile', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('components.Header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('components.Scripts', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('components.Panel', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('components.Stylesheets', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('components.Favicon', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


<?php echo $__env->make('components.Main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>