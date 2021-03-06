<?php $__env->startSection('title', 'Vehiculos'); ?>

<?php $__env->startSection('panel'); ?>
    <div class="col-md-6">
        <h3 class="animated fadeInLeft">
            <span class="fa-truck fa"></span> Vehículos              
        </h3>
        <h5 style="margin-left: 15px;">
            <span clas="text-muted">
                <i class="fa-money fa"></i> Gastos Adicionales
            </span>
        </h5>
    </div>
    
    <div class="col-md-6 text-right m-t-20">
        <a href="/panel/vehiculos/registrar_gasto" class="btn btn-primary"><i class="fa fa-plus"></i> Registrar Gasto</a>
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
                <h4>BIT&Aacute;CORA DE GASTOS</h4>
            </div>

            <div class="panel-body">
                <div class="responsive-table">
                    <table id="dtGastosAdicionales" class="table table-striped" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-center">Fecha</th>
                                <th class="text-left">Veh&iacute;culo</th>
                                <th class="text-left">Concepto</th>
                                <th class="text-right">Monto</th>
                                <th class="text-center">Proveedor</th>
                                <th class="text-center">Operador</th>
                                <th class="text-left">Comentarios</th>
                                <th class="text-center">Acci&oacute;nes</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $lstGastosAdicionales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $itemGasto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="text-center"><?php echo e($itemGasto->pk_gasto_adicional); ?></td>
                                    <td class="text-center"><?php echo e($itemGasto->fecha); ?></td>
                                    <td class="text-left"><a href="/panel/vehiculos/perfil_veh/<?php echo e($itemGasto->vehiculo->pk_vehiculo); ?>"><?php echo e($itemGasto->vehiculo->vehiculo_nombre); ?></a></td>
                                    <td class="text-left">
                                        <?php echo e($itemGasto->concepto); ?>

                                        <br />
                                        <small>Referencia: <?php echo e($itemGasto->referencia); ?></small>
                                    </td>                                    
                                    <td class="text-right">$<?php echo e($itemGasto->importe); ?></td>
                                    <td class="text-center">
                                        <?php if($itemGasto->pk_proveedor != null): ?>
                                            <a href="/panel/proveedores/perfil_prov/<?php echo e($itemGasto->proveedor->pk_proveedor); ?>"><?php echo e($itemGasto->proveedor->nombre_comercial); ?></a>
                                        <?php else: ?>
                                            N/A
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center"><?php echo e((($itemGasto->pk_operador != null)?$itemGasto->operador->nombre:'N/A')); ?></td>
                                    <td class="text-left"><?php echo e($itemGasto->comentarios); ?></td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="fa fa-cog"></span>
                                                <span class="fa fa-angle-down"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                            <li><a href="/panel/vehiculos/editar_gasto/<?php echo e($itemGasto->pk_gasto_adicional); ?>"><i class="fa fa-pencil"></i> Editar</a></li>
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
                                <th class="text-center">Fecha</th>
                                <th class="text-left">Veh&iacute;culo</th>
                                <th class="text-left">Concepto</th>
                                <th class="text-right">Monto</th>
                                <th class="text-center">Proveedor</th>
                                <th class="text-center">Operador</th>
                                <th class="text-left">Comentarios</th>
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
        $('#dtGastosAdicionales').DataTable();
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