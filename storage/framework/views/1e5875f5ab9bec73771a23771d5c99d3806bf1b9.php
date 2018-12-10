<?php $__env->startSection('components.LeftSideMenuMobile'); ?>

    <!-- start: Mobile -->
    <div id="mimin-mobile" class="reverse">
        <div class="mimin-mobile-menu-list">
            <div class="col-md-12 sub-mimin-mobile-menu-list animated fadeInLeft">
                <ul class="nav nav-list">
                    <li <?php if(Request::path() == 'panel'): ?> 
                            <?php echo 'class="active ripple"'; ?>  
                        <?php else: ?> 
                            <?php echo 'class="ripple"'; ?>  
                        <?php endif; ?>>
                        <a href="<?php echo e(URL::to('panel')); ?>" class="nav-header">
                            <span class="fa-home fa"></span>Dashboard 
                        </a>
                    </li>

                    <?php $__currentLoopData = $_PRIVILEGIOS_MENU_; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $itemPrivilegioMenu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li <?php if(Request::path() == 'panel/'): ?> 
                                <?php echo 'class="active ripple"'; ?>  
                            <?php else: ?> 
                                <?php echo 'class="ripple"'; ?>  
                            <?php endif; ?>>
                            <a class="tree-toggle nav-header">
                                <span class="<?php echo e($itemPrivilegioMenu['categoria']['menu_icono']); ?> fa"></span><?php echo e($itemPrivilegioMenu['categoria']['privilegio_categoria']); ?>

                                <span class="fa-angle-right fa right-arrow text-right"></span>
                            </a>

                            <?php if( sizeof($itemPrivilegioMenu['privilegios']) > 0 ): ?>
                                <ul class="nav nav-list tree">
                                    <?php $__currentLoopData = $itemPrivilegioMenu['privilegios']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $itemPrivilegio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><a href="<?php echo e(URL::to('panel/' . $itemPrivilegio['menu_url'])); ?>"><?php echo e($itemPrivilegio['etiqueta']); ?></a></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <li class="ripple">
                        <a href="<?php echo e(URL::to('logout')); ?>" class="nav-header">
                            <span class="fa-power-off fa"></span>Cerrar Sesi&oacute;n
                        </a>
                    </li>
                </ul>
            </div>
        </div>       
    </div>
    <button id="mimin-mobile-menu-opener" class="animated rubberBand btn btn-circle btn-danger">
        <span class="fa fa-bars"></span>
    </button>
    <!-- end: Mobile -->
<?php $__env->stopSection(); ?>