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
        <a href="/panel/vehiculos/inspecciones/<?php echo e($objInspeccion->pk_vehiculo); ?>" class="btn btn-dark"><i class="fa fa-check"></i> Inspecciones</a>
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

    <div class="col-md-8 padding-20">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h4 class="text-white">IMAGENES DE INSPECCI&Oacute;N</h4>
            </div>

            <div class="panel-body">
                <div id="dvImagenes" class="row">
                    <?php $__currentLoopData = $lstFicheros; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-6">
                            <a href="<?php echo e(Storage::disk('s3')->url($item->url_imagen)); ?>" target="_blank">
                                <img height="250px" class="img-thumbnail img-fluid" src="<?php echo e(Storage::disk('s3')->url($item->url_imagen)); ?>" />
                            </a>
                            <button class="btn btn-danger" onclick="confAccion('/panel/vehiculos/eliminar_foto_ins/<?php echo e($item->pk_vehiculo_inspeccion_fichero); ?>', '/panel/vehiculos/inspecciones/subir_fotos/<?php echo e($item->pk_vehiculo_inspeccion); ?>', 'La imagen será eliminada')">Eliminar</button>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 padding-20">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h4 class="text-white">ADJUNTAR FOTOGRAFÍA</h4>
            </div>

            <div class="panel-body">
                <form id="inspeccionPhotoForm">
                    <div class="row form-group">
                        <div id="load-photo-msg"></div>
                    </div>
                    <div class="form-group">
                        <input type="file" name="image" id="image" accept="image/*" required />
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-danger" onclick="subirFotoIns(<?php echo e($objInspeccion->pk_vehiculo_inspeccion); ?>, '<?php echo e(csrf_token()); ?>')"> Subir Imagen</button>
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script type="text/javascript">
        $(document).ready(function(){

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