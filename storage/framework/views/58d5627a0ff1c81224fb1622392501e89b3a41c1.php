<?php $__env->startSection('title', 'Usuarios'); ?>

<?php $__env->startSection('panel'); ?>
    <h3 class="animated fadeInLeft">
        <span class="fa-users fa"></span> Usuarios
        <a href="/panel/usuarios/registrar" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Registrar</a>
    </h3>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div id="users" class="col-md-12 padding-0">
        <?php $__currentLoopData = $objUsuarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <usuario-card :user="<?php echo e($item); ?>" :tipo="<?php echo e($item->usuarioTipo); ?>"></usuario-card>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('js/app.js')); ?>"></script>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('components.LeftSideMenu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('components.LeftSideMenuMobile', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('components.Header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('components.Scripts', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('components.Panel', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('components.Stylesheets', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('components.Favicon', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


<?php echo $__env->make('components.Main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>