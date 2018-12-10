<?php $__env->startSection('title', 'Incidentes'); ?>

<?php $__env->startSection('panel'); ?>
    <div class="col-md-6">
        <h3 class="animated fadeInLeft">
            <span class="fa-truck fa"></span> Vehículos              
        </h3>
        <h5 style="margin-left: 15px;">
            <span clas="text-muted">
                <i class="fa-bolt fa"></i> Incidentes
            </span>
        </h5>
    </div>
    
    <div class="col-md-6 text-right m-t-20">
        <a href="/panel/vehiculos/reportar_inc" class="btn btn-primary"><i class="fa fa-plus"></i> Reportar Incidente</a>
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
                <h4>INCIDENTES REPORTADOS</h4>
            </div>

            <div class="panel-body">
                <div class="responsive-table">
                    <table id="dtIncidentes" class="table table-striped" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-left">Fechas</th>
                                <th class="text-center">Veh&iacute;culo</th>
                                <th class="text-left">Incidente</th>
                                <th class="text-center">Reportó</th>
                                <th class="text-left">Estatus</th>
                                <th class="text-center">Imagen</th>
                                <th class="text-center">Acci&oacute;nes</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $lstIncidentes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="text-center"><?php echo e($item->pk_incidente); ?></td>
                                    <td class="text-left">
                                        <small>Reporte: <strong><?php echo e($item->fecha_reporte); ?></strong></small>
                                        <br />
                                        <small>Vencimiento: <strong><?php echo e((($item->fecha_vencimiento != null)?$item->fecha_vencimiento:'N/A')); ?></strong></small>
                                    </td>
                                    <td class="text-center">
                                        <a href="/panel/vehiculos/perfil_veh/<?php echo e($item->vehiculo->pk_vehiculo); ?>"><?php echo e($item->vehiculo->vehiculo_nombre); ?></a>
                                    </td>
                                    <td class="text-left">
                                        <?php if($item->incidenteImportancia->incidente_importancia == 'Baja'): ?>
                                            <span class="label label-primary"><?php echo e($item->descripcion); ?></span>
                                        <?php elseif($item->incidenteImportancia->incidente_importancia == 'Moderada'): ?>
                                            <span class="label label-warning"><?php echo e($item->descripcion); ?></span>
                                        <?php else: ?>
                                            <span class="label label-danger"><?php echo e($item->descripcion); ?></span>
                                        <?php endif; ?>                                                                                                                        
                                        <br />
                                        <br />
                                        <span data-toggle="tooltip" data-placement="bottom" class="ttip label label-primary" title="<?php echo e($item->descripcion_detallada); ?>"> Ver detalles </span>
                                        <br />
                                        <small>Odómetro: <strong><?php echo e($item->medicion); ?></strong></small>
                                    </td>                                    
                                    <td class="text-center"><?php echo e($item->creacionUsuario->nombre); ?> <?php echo e($item->creacionUsuario->apellido_paterno); ?></td>
                                    <td class="text-left">
                                        <span class="label label-<?php echo e((($item->estatus != 'PENDIENTE')?'primary':'warning')); ?>"><?php echo e($item->estatus); ?></span>
                                        <?php if($item->fecha_cerrado != null): ?>
                                            <br /><br />
                                            <small>Fecha: <strong><?php echo e($item->fecha_cerrado); ?></strong></small>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if($item->url_imagen != null): ?>
                                            <a href="<?php echo e(Storage::disk('s3')->url($item->url_imagen)); ?>" target="_blank">
                                                <img class="img-thumbnail img-fluid" src="<?php echo e(Storage::disk('s3')->url($item->url_imagen)); ?>" style="max-width: 150px;" />
                                            </a>
                                        <?php else: ?>
                                            <a href="<?php echo e(asset('images/no_imagen.png')); ?>" target="_blank">
                                                <img class="img-thumbnail img-fluid" src="<?php echo e(asset('images/no_imagen.png')); ?>" style="max-width: 150px;" />
                                            </a>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="fa fa-cog"></span>
                                                <span class="fa fa-angle-down"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                            <li><a href="/panel/vehiculos/editar_inc/<?php echo e($item->pk_incidente); ?>"><i class="fa fa-pencil"></i> Editar</a></li>
                                            <li><a href="#"><i class="fa fa-thumbs-up"></i> Cerrar</a></li>
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
                                <th class="text-left">Fechas</th>
                                <th class="text-center">Veh&iacute;culo</th>
                                <th class="text-left">Incidente</th>
                                <th class="text-center">Reportó</th>
                                <th class="text-left">Estatus</th>
                                <th class="text-center">Imagen</th>
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
        $('#dtIncidentes').DataTable();
        $('.ttip').tooltip();
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