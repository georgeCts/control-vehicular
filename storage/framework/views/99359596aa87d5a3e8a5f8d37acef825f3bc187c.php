<?php $__env->startSection('title', 'Vehiculos'); ?>

<?php $__env->startSection('stylesheets'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/plugins/bootstrap-material-datetimepicker.css')); ?>"/>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('panel'); ?>
    <div class="col-md-6">
        <h3 class="animated fadeInLeft">
            <span class="fa-truck fa"></span> Vehículos              
        </h3>
        <h5 style="margin-left: 15px;">
            <span clas="text-muted">
                <i class="fa-folder-open fa"></i> <?php echo e($objCredito->vehiculo->vehiculo_nombre); ?>

            </span>
        </h5>
    </div>

    <div class="col-md-6 text-right m-t-20">
        <a href="/panel/vehiculos/perfil_veh/<?php echo e($objCredito->pk_vehiculo); ?>" class="btn btn-dark"><i class="fa fa-book"></i> Ficha Veh&iacute;culo</a>
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

    <div class="col-md-12 padding-20">
        <div class="panel panel-primary">            
            <div class="panel-body">
                <div class="panel-heading">
                    <h4 class="text-white">DETALLES DE CR&Eacute;DITO</h4>
                </div>

                <div class="panel-body">
                    <?php echo Form::open(['route' => 'update-vehiculo-credito', 'method' => 'put' , 'id' => 'creditoForm']); ?>

                        <input type="hidden" name="hddPkVehiculo" value="<?php echo e($objCredito->pk_vehiculo); ?>" />

                        <div class="row form-group">
                            <div class="col-md-6">
                                <label for="txt">Periodo Cr&eacute;dito</label>
                                <div class="input-group">
                                    <input id="txtFechaPeriodo" name="txtFechaInicial" type="text" class="form-control" data-fecha_inicial="<?php echo e($objCredito->fecha_inicial); ?>" />
                                    <span class="input-group-addon"> - </span>
                                    <input id="txtFechaPeriodo2" name="txtFechaFinal" type="text" class="form-control" data-fecha_final="<?php echo e($objCredito->fecha_final); ?>" />
                                </div>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-3">
                                <label for="txtPagoMensual">Pago Mensual</label>
                                <input type="text" id="txtPagoMensual" name="txtPagoMensual" class="form-control" value="<?php echo e($objCredito->pago_mensual); ?>" />
                            </div>

                            <div class="col-md-3">
                                <label for="txtMontoFinanciado">Monto Financiado</label>
                                <input type="text" id="txtMontoFinanciado" name="txtMontoFinanciado" class="form-control" value="<?php echo e($objCredito->monto_financiado); ?>" />
                            </div>

                            <div class="col-md-3">
                                <label for="txtTasaInteres">Tasa de Inter&eacute;s</label>
                                <input type="text" id="txtTasaInteres" name="txtTasaInteres" class="form-control" value="<?php echo e($objCredito->tasa_interes); ?>" />
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-3">
                                <label for="txtValorResidual">Valor Residual</label>
                                <input type="text" id="txtValorResidual" name="txtValorResidual" class="form-control" value="<?php echo e($objCredito->valor_residual); ?>" />
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-4">
                                <label for="txtInstitucion">Institución Financiera</label>
                                <input type="text" id="txtInstitucion" name="txtInstitucion" class="form-control" value="<?php echo e($objCredito->institucion_financiera); ?>" />
                            </div>

                            <div class="col-md-4">
                                <label for="txtNumeroCuenta">No. de Cuenta</label>
                                <input type="text" id="txtNumeroCuenta" name="txtNumeroCuenta" class="form-control" value="<?php echo e($objCredito->numero_cuenta); ?>" />
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-4">
                                <label for="txtNotas">Notas</label>
                                <textarea id="txtNotas" name="txtNotas" class="form-control"><?php echo e($objCredito->notas); ?></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <input class="submit btn btn-primary" type="submit" value="Guardar">
                            <a href="/panel/vehiculos/perfil_veh/<?php echo e($objCredito->pk_vehiculo); ?>" role="button" class="btn btn-default">Cancelar</a>
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
        //FECHA INICIAL
        $('#txtFechaPeriodo').bootstrapMaterialDatePicker({ format: 'DD/MM/YYYY', weekStart : 0, time: false});
        if($('#txtFechaPeriodo').data('fecha_inicial') != "") {
            var date = $('#txtFechaPeriodo').data('fecha_inicial');
            var arrDate = date.split("-");
            $('#txtFechaPeriodo').bootstrapMaterialDatePicker('setDate', arrDate[2] + "/" + arrDate[1] + "/" + arrDate[0]);
        }

        //FECHA FINAL
        $('#txtFechaPeriodo2').bootstrapMaterialDatePicker({ format: 'DD/MM/YYYY', weekStart : 0, time: false});
        if($('#txtFechaPeriodo2').data('fecha_final') != "") {
            var date = $('#txtFechaPeriodo2').data('fecha_final');
            var arrDate = date.split("-");
            $('#txtFechaPeriodo2').bootstrapMaterialDatePicker('setDate', arrDate[2] + "/" + arrDate[1] + "/" + arrDate[0]);
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