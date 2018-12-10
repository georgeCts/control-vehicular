<?php $__env->startSection('title', 'Usuarios'); ?>

<?php $__env->startSection('panel'); ?>
    <h3 class="animated fadeInLeft">
        <span class="fa-users fa"></span> Usuarios
        <a href="/panel/usuarios/registrar" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Registrar</a>
    </h3>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="col-md-12 padding-0">
        <?php $__currentLoopData = $objUsuarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-4 padding-0 text-center">
                <div class="badges-v1 <?php echo e((($item->usuarioTipo->pk_usuario_tipo == 1)?'bg-dark':'bg-grey')); ?> padding-15">
                    <div class="badges-ribbon">
                        <?php if($item->usuarioTipo->pk_usuario_tipo == 1): ?>
                            <div class="badges-ribbon-content badge-success"><?php echo e($item->usuarioTipo->usuario_tipo); ?></div>
                        <?php else: ?>
                            <div class="badges-ribbon-content badge-info"><?php echo e($item->usuarioTipo->usuario_tipo); ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="row">
                        <div class="col-md-12 text-center text-white"><h3><?php echo e($item->nombre); ?> <?php echo e($item->apellido_paterno); ?></h3></div>
                        <img src="/assets/img/<?php echo e($item->imagen); ?>" class="img-circle avatar-users" />                        
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-md-offset-3 text-center" style="margin-top:30px;">
                            <a href="#" role="button" class="btn btn-warning">Editar Perfil</a>
                        </div>
                    </div>

                    <hr />

                    <div class="text-left">
                        <p class="font-13 text-white">
                            <strong>Email:</strong>
                            <span class="m-l-15"><?php echo e($item->correo); ?></span>
                            <br />
                            <strong>N&uacute;mero de Accesos:</strong>
                            <span class="m-l-15"><?php echo e($item->numero_accesos); ?></span>
                            <br />
                            <strong>&Uacute;ltimo de Acceso:</strong>
                            <span class="m-l-15"><?php echo e((($item->ultimo_acceso_fecha != null)?\Carbon\Carbon::parse($item->ultimo_acceso_fecha)->format('j F y, H:i'):'-')); ?></span>
                        </p>
                    </div>           
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('components.LeftSideMenu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('components.LeftSideMenuMobile', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('components.Header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('components.Scripts', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('components.Panel', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('components.Stylesheets', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('components.Favicon', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


<?php echo $__env->make('components.Main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>