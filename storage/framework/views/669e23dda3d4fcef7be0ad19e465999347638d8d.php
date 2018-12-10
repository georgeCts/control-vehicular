<?php $__env->startSection('title', 'Inspecciones'); ?>

<?php $__env->startSection('stylesheets'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/plugins/bootstrap-material-datetimepicker.css')); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/plugins/select2.min.css')); ?>"/>
<?php $__env->stopSection(); ?>

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
        <a href="/panel/vehiculos/inspecciones/<?php echo e($objVehiculo->pk_vehiculo); ?>" class="btn btn-dark"><i class="fa fa-check"></i> Inspecciones</a>
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
            <div class="panel-heading">
                <h4 class="text-white">REGISTRAR INSPECCI&Oacute;N</h4>
            </div>

            <div class="panel-body">
                <?php echo Form::open(['route' => 'new-inspeccion', 'method' => 'POST' , 'id' => 'inspeccionForm', 'files' => true]); ?>

                    <div class="row form-group">
                        <div class="col-md-4">
                            <label for="txtVehiculo">Veh&iacute;culo *</label>
                            <input type="hidden" name="pk_vehiculo" value="<?php echo e($objVehiculo->pk_vehiculo); ?>" />
                            <input id="txtVehiculo" type="text" class="form-control" value="<?php echo e($objVehiculo->vehiculo_nombre); ?>" readonly />
                        </div>                        
                    </div>

                    <div class="row form-group">
                        <div class="col-md-4">
                            <label for="txtFecha">Fecha de Inspección *</label>
                            <div class="input-group">
                                <input id="txtFecha" name="txtFecha" type="text" class="form-control" required />
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="txtKmSalida">Kilometraje de Salida *</label>
                            <input id="txtKmSalida" name="txtKmSalida" type="text" class="form-control" placeholder="0.00" required />
                        </div>

                        <div class="col-md-4">
                            <label for="txtPlacas">N&uacute;mero de las Placas *</label>
                            <input id="txtPlacas" type="text" class="form-control" value="<?php echo e($objVehiculo->vehiculo_placa); ?>" readonly />
                        </div>
                    </div>
                    
                    <div class="row form-group">
                        <div class="col-md-4">
                            <label for="cmbOperador">Operador *</label>
                            <select id="cmbOperador" name="cmbOperador" class="form-control" required>
                                <option value="0">Ninguno</option>
                                <?php $__currentLoopData = $lstOperadores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $itemOperador): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($itemOperador->pk_operador); ?>"><?php echo e($itemOperador->nombre); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="txtFechaVigencia">Vigencia de Licencia *</label>
                            <div class="input-group">
                                <input id="txtFechaVigencia" name="txtFechaVigencia" type="text" class="form-control" required />
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="txtNumeroUnidad">N&uacute;mero de la Unidad *</label>
                            <input id="txtNumeroUnidad" name="txtNumeroUnidad" type="text" class="form-control" required />
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-4">
                            <label for="txtTipoVehiculo">Tipo de Veh&iacute;culo</label>
                            <input id="txtTipoVehiculo" type="text" class="form-control" value="<?php echo e($objVehiculo->vehiculoTipo->vehiculo_tipo); ?>" readonly />
                        </div>

                        <div class="col-md-4">
                            <label for="cmbRecibe">Persona que recibe *</label>
                            <select id="cmbRecibe" name="cmbRecibe" class="form-control" required>
                                <?php $__currentLoopData = $lstOperadores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $itemOperador): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($itemOperador->pk_operador); ?>"><?php echo e($itemOperador->nombre); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="txtTelefono">N&uacute;mero de tel&eacute;fono del veh&iacute;culo</label>
                            <input id="txtTelefono" name="txtTelefono" type="text" class="form-control" placeholder="(555)-5555-555" />
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-6">
                            <div class="row">
                                <!-- Tabla de Seguridad -->
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th class="text-left">Equipo de Seguridad</th>
                                                    <th class="text-center">Si</th>
                                                    <th class="text-center">No</th>
                                                </tr>
                                            </thead>
                                            <tbody class="tbl-seguridad">
                                                <tr>
                                                    <td class="text-left">Triangulos reflejantes</td>
                                                    <td class="text-center"><input type="radio" name="rdTriangulo" value="true"></td>
                                                    <td class="text-center"><input type="radio" name="rdTriangulo" value="false" checked></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left">Gato</td>
                                                    <td class="text-center"><input type="radio" name="rdGato" value="true"></td>
                                                    <td class="text-center"><input type="radio" name="rdGato" value="false" checked></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left">Herramientas</td>
                                                    <td class="text-center"><input type="radio" name="rdHerramienta" value="true"></td>
                                                    <td class="text-center"><input type="radio" name="rdHerramienta" value="false" checked></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left">Llanta de refacci&oacute;n</td>
                                                    <td class="text-center"><input type="radio" name="rdLlantaRefaccion" value="true"></td>
                                                    <td class="text-center"><input type="radio" name="rdLlantaRefaccion" value="false" checked></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- Tabla General -->
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th class="text-left">General</th>
                                                    <th class="text-center">OK</th>
                                                    <th class="text-center">Reparar</th>
                                                </tr>
                                            </thead>
                                            <tbody class="tbl-general">
                                                <tr>
                                                    <td class="text-left">Presi&oacute;n de las llantas</td>
                                                    <td class="text-center"><input type="radio" name="rdPresionLlanta" value="true" checked></td>
                                                    <td class="text-center"><input type="radio" name="rdPresionLlanta" value="false"></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left">Dibujo de las llantas</td>
                                                    <td class="text-center"><input type="radio" name="rdDibujoLlanta" value="true" checked></td>
                                                    <td class="text-center"><input type="radio" name="rdDibujoLlanta" value="false"></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left">Limpieza interna y externa del veh&iacute;culo</td>
                                                    <td class="text-center"><input type="radio" name="rdLimpieza" value="true" checked></td>
                                                    <td class="text-center"><input type="radio" name="rdLimpieza" value="false"></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left">Aseguramiento de carga dentro y fuera</td>
                                                    <td class="text-center"><input type="radio" name="rdCarga" value="true" checked></td>
                                                    <td class="text-center"><input type="radio" name="rdCarga" value="false"></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left">Da&ntilde;os en la carrocer&iacute;a (ver dibujo anexo)</td>
                                                    <td class="text-center"><input type="radio" name="rdCarroceria" value="true" checked></td>
                                                    <td class="text-center"><input type="radio" name="rdCarroceria" value="false"></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left">Condici&oacute;n del escape</td>
                                                    <td class="text-center"><input type="radio" name="rdEscape" value="true" checked></td>
                                                    <td class="text-center"><input type="radio" name="rdEscape" value="false"></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left">Funcionamiento del limpiaparabrisas</td>
                                                    <td class="text-center"><input type="radio" name="rdLimpiaparabrisa" value="true" checked></td>
                                                    <td class="text-center"><input type="radio" name="rdLimpiaparabrisa" value="false"></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left">Parabrisas (astillado/cuarteado)</td>
                                                    <td class="text-center"><input type="radio" name="rdParabrisa" value="true" checked></td>
                                                    <td class="text-center"><input type="radio" name="rdParabrisa" value="false"></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left">Desempa&ntilde;ador, calefacci&oacute;n, A/C</td>
                                                    <td class="text-center"><input type="radio" name="rdAireAcondicionado" value="true" checked></td>
                                                    <td class="text-center"><input type="radio" name="rdAireAcondicionado" value="false"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="row">
                                <!-- Tabla de Niveles -->
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th class="text-left">Motor y transmisi&oacute;n (Niveles y Frugas)</th>
                                                    <th class="text-center">OK</th>
                                                    <th class="text-center">Fuga</th>
                                                </tr>
                                            </thead>
                                            <tbody class="tbl-niveles">
                                                <tr>
                                                    <td class="text-left">Nivel de combustible (Lleno, 3/4, 1/2, 1/4, E)</td>
                                                    <td class="text-center" colspan="2"><input type="text" name="txtTanque" required></td>                                           
                                                </tr>
                                                <tr>
                                                    <td class="text-left">Nivel del anticongelante</td>
                                                    <td class="text-center"><input type="radio" name="rdAnticongelante" value="true"></td>
                                                    <td class="text-center"><input type="radio" name="rdAnticongelante" value="false" checked></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left">Nivel de aceite</td>
                                                    <td class="text-center"><input type="radio" name="rdAceite" value="true"></td>
                                                    <td class="text-center"><input type="radio" name="rdAceite" value="false" checked></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left">Liquido en el limpiador</td>
                                                    <td class="text-center"><input type="radio" name="rdLiquidoLimpiador" value="true"></td>
                                                    <td class="text-center"><input type="radio" name="rdLiquidoLimpiador" value="false" checked></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left">¿Alguna fuga visible?</td>
                                                    <td class="text-center"><input type="radio" name="rdFuga" value="true"></td>
                                                    <td class="text-center"><input type="radio" name="rdFuga" value="false" checked></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left">Cables pasa corriente</td>
                                                    <td class="text-center"><input type="radio" name="rdCables" value="true"></td>
                                                    <td class="text-center"><input type="radio" name="rdCables" value="false" checked></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- Tabla Luces -->
                                <div class="col-md-12">
                                    <table class="table table-striped table-bordered" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th class="text-left">Luces</th>
                                                <th class="text-center">OK</th>
                                                <th class="text-center">Reparar</th>
                                            </tr>
                                        </thead>
                                        <tbody class="tbl-luces">
                                            <tr>
                                                <td class="text-left">Delanteras (altas. bajas, direccionales)</td>
                                                <td class="text-center"><input type="radio" name="rdLucesDelanteras" value="true" checked></td>
                                                <td class="text-center"><input type="radio" name="rdLucesDelanteras" value="false"></td>
                                            </tr>
                                            <tr>
                                                <td class="text-left">Traseras (altas. bajas, direccionales)</td>
                                                <td class="text-center"><input type="radio" name="rdLucesTraceras" value="true" checked></td>
                                                <td class="text-center"><input type="radio" name="rdLucesTraceras" value="false"></td>
                                            </tr>
                                            <tr>
                                                <td class="text-left">Intermitentes (cuatro encendidas)</td>
                                                <td class="text-center"><input type="radio" name="rdLucesIntermitentes" value="true" checked></td>
                                                <td class="text-center"><input type="radio" name="rdLucesIntermitentes" value="false"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Tabla Documentación -->
                                <div class="col-md-12">
                                    <table class="table table-striped table-bordered" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th class="text-left">Documentaci&oacute;n</th>
                                                <th class="text-center">Si</th>
                                                <th class="text-center">No</th>
                                            </tr>
                                        </thead>
                                        <tbody class="tbl-luces">
                                            <tr>
                                                <td class="text-left">Tarjeta de circulaci&oacute;n</td>
                                                <td class="text-center"><input type="radio" name="rdTarjetaCirculacion" value="true" checked></td>
                                                <td class="text-center"><input type="radio" name="rdTarjetaCirculacion" value="false"></td>
                                            </tr>
                                            <tr>
                                                <td class="text-left">P&oacute;liza de seguro</td>
                                                <td class="text-center"><input type="radio" name="rdPolizaSeguro" value="true" checked></td>
                                                <td class="text-center"><input type="radio" name="rdPolizaSeguro" value="false"></td>
                                            </tr>
                                            <tr>
                                                <td class="text-left">Registro de mantenimiento (servicio)</td>
                                                <td class="text-center"><input type="radio" name="rdRegistroMantenimiento" value="true" checked></td>
                                                <td class="text-center"><input type="radio" name="rdRegistroMantenimiento" value="false"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>                            
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-8">
                            <label for="txtComentarios">Comentarios</label>
                            <textarea class="form-control" id="txtComentarios" name="txtComentarios" rows="3"></textarea>
                        </div>

                        <div class="col-md-4">
                            <label for="txtComentarios">Agrega la imagen generada del check vehícular</label>
                            <input type="file" name="image" class="form-control" required />
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-12 text-center">
                            <canvas style="background:#fff; border:1px solid #ccc; width:500px; height:500px;"></canvas>
                            <div style="display:none;">
                                <img id="source" src="<?php echo e(asset('images/vehiculo.jpg')); ?>" width="500" height="500" />
                            </div>
                        </div>

                        <div class="col-md-6 col-md-offset-3 text-center">
                            <a id="btnLimpiar" href="javascript:void(0)" class="btn btn-warning">Limpiar</a>
                            <a id="btnGenerar" href="javascript:void(0)" class="btn btn-success">Generar Imagen</a>
                        </div>
                    </div>
                    
                    <br />
                    <div class="row form-group">
                        <div class="col-md-6">
                            <h4>Firma de Recibido</h4>
                            <div id="dvRecibo"></div>
                            <input type="hidden" id="imgRecibo" name="imgRecibo" />
                        </div>

                        <div class="col-md-6">
                            <h4>Firma de Entrega</h4>
                            <div id="dvEntrega"></div>
                            <input type="hidden" id="imgEntrega" name="imgEntrega" />
                        </div>

                        <div class="col-md-6 col-md-offset-3">
                            <a id="btnLimpiarFirma" href="javascript:void(0)" class="btn btn-warning">Limpiar</a>
                            <a id="btnGuardarFirma" href="javascript:void(0)" class="btn btn-success">Guardar Firma</a>
                        </div>
                    </div>

                    <div class="form-group">
                        <input class="submit btn btn-primary" type="submit" value="Guardar">
                        <a href="/panel/vehiculos/inspecciones/<?php echo e($objVehiculo->pk_vehiculo); ?>" role="button" class="btn btn-default">Cancelar</a>
                    </div>
                <?php echo Form::close(); ?>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('assets/js/plugins/bootstrap-material-datetimepicker.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/plugins/select2.full.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/plugins/jSignature/jSignature.min.js')); ?>"></script>
    <script type="text/javascript">
        $(document).ready(function(){

            $('#txtFecha').bootstrapMaterialDatePicker({ format: 'DD/MM/YYYY', weekStart : 0, time: false});
            $('#txtFechaVigencia').bootstrapMaterialDatePicker({ format: 'DD/MM/YYYY', weekStart : 0, time: false});

            $("#gastoAdicionalForm").validate({
                errorElement: "em",
                errorPlacement: function(error, element) {
                    $(element).addClass("danger");
                    error.appendTo(element.parent("div"));
                },
                success: function(label) {
                    $(label.parent("div").children("input")).removeClass("danger");
                },
                rules: {
                    txtConcepto: {
                        required: true,
                        minlength: 4
                    },
                    txtImporte: {
                        minlength: 1,
                        number: true
                    }
                },
                messages: {
                    txtConcepto: {
                        required:"Por favor ingresa el concepto",
                        minlength: "El concepto debe ser mayor a 3 caracteres"
                    },
                    txtImporte: {
                        minlength: "El importe debe tener al menos un números.",
                        number: "Este campo acepta únicamente números"
                    }
                }
            });

            // FORM SUBMIT
			$('#inspeccionForm').submit(function(e){
				
				var flag = true;
				
				if($('#imgRecibo').val() != "" && $('#imgEntrega').val() != "" && $('#cmbOperador').val() != "") {
					flag = false
				}

				if(flag) {									
					e.preventDefault();
					swal("Hey!", "Verifica que el operador este seleccionado y que las firmas sean ingresadas.", "warning");
				}
		  	});
            
            $("#dvRecibo").jSignature();
            $("#dvEntrega").jSignature();

            $('#btnGuardarFirma').click(function() {
				var dataEntrega = $("#dvEntrega").jSignature("getData", "image");
				$('#imgEntrega').val(dataEntrega[1]);

				var dataRecibo = $("#dvRecibo").jSignature("getData", "image");
				$('#imgRecibo').val(dataRecibo[1]);
			});

            $('#btnLimpiarFirma').click(function() {
				$("#dvEntrega").jSignature("reset");
				$('#imgEntrega').val("");

                $("#dvRecibo").jSignature("reset");
				$('#imgRecibo').val("");
			});

            var canvas = document.querySelector( 'canvas' ),
                c = canvas.getContext( '2d' ),
                mouseX = 0,
                mouseY = 0,
                width = 500,
                height = 500,
                colour = 'hotpink',
                mousedown = false;

            // resize the canvas
            canvas.width = width;
            canvas.height = height;

            var img = document.getElementById("source");
            c.drawImage(img,10,10);

            function draw() {
                if (mousedown) {
                    // set the colour
                    c.fillStyle = colour;
                    c.globalAlpha = 0.5
                    // start a path and paint a circle of 20 pixels at the mouse position
                    c.beginPath();
                    c.arc( mouseX, mouseY, 10 , 0, Math.PI*2, true );
                    c.closePath();
                    c.fill();
                }
            }

            // get the mouse position on the canvas (some browser trickery involved)
            canvas.addEventListener( 'mousemove', function( event ) {
                if( event.offsetX ){
                    mouseX = event.offsetX;
                    mouseY = event.offsetY;
                } else {
                    mouseX = event.pageX - event.target.offsetLeft;
                    mouseY = event.pageY - event.target.offsetTop;
                }

                // call the draw function
                draw();
            }, false );

            canvas.addEventListener( 'mousedown', function( event ) {
                mousedown = true;
            }, false );

            canvas.addEventListener( 'mouseup', function( event ) {
                mousedown = false;
            }, false );

            $('#btnGenerar').click(function() {
                var dataURL = canvas.toDataURL('image/jpeg', 1);
                dataURL = dataURL.replace("image/jpeg", "image/octet-stream");
                document.location.href = dataURL;
            });

            $('#btnLimpiar').click(function() {
                c.clearRect(0, 0, canvas.width, canvas.height);
                c.drawImage(img,10,10);
            });
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