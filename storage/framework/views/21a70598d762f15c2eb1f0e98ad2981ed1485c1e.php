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
                <i class="fa-folder-open fa"></i> <?php echo e($objVehiculo->vehiculo_nombre); ?>

            </span>
        </h5>
    </div>

    <div class="col-md-6 text-right m-t-20">
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
            <div class="panel-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="informacion-tab" data-toggle="tab" href="#informacion" role="tab" aria-controls="informacion" aria-selected="true">Información</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" id="combustible-tab" data-toggle="tab" href="#combustible" role="tab" aria-controls="combustible" aria-selected="false">Combustible</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" id="mantenimiento-tab" data-toggle="tab" href="#mantenimiento" role="tab" aria-controls="mantenimientos" aria-selected="false">Mantenimientos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="incidente-tab" data-toggle="tab" href="#incidente" role="tab" aria-controls="incidentes" aria-selected="false">Incidentes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" id="recordatorio-tab" data-toggle="tab" href="#recordatorio" role="tab" aria-controls="recordatorios" aria-selected="false">Recordatorios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" id="actividad-tab" data-toggle="tab" href="#actividad" role="tab" aria-controls="actividades" aria-selected="false">Actividades</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="operador-tab" data-toggle="tab" href="#operador" role="tab" aria-controls="operadores" aria-selected="false">Operadores</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="status-tab" data-toggle="tab" href="#status" role="tab" aria-controls="status" aria-selected="false">Status</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="documento-tab" data-toggle="tab" href="#documento" role="tab" aria-controls="documentos" aria-selected="false">Documentos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="fotografia-tab" data-toggle="tab" href="#fotografia" role="tab" aria-controls="fotografias" aria-selected="false">Fotografías</a>
                    </li>
                </ul>
    
                <div class="tab-content" id="myTabContent">
                    <!-- CONTENIDO DE INFORMACION -->
                    <div class="tab-pane fade show active" id="informacion" role="tabpanel" aria-labelledby="informacion-tab">
                        <div class="row padding-20">
                            <div class="col-md-12">
                                <div class="panel panel-success">
                                    <div class="panel-heading">
                                        <h4 class="text-white">INFORMACI&Oacute;N B&Aacute;SICA</h4>
                                    </div>

                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-4 col-sm-6">
                                                <table class="table">
                                                    <thead></thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <small>
                                                                    <strong>Registro en <u>miFlota.mx</u></strong>
                                                                </small>
                                                            </td>
                                                            <td><?php echo e($objVehiculo->creacion_fecha); ?>

                                                        </tr>
                                                        <tr>
                                                            <td><small><strong>Marca</strong></small></td>
                                                            <td><?php echo e($objVehiculo->vehiculo_marca); ?>

                                                        </tr>
                                                        <tr>
                                                            <td><small><strong>Modelo</strong></small></td>
                                                            <td><?php echo e($objVehiculo->vehiculo_modelo); ?>

                                                        </tr>
                                                        <tr>
                                                            <td><small><strong>A&ntilde;o</strong></small></td>
                                                            <td><?php echo e($objVehiculo->vehiculo_ano); ?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="col-md-4 col-sm-6">
                                                <table class="table">
                                                    <thead></thead>
                                                    <tbody>
                                                        <tr>
                                                            <td><small><strong>Tipo de Veh&iacute;culo</strong></small></td>
                                                            <td><?php echo e($objVehiculo->vehiculoTipo->vehiculo_tipo); ?>

                                                        </tr>
                                                        <tr>
                                                            <td><small><strong>No. de Serie</strong></small></td>
                                                            <td><?php echo e($objVehiculo->vehiculo_numero_serie); ?>

                                                        </tr>
                                                        <tr>
                                                            <td><small><strong>Licencia o Placa</strong></small></td>
                                                            <td><?php echo e($objVehiculo->vehiculo_placa); ?>

                                                        </tr>
                                                        <tr>
                                                            <td><small><strong>Grupo</strong></small></td>
                                                            <td><?php echo e((($objVehiculo->pk_vehiculo_grupo != null)?$objVehiculo->vehiculoGrupo->vehiculo_grupo:'')); ?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="col-md-4 col-sm-6">
                                                <table class="table">
                                                    <thead></thead>
                                                    <tbody>
                                                        <tr>
                                                            <td><small><strong>Color</strong></small></td>
                                                            <td><?php echo e($objVehiculo->vehiculo_color); ?>

                                                        </tr>
                                                        <tr>
                                                            <td><small><strong>Aseguradora</strong></small></td>
                                                            <td><?php echo e($objVehiculo->vehiculo_seguro); ?>

                                                        </tr>
                                                        <tr>
                                                            <td><small><strong>P&oacute;liza de Seguto</strong></small></td>
                                                            <td><?php echo e($objVehiculo->vehiculo_poliza); ?>

                                                        </tr>
                                                        <tr>
                                                            <td><small><strong>Grupo</strong></small></td>
                                                            <td><?php echo e((($objVehiculo->vehiculo_poliza_vigencia != null)?$objVehiculo->vehiculo_poliza_vigencia:'No registrado')); ?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row padding-20">
                            <div class="col-md-6">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4>DETALLES DE COMPRA</h4>
                                    </div>

                                    <div class="panel-body">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td><small><strong>Fecha de Compra</strong></small></td>
                                                    <td><?php echo e($objVehiculo->creacion_fecha); ?>

                                                </tr>
                                                <tr>
                                                    <td><small><strong>Precio de Compra</strong></small></td>
                                                    <td><?php echo e($objVehiculo->vehiculo_marca); ?>

                                                </tr>
                                                <tr>
                                                    <td><small><strong>Proveedor</strong></small></td>
                                                    <td><?php echo e($objVehiculo->vehiculo_modelo); ?>

                                                </tr>
                                                <tr>
                                                    <td><small><strong>Od&oacute;metro al Comprar</strong></small></td>
                                                    <td><?php echo e($objVehiculo->vehiculo_ano); ?></td>
                                                </tr>
                                                <tr>
                                                    <td><small><strong>Fecha L&iacute;mite de Garant&iacute;a</strong></small></td>
                                                    <td><?php echo e($objVehiculo->vehiculo_ano); ?></td>
                                                </tr>
                                                <tr>
                                                    <td><small><strong>L&iacute;mite de Garant&iacute;a por Uso (Km)</strong></small></td>
                                                    <td><?php echo e($objVehiculo->vehiculo_ano); ?></td>
                                                </tr>
                                                <tr>
                                                    <td><small><strong>Notas</strong></small></td>
                                                    <td><?php echo e($objVehiculo->vehiculo_ano); ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <h4>DETALLES DE CR&Eacute;DITO</h4>
                                            </div>

                                            <div class="col-sm-6 pull-right">                                                
                                                <a href="/panel/vehiculos" style="display: inline!important;" class="btn btn-dark pull-right"> Actualizar</a>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>

                                    <div class="panel-body">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td><small><strong>Fecha Inicial</strong></small></td>
                                                    <td><?php echo e($objVehiculo->creacion_fecha); ?>

                                                </tr>
                                                <tr>
                                                    <td><small><strong>Fecha Final</strong></small></td>
                                                    <td><?php echo e($objVehiculo->vehiculo_marca); ?>

                                                </tr>
                                                <tr>
                                                    <td><small><strong>Pago Mensual</strong></small></td>
                                                    <td><?php echo e($objVehiculo->vehiculo_modelo); ?>

                                                </tr>
                                                <tr>
                                                    <td><small><strong>Monto Financiado</strong></small></td>
                                                    <td><?php echo e($objVehiculo->vehiculo_ano); ?></td>
                                                </tr>
                                                <tr>
                                                    <td><small><strong>Tasa de Inter&eacute;s</strong></small></td>
                                                    <td><?php echo e($objVehiculo->vehiculo_ano); ?></td>
                                                </tr>
                                                <tr>
                                                    <td><small><strong>Valor Residual</strong></small></td>
                                                    <td><?php echo e($objVehiculo->vehiculo_ano); ?></td>
                                                </tr>
                                                <tr>
                                                    <td><small><strong>Instituci&oacute;n Financiera</strong></small></td>
                                                    <td><?php echo e($objVehiculo->vehiculo_ano); ?></td>
                                                </tr>
                                                <tr>
                                                    <td><small><strong>No. de Cuenta</strong></small></td>
                                                    <td><?php echo e($objVehiculo->vehiculo_ano); ?></td>
                                                </tr>
                                                <tr>
                                                    <td><small><strong>Notas</strong></small></td>
                                                    <td><?php echo e($objVehiculo->vehiculo_ano); ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- FIN CONTENIDO INFORMACION -->
    
                    <!-- CONTENIDO DE INCIDENTES -->
                    <div class="tab-pane fade" id="incidente" role="tabpanel" aria-labelledby="incidente-tab">
                        <div class="panel panel-default padding-20">
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
                    <!-- FIN CONTENIDO INCIDENTES -->

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