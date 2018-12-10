<?php $__env->startSection('title', 'Vehiculos'); ?>

<?php $__env->startSection('stylesheets'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/plugins/datatables.bootstrap.min.css')); ?>"/>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('panel'); ?>
    <div class="col-md-6">
        <h3 class="animated fadeInLeft">
            <span class="fa-truck fa"></span> Vehículos              
        </h3>
        <h5 style="margin-left: 15px;">
            <span clas="text-muted">
                <i class="fa-folder-open fa"></i> <?php echo e($objCompra->vehiculo->vehiculo_nombre); ?>

            </span>
        </h5>
    </div>

    <div class="col-md-6 text-right m-t-20">
        <a href="/panel/vehiculos/perfil_veh/<?php echo e($objCompra->pk_vehiculo); ?>" class="btn btn-dark"><i class="fa fa-book"></i> Ficha Veh&iacute;culo</a>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="col-md-6 col-md-offset-3">
        <?php if(Session::has('error_message')): ?>
            <div class="alert alert-danger col-md-12 col-sm-12  alert-icon alert-dismissible fade in" role="alert">
                <div class="col-md-2 col-sm-2 icon-wrapper text-center">
                    <span class="fa fa-check fa-2x"></span></div>
                    <div class="col-md-10 col-sm-10">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <p><strong><?php echo e(Session::get('error_title' )); ?>!</strong> <?php echo e(Session::get('error_message' )); ?></p>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <div class="col-md-6 padding-20">
        <div class="panel panel-primary">            
            <div class="panel-body">
                <div class="panel-heading">
                    <h4 class="text-white">DETALLES DE COMPRA</h4>
                </div>

                <div class="panel-body">
                    <?php echo Form::open(['route' => 'update-vehiculo-compra', 'method' => 'put' , 'id' => 'compraForm']); ?>

                        <input type="hidden" name="hddPkVehiculo" value="<?php echo e($objCompra->pk_vehiculo); ?>" />

                        <div class="row form-group">
                            <div class="col-md-6">
                                <label for="txtFechaCompra">Fecha de Compra</label>
                                <div class="input-group">
                                    <input id="txtFechaCompra" name="txtFechaCompra" type="text" class="form-control" data-fecha_compra="<?php echo e($objCompra->compra_fecha); ?>" />
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-6">
                                <label for="txtPrecioCompra">Precio de Compra</label>
                                <input type="text" id="txtPrecioCompra" name="txtPrecioCompra" class="form-control" value="<?php echo e($objCompra->compra_precio); ?>" />
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-6">
                                <label for="cmbProveedor">Proveedor</label>
                                <select name="cmbProveedor" class="form-control">
                                    <option value="0">- Por Seleccionar -</option>
                                    <?php $__currentLoopData = $lstProveedores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($objCompra->pk_proveedor == $item->pk_proveedor): ?> 
                                            <option value="<?php echo e($item->pk_proveedor); ?>" selected><?php echo e($item->nombre_comercial); ?></option>
                                        <?php else: ?>
                                            <option value="<?php echo e($item->pk_proveedor); ?>"><?php echo e($item->nombre_comercial); ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-6">
                                <label for="txtOdometroCompra">Od&oacute;metro al Comprar</label>
                                <input type="text" id="txtOdometroCompra" name="txtOdometroCompra" class="form-control" value="<?php echo e($objCompra->compra_odometro); ?>" />
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-6">
                                <label for="txtFechaGarantia">Fecha L&iacute;mite de Garant&iacute;a</label>
                                <div class="input-group">
                                    <input id="txtFechaGarantia" name="txtFechaGarantia" type="text" class="form-control" data-fecha_garantia="<?php echo e($objCompra->garantia_limite_fecha); ?>" />
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-6">
                                <label for="txtOdometroGarantia">L&iacute;mite de Garant&iacute;a por Uso (Km)</label>
                                <input type="text" id="txtOdometroGarantia" name="txtOdometroGarantia" class="form-control" value="<?php echo e($objCompra->garantia_limite_odometro); ?>" />
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-6">
                                <label for="txtNotas">Notas</label>
                                <textarea id="txtNotas" name="txtNotas" class="form-control"><?php echo e($objCompra->notas); ?></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <input class="submit btn btn-primary" type="submit" value="Guardar">
                            <a href="/panel/vehiculos/perfil_veh/<?php echo e($objCompra->pk_vehiculo); ?>" role="button" class="btn btn-default">Cancelar</a>
                        </div>
                    <?php echo Form::close(); ?>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('assets/js/plugins/bootstrap-material-datetimepicker.js')); ?>"></script>
<script type="text/javascript">
    $(document).ready(function(){
        //FECHA DE COMPRA
        $('#txtFechaCompra').bootstrapMaterialDatePicker({ format: 'DD/MM/YYYY', weekStart : 0, time: false});
        if($('#txtFechaCompra').data('fecha_compra') != "") {
            var date = $('#txtFechaCompra').data('fecha_compra');
            var arrDate = date.split("-");
            $('#txtFechaCompra').bootstrapMaterialDatePicker('setDate', arrDate[2] + "/" + arrDate[1] + "/" + arrDate[0]);
        }

        //FECHA LIMITE DE GARANTIA
        $('#txtFechaGarantia').bootstrapMaterialDatePicker({ format: 'DD/MM/YYYY', weekStart : 0, time: false});
        if($('#txtFechaGarantia').data('fecha_garantia') != "") {
            var date = $('#txtFechaGarantia').data('fecha_garantia');
            var arrDate = date.split("-");
            $('#txtFechaGarantia').bootstrapMaterialDatePicker('setDate', arrDate[2] + "/" + arrDate[1] + "/" + arrDate[0]);
        }
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