<?php $__env->startSection('title', 'Proveedores'); ?>

<?php $__env->startSection('stylesheets'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/plugins/datatables.bootstrap.min.css')); ?>"/>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('panel'); ?>
    <h3 class="animated fadeInLeft">
        <span class="fa-building fa"></span> Proveedores  
        <a href="/panel/proveedores/registrar" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Registrar</a>
    </h3>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
        <div class="col-md-12 padding-20">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>LISTADO</h4>
            </div>

            <div class="panel-body">
                <div class="responsive-table">
                    <table id="dtProveedores" class="table table-striped" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">ID</th>
                                <th>Nombre Comercial</th>
                                <th>Teléfono</th>
                                <th>Persona de Contacto</th>
                                <th class="text-center">Acci&oacute;n</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $objProveedores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $itemProveedor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="text-center"><?php echo e($itemProveedor->pk_proveedor); ?></td>
                                    <td>
                                        <a href="/proveedores/perfil_prov/<?php echo e($itemProveedor->pk_proveedor); ?>"><?php echo e($itemProveedor->nombre_comercial); ?></a>
                                        <br />
                                        <small><?php echo e($itemProveedor->domicilio); ?></small>
                                    </td>
                                    <td><?php echo e($itemProveedor->telefono); ?></td>
                                    <td>
                                        <strong><?php echo e($itemProveedor->contacto_nombre); ?></strong><br />
                                        <small><?php echo e($itemProveedor->contacto_correo); ?></small><br />
                                        <small><?php echo e($itemProveedor->contacto_telefono); ?></small>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="fa fa-cog"></span>
                                                <span class="fa fa-angle-down"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                            <li><a href="/proveedores/editar/<?php echo e($itemProveedor->pk_proveedor); ?>"><i class="fa fa-pencil"></i> Editar</a></li>
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
                                <th>Nombre Comercial</th>
                                <th>Teléfono</th>
                                <th>Persona de Contacto</th>
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
        $('#dtProveedores').DataTable();
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