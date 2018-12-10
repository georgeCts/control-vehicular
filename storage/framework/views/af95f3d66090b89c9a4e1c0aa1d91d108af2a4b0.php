<?php $__env->startSection('components.Scripts'); ?>

    <!-- start: Javascript -->
    <script src="<?php echo e(asset('assets/js/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/jquery.ui.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/bootstrap.min.js')); ?>"></script>

    <!-- plugins -->
    <script src="<?php echo e(asset('assets/js/plugins/moment.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/plugins/jquery.nicescroll.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/plugins/jquery.validate.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/plugins/sweetalert2.min.js')); ?>"></script>

    <!-- custom -->
    <script src="<?php echo e(asset('assets/js/main.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/custom.js')); ?>"></script>


    <?php echo $__env->yieldContent('scripts'); ?>
    <!-- end: Javascript -->
<?php $__env->stopSection(); ?>