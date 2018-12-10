<?php $__env->startSection('title', 'Incidentes'); ?>

<?php $__env->startSection('stylesheets'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('panel'); ?>
    <div class="col-md-6">
        <h3 class="animated fadeInLeft">
            <span class="fa-users fa"></span> Usuarios              
        </h3>
    </div>

    <div class="col-md-6 text-right m-t-20">
        <a href="/panel/usuarios" class="btn btn-dark"><i class="fa fa-bolt"></i> Consultar</a>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="col-md-6 col-md-offset-3">
    <?php if(Session::has('error_message')): ?>
        <div class="alert alert-danger col-md-12 col-sm-12  alert-icon alert-dismissible fade in" role="alert">
            <div class="col-md-2 col-sm-2 icon-wrapper text-center">
                <span class="fa fa-times fa-2x"></span></div>
                <div class="col-md-10 col-sm-10">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <p><strong><?php echo e(Session::get('error_title' )); ?>!</strong> <?php echo e(Session::get('error_message' )); ?></p>
                </div>
            </div>
        </div>
    <?php endif; ?>
    </div>

    <div class="col-md-12 padding-20">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h4 class="text-white">REGISTRAR USUARIO</h4>
            </div>

            <div class="panel-body">
                <?php echo Form::open(['route' => 'new-usuario', 'method' => 'POST' , 'id' => 'usuarioForm']); ?>

                    <div class="row form-group">
                        <div class="col-md-4">
                            <label for="cmbTipoUsuario">Tipo de Usuario *</label>
                            <select id="cmbTipoUsuario" name="cmbTipoUsuario" class="form-control" required>
                                <?php $__currentLoopData = $lstUsuariosTipos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($item->pk_usuario_tipo); ?>"><?php echo e($item->usuario_tipo); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                <?php echo Form::close(); ?>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('assets/js/plugins/bootstrap-material-datetimepicker.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/plugins/select2.full.min.js')); ?>"></script>
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
<?php $__env->stopSection(); ?>



<?php echo $__env->make('components.LeftSideMenu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('components.LeftSideMenuMobile', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('components.Header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('components.Scripts', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('components.Panel', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('components.Stylesheets', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('components.Favicon', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


<?php echo $__env->make('components.Main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>