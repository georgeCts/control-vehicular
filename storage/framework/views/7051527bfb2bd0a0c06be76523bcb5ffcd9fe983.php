<?php $__env->startSection('components.Stylesheets'); ?>

    <!-- start: Css -->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/bootstrap.min.css')); ?>">

        <!-- plugins -->
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/plugins/font-awesome.min.css')); ?>"/>
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/plugins/simple-line-icons.css')); ?>"/>
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/plugins/animate.min.css')); ?>"/>
        <link href="<?php echo e(asset('assets/css/style.css')); ?>" rel="stylesheet">
	<!-- end: Css -->
    
    <?php echo $__env->yieldContent('stylesheets'); ?>

<?php $__env->stopSection(); ?>