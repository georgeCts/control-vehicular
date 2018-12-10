<?php $__env->startSection('title', 'Usuarios'); ?>

<?php $__env->startSection('panel'); ?>
    <h3 class="animated fadeInLeft"><span class="fa-users fa"></span> Usuarios</h3>
    <h4 class="animated fadeInLeft m-l-15"><span class="fa-file-text fa"></span> Bit&aacute;cora</h4>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="col-md-12 padding-20">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>REGISTRO DE ACTIVIDADES</h4>
            </div>

            <div class="panel-body">
                <div class="responsive-table">
                    <table class="table table-striped" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">Fecha</th>
                                <th class="text-center">Usuario</th>
                                <th>Acci&oacute;n</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $objBitacora; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $itemBitacora): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="text-center"><?php echo e($itemBitacora->creacion_fecha); ?></td>
                                    <td class="text-center"><?php echo e($itemBitacora->usuario->nombre); ?> <?php echo e($itemBitacora->usuario->apellido_paterno); ?></td>
                                    <td><?php echo e($itemBitacora->descripcion); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                        <tfood>
                            <tr>
                                <th class="text-center">Fecha</th>
                                <th class="text-center">Usuario</th>
                                <th>Acci&oacute;n</th>
                            </tr>
                        </tfood>
                    </table>
                </div>
            </div>
        </div>
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