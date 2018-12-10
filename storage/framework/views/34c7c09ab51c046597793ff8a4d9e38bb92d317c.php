<?php $__env->startSection('title', 'Inspecciones'); ?>

<?php $__env->startSection('panel'); ?>
    <div class="col-md-6">
        <h3 class="animated fadeInLeft">
            <span class="fa-truck fa"></span> Vehículos              
        </h3>
        <h5 style="margin-left: 15px;">
            <span clas="text-muted">
                <i class="fa-check fa"></i> Inspecciones
            </span>
        </h5>
    </div>
    
    <div class="col-md-6 text-right m-t-20">
        <a href="/panel/vehiculos/inspecciones/<?php echo e($objVehiculo->pk_vehiculo); ?>/registrar_insp" class="btn btn-primary"><i class="fa fa-plus"></i> Registrar Inspecci&oacute;n</a>
        <a href="/panel/vehiculos" class="btn btn-dark"><i class="fa fa-table"></i> Inventario</a>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="col-md-6 col-md-offset-3">
    <?php if(Session::has('success_message')): ?>
        <div class="alert alert-success col-md-12 col-sm-12  alert-icon alert-dismissible fade in" role="alert">
            <div class="col-md-2 col-sm-2 icon-wrapper text-center">
                <span class="fa fa-check fa-2x"></span></div>
                <div class="col-md-10 col-sm-10">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <p><strong><?php echo e(Session::get('success_title' )); ?>!</strong> <?php echo e(Session::get('success_message' )); ?></p>
                </div>
            </div>
        </div>
    <?php endif; ?>
    </div>

    <div class="col-md-12 padding-20">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>INSPECCIONES REALIZADAS</h4>
            </div>

            <div class="panel-body">
                <div class="responsive-table">
                    <table id="dtInspecciones" class="table table-striped" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-left">Fecha</th>
                                <th class="text-center">Veh&iacute;culo</th>
                                <th class="text-left">Operador</th>
                                <th class="text-left">Recibi&oacute;</th>
                                <th class="text-left">Entreg&oacute;</th>
                                <th class="text-center">Acci&oacute;nes</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $lstInspecciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="text-center"><?php echo e($item->pk_vehiculo_inspeccion); ?></td>
                                    <td class="text-left"><?php echo e($item->fecha_inspeccion); ?></td>
                                    <td class="text-center">
                                        <a href="/panel/vehiculos/perfil_veh/<?php echo e($item->vehiculo->pk_vehiculo); ?>"><?php echo e($item->vehiculo->vehiculo_nombre); ?></a>
                                    </td>
                                    <td class="text-left"><?php echo e($item->operador->nombre); ?></td>
                                    <td class="text-left"><?php echo e($item->usuarioEntrega->nombre); ?></td>
                                    <td class="text-left"><?php echo e($item->operadorRecibe->nombre); ?></td>                              
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="fa fa-cog"></span>
                                                <span class="fa fa-angle-down"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a href="/panel/vehiculos/inspecciones/subir_fotos/<?php echo e($item->pk_vehiculo_inspeccion); ?>" ><i class="fa fa-file-image-o"></i> Adjuntar Fotos</a></li>
                                                <li><a href="/panel/vehiculos/inspecciones/imprimir/<?php echo e($item->pk_vehiculo_inspeccion); ?>" target="_blank"><i class="fa fa-print"></i> Imprimir</a></li>
                                                <li><a href="#"><i class="fa fa-trash"></i> Eliminar</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-left">Fecha</th>
                                <th class="text-center">Veh&iacute;culo</th>
                                <th class="text-left">Operador</th>
                                <th class="text-left">Recibi&oacute;</th>
                                <th class="text-left">Entreg&oacute;</th>
                                <th class="text-center">Acci&oacute;nes</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('assets/js/plugins/jquery.datatables.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/plugins/datatables.bootstrap.min.js')); ?>"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#dtInspecciones').DataTable();
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