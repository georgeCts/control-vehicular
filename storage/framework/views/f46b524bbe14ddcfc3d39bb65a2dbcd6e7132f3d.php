<?php $__env->startSection('title', 'Vehiculos'); ?>

<?php $__env->startSection('stylesheets'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/plugins/datatables.bootstrap.min.css')); ?>"/>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('panel'); ?>
    <h3 class="animated fadeInLeft">
        <span class="fa-truck fa"></span> Vehículos  
        <a href="/panel/vehiculos/registrar" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Registrar</a>
    </h3>
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
                <h4>INVENTARIO</h4>
            </div>

            <div class="panel-body">
                <div class="responsive-table">
                    <table id="dtInventario" class="table table-striped" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-left">Veh&iacute;culo</th>
                                <th class="text-center">Uso</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Tipo</th>
                                <th class="text-center">Grupo</th>
                                <th class="text-center">Acci&oacute;n</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $lstVehiculos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $itemVehiculo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="text-center"><?php echo e($itemVehiculo->pk_vehiculo); ?></td>
                                    <td class="text-left">
                                        <a href="/panel/vehiculos/perfil_veh/<?php echo e($itemVehiculo->pk_vehiculo); ?>"><?php echo e($itemVehiculo->vehiculo_nombre); ?></a>
                                    </td>
                                    <td class="text-center"><?php echo e($itemVehiculo->vehiculoUltimoOdometro->latest('creacion_fecha')->first()->odometro); ?> Km</td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <button id="status_<?php echo e($itemVehiculo->pk_vehiculo); ?>" type="button" class="btn btn-sm btn-<?php echo e($itemVehiculo->vehiculoStatus->clase_nombre); ?> dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <?php echo e($itemVehiculo->vehiculoStatus->vehiculo_status); ?>

                                                <span class="fa fa-angle-down"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <?php $__currentLoopData = $lstStatus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $itemStatus): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li><a href="javascript:void(0);" onclick="cambioStatus('/panel/vehiculos/cambio_status/', <?php echo e($itemVehiculo->pk_vehiculo); ?>, <?php echo e($itemStatus->pk_vehiculo_status); ?>);"> <?php echo e($itemStatus->vehiculo_status); ?></a></li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                        </div>                                        
                                    </td>
                                    <td class="text-center"><?php echo e($itemVehiculo->vehiculoTipo->vehiculo_tipo); ?></td>
                                    <td class="text-center"><?php echo e((($itemVehiculo->pk_vehiculo_grupo != null)?$itemVehiculo->vehiculoGrupo->vehiculo_grupo:'-')); ?></td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="fa fa-cog"></span>
                                                <span class="fa fa-angle-down"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a href="#"><i class="fa fa-print"></i> Imprimir Ficha</a></li>
                                                <li><a href="/panel/vehiculos/editar/<?php echo e($itemVehiculo->pk_vehiculo); ?>"><i class="fa fa-pencil"></i> Editar</a></li>
                                                <li><a href="/panel/vehiculos/inspecciones/<?php echo e($itemVehiculo->pk_vehiculo); ?>"><i class="fa fa-check"></i> Inspecciones</a></li>
                                                <li><a href="#"><i class="fa fa-tint"></i> Cargar Combustible</a></li>
                                                <li><a href="#"><i class="fa fa-archive"></i> Archivar</a></li>
                                                <li><a href="#"><i class="fa fa-trash"></i> Eliminar</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-left">Veh&iacute;culo</th>
                                <th class="text-center">Uso</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Tipo</th>
                                <th class="text-center">Grupo</th>
                                <th class="text-center">Acci&oacute;n</th>
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
        $('#dtInventario').DataTable();
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