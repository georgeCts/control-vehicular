<?php $__env->startSection('components.Header'); ?>

    <!-- start: Header -->
    <nav class="navbar navbar-default header navbar-fixed-top">
        <div class="col-md-12 nav-wrapper">
            <div class="navbar-header" style="width:100%;">
                <div class="opener-left-menu is-open">
                    <span class="top"></span>
                    <span class="middle"></span>
                    <span class="bottom"></span>
                </div>
                <a href="<?php echo e(URL::to('panel')); ?>" class="navbar-brand"> 
                    <b><?php echo e($_SYSTEM_NAME); ?></b>
                </a>

                <ul class="nav navbar-nav navbar-right user-nav">
                    <li class="user-name"><span><?php echo e(ucfirst(Auth::user()->nombre)); ?> <?php echo e(ucfirst(Auth::user()->apellido_paterno)); ?></span></li>
                    <li class="dropdown avatar-dropdown">
                        <img src="<?php echo e(asset('assets/img/avatar.jpg')); ?>" class="img-circle avatar" alt="user name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"/>
                        <ul class="dropdown-menu user-dropdown">
                            <li><a href="#"><span class="fa fa-user"></span> Mi Perfil</a></li>
                            <li role="separator" class="divider"></li>
                            <li class="more">
                                <ul>
                                    <li><a href="#"><span class="fa fa-lock"></span></a></li>
                                    <li><a href="<?php echo e(URL::to('logout')); ?>"><span class="fa fa-power-off "></span></a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- end: Header -->

<?php $__env->stopSection(); ?>