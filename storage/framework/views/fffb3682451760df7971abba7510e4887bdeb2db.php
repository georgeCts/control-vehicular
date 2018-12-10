<?php $__env->startSection('title', 'Operadores'); ?>

<?php $__env->startSection('stylesheets'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/plugins/bootstrap-material-datetimepicker.css')); ?>"/>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('panel'); ?>
    <h3 class="animated fadeInLeft">
        <span class="fa-drivers-license fa"></span> Operadores  
        <a href="/panel/proveedores" class="btn btn-dark pull-right"><i class="fa fa-building"></i> Operadores</a>
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
                <h4 class="text-white">MODIFICAR OPERADOR</h4>
            </div>

            <div class="panel-body">
                <?php echo Form::open(['route' => 'update-operador', 'method' => 'put' , 'id' => 'operadorForm', 'files' => true]); ?>

                    <input type="hidden" name="hddPkOperador" value="<?php echo e($objOperador->pk_operador); ?>" />

                    <legend>INFORMACIÓN GENERAL</legend>
                    <div class="row form-group">
                        <div class="col-md-4">
                            <label for="txtNombre">Nombre Completo</label>
                            <input id="txtNombre" name="txtNombre" type="text" class="form-control" value="<?php echo e($objOperador->nombre); ?>" required>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-4">
                            <label for="txtTelefono">Tel&eacute;fono</label>
                            <input id="txtTelefono" name="txtTelefono" type="text" class="form-control" value="<?php echo e($objOperador->telefono); ?>" />
                        </div>
                    </div>
                    
                    <div class="row form-group">
                        <div class="col-md-4">
                            <label for="txtDomicilio">Domicilio</label>
                            <input id="txtDomicilio" name="txtDomicilio" type="text" class="form-control" value="<?php echo e($objOperador->domicilio); ?>" />
                        </div>
                    </div>

                    <legend>DATOS DE LICENCIA</legend>

                    <div class="row form-group">
                        <div class="col-md-4">
                            <label for="txtLicenciaFolio">Folio</label>
                            <input id="txtLicenciaFolio" name="txtLicenciaFolio" type="text" class="form-control" value="<?php echo e($objOperador->licencia_folio); ?>" required />
                        </div>

                        <div class="col-md-4">
                            <label for="txtLicenciaVencimiento">Fecha de Vencimiento</label>
                            <div class="input-group">
                                <input id="txtLicenciaVencimiento" name="txtLicenciaVencimiento" type="text" class="form-control" />
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="licenciaFichero">Fichero</label>
                            <div class="input-group fileupload-v1">
                                <input id="licenciaFichero" name="licenciaFichero" type="file" name="manualfile" class="fileupload-v1-file hidden" />
                                <input type="text" class="form-control fileupload-v1-path" placeholder="File Path..." disabled>
                                <span class="input-group-btn">
                                    <button class="btn fileupload-v1-btn" type="button"><i class="fa fa-folder"></i> Choose File</button>
                                </span>
                            </div><!-- /input-group -->
                        </div>
                    </div>

                    <?php if($objOperador->licencia_url != null): ?>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <a href="<?php echo e(Storage::disk('s3')->url($objOperador->licencia_url)); ?>" target="_blank">
                                    <img src="<?php echo e(Storage::disk('s3')->url($objOperador->licencia_url)); ?>" class="img-thumbnail" width="30%" />
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="form-group">
                        <input class="submit btn btn-primary" type="submit" value="Guardar">
                        <a href="/panel/operadores" role="button" class="btn btn-default">Cancelar</a>
                    </div>
                <?php echo Form::close(); ?>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('assets/js/plugins/bootstrap-material-datetimepicker.js')); ?>"></script>
    <script type="text/javascript">
        $(document).ready(function(){

            $('#txtLicenciaVencimiento').bootstrapMaterialDatePicker({ format: 'DD/MM/YYYY', weekStart : 0, time: false});
            var date =  '<?php echo e($objOperador->licencia_vigencia); ?>';
            var arrDate = date.split("-");
            $('#txtLicenciaVencimiento').bootstrapMaterialDatePicker('setDate', arrDate[2] + "/" + arrDate[1] + "/" + arrDate[0]);

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
                    txtLicenciaFolio: {
                        required:"Por favor ingresa el folio de la licencia",
                        minlength: "El folio de la licencia debe ser mayor a 3 caracteres"
                    },
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