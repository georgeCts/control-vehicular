//CAMBIO DE STATUS DE VEHICULOS
function cambioStatus(url, pkVehiculo, pkStatus) {
    var urlAccion = url+pkVehiculo+'/'+pkStatus;
    var colores = ['','primary','success','warning','danger'];
    var nombres = ['','Asignado','Disponible', 'En Taller', 'Fuera de servicio'];
    $.ajax(urlAccion).done(function(response) {
        if(response == "true") {        
            $('#status_'+pkVehiculo).removeClass(function(index, className) {
                return (className.match (/(^|\s)btn-\S+/g) || []).join(' ');
            });
            $('#status_'+pkVehiculo).addClass('btn-sm btn-'+colores[pkStatus]);
            $('#status_'+pkVehiculo).html(nombres[pkStatus]);
    
            swal({
                title: "¡Bien Hecho!",
                text: "La acción deseada se ha realizado con éxito.",
                type: "success",
            });
        }
    }).fail(function() {
        swal("¡Error!", "La acción deseada no ha podido completarse. Intenta nuevamente", "error");
    });
}

//CAMBIO DE IMAGEN DE INCIDENTES
function subirFotoInc(pkIncidente, token)
{
    $('#incidentePhotoForm').submit(function(event) {
        event.preventDefault();
    })

    var enlace = "/panel/vehiculos/subir_foto_inc";
    var msgExito = '<div class="alert alert-success"><button data-dismiss="alert" class="close" type="button">×</button><strong>¡Fotografía actualizada!</strong></div>';

    formData = new FormData();
    if($('#image').prop('files').length > 0)
    {
        file = $('#image').prop('files')[0];
        formData.append("pkIncidente", pkIncidente);
        formData.append("_token", token);
        formData.append("image", file);
        
        $.ajax({
            url: enlace,
            type: "POST",
            data: formData,
            dataType: "json",
            processData: false,
            contentType: false,
            success: function(result) {
                if(result.response) {
                    $("#load-photo-msg").html(msgExito);
                    $("#photo-loaded").html('<a href="https://s3.amazonaws.com/control-vehicular/'+result.url_imagen+'" target="_blank"><img class="img-thumbnail img-fluid" src="https://s3.amazonaws.com/control-vehicular/'+result.url_imagen+'" alt=""></a>');
                }
           } 
        }).fail(function() {
            swal("¡Error!", "La acción deseada no ha podido completarse. Intenta nuevamente", "error");
        });
    }

}

//CAMBIO DE DOCUMENTO DE GASTOS
function subirDocGastoAdicional(pkGastoAdicional, token)
{
    $('#docGastoForm').submit(function(event) {
        event.preventDefault();
    })

    var enlace = "/panel/vehiculos/subir_doc_gasto";
    var msgExito = '<div class="alert alert-success"><button data-dismiss="alert" class="close" type="button">×</button><strong>¡Documento cargado!</strong></div>';

    formData = new FormData();
    if($('#documento').prop('files').length > 0)
    {
        file = $('#documento').prop('files')[0];
        formData.append("pkGastoAdicional", pkGastoAdicional);
        formData.append("_token", token);
        formData.append("documento", file);
        
        $.ajax({
            url: enlace,
            type: "POST",
            data: formData,
            dataType: "json",
            processData: false,
            contentType: false,
            success: function(result) {
                if(result.response) {
                    $("#load-doc-msg").html(msgExito);
                    $("#doc-loaded").html('<p>Este gasto tiene un documento anexo que puedes consultar a continuaci&oacute;n:</p><a href="https://s3.amazonaws.com/control-vehicular/'+result.url_documento+'" class="btn btn-sm btn-primary waves-effect waves-light" target="_blank">Ver Documento</a>');
                }
           } 
        }).fail(function() {
            swal("¡Error!", "La acción deseada no ha podido completarse. Intenta nuevamente", "error");
        });
    }

}

//CAMBIO DE IMAGEN DE INSPECCIONES
function subirFotoIns(pkInspeccion, token)
{
    $('#inspeccionPhotoForm').submit(function(event) {
        event.preventDefault();
    })

    var enlace = "/panel/vehiculos/subir_foto_ins";
    var msgExito = '<div class="alert alert-success"><button data-dismiss="alert" class="close" type="button">×</button><strong>¡Fotografía cargada!</strong></div>';

    formData = new FormData();
    if($('#image').prop('files').length > 0)
    {
        file = $('#image').prop('files')[0];
        formData.append("pkInspeccion", pkInspeccion);
        formData.append("_token", token);
        formData.append("image", file);
        
        $.ajax({
            url: enlace,
            type: "POST",
            data: formData,
            dataType: "json",
            processData: false,
            contentType: false,
            success: function(result) {
                if(result.response) {
                    $("#load-photo-msg").html(msgExito);                    
                    $("#dvImagenes").append('<div class="col-md-6"><a href="https://s3.amazonaws.com/control-vehicular/result.url_imagen" target="_blank"><img class="img-thumbnail img-fluid" src="https://s3.amazonaws.com/control-vehicular/' + result.url_imagen + '" /></a><button class="btn btn-danger" onclick="confAccion(\'/panel/vehiculos/eliminar_foto_ins/' + result.pk_fichero + '\', \'/panel/vehiculos/inspecciones/subir_fotos/' + result.pk_inspeccion + '\', \'La imagen será eliminada\')">Eliminar</button></div>');
                }
           } 
        }).fail(function() {
            swal("¡Error!", "La acción deseada no ha podido completarse. Intenta nuevamente", "error");
        });
    }

}

//CARGAR DOCUMENTO DEL VEHÍCULO
function subirDocVeh(pkVehiculo, token) 
{
    $('#vehiculoDocumentoForm').submit(function(event) {
        event.preventDefault();
    })

    var enlace = "/panel/vehiculos/subir_doc_veh";
    var txtTitulo = $("#txtTitulo").val() == '' ? 'Sin Nombre' : $("#txtTitulo").val();
    var msgLoad = '<div class="alert alert-warning"><button data-dismiss="alert" class="close" type="button">×</button><strong>Cargando documento...</strong></div>';
    var msgExito = '<div class="alert alert-success"><button data-dismiss="alert" class="close" type="button">×</button><strong>¡Documento cargado!</strong></div>';

    formData = new FormData();
    if($('#file').prop('files').length > 0)
    {
        file = $('#file').prop('files')[0];
        formData.append("pkVehiculo", pkVehiculo);
        formData.append("txtTitulo", txtTitulo);
        formData.append("txtDescripcion", $("#txtDescripcion").val());
        formData.append("_token", token);
        formData.append("file", file);

        $.ajax({
            url: enlace,
            type: "POST",
            data: formData,
            dataType: "json",
            processData: false,
            contentType: false,
            success: function(result) {
                if(result.response) {
                    $("#load-doc-msg").html(msgExito);                    
                    $("#txtTitulo").val("");
                    $("#txtDescripcion").val("");

                    $('#dtDocumentos tbody').append(`
                        <tr class="item-documento-${result.pk_vehiculo_documento}">
                            <td class="text-left"><i class="fa fa-file-text"></i></td>
                            <td class="text-left">
                                <a target="_blank" href="https://s3.amazonaws.com/control-vehicular/${result.url_documento}">${result.titulo}</a>
                            </td>
                            <td class="text-left">${result.descripcion}</td>
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="fa fa-cog"></span>
                                        <span class="fa fa-angle-down"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#" onclick="borrarDocVeh(${result.pk_vehiculo_documento}, '${token}')"><i class="fa fa-trash"></i> Eliminar</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    `);                    
                }
           } 
        }).fail(function() {
            swal("¡Error!", "La acción deseada no ha podido completarse. Intenta nuevamente", "error");
        });
    }
}

//ELIMINAR DOCUMENTO DEL VEHICULO
function borrarDocVeh(pkVehiculoDocumento, token) {

    var enlace = "/panel/vehiculos/borrar_doc_veh/" + pkVehiculoDocumento;

    $.ajax({
        url: enlace,
        type: "GET",
        dataType: "json",
        success: function(result) {
            if(result) {
                $('.item-documento-' + pkVehiculoDocumento).remove();
                
                swal({
                    title: "¡Realizado!",
                    text: "La acción deseada se ha realizado con éxito.",
                    type: "success",
                });
            }
       } 
    }).fail(function() {
        swal("¡Error!", "La acción deseada no ha podido completarse. Intenta nuevamente", "error");
    });
}

//ACCIÓN DE CONFIGURACIÓN
function confAccion(urlAccion, urlGo, msg) 
{
    $(function(){
        swal({
            title: "¿Estás seguro?",
            text: msg,
            type: "info",
            showCancelButton: true,
            confirmButtonClass: 'btn-info waves-effect waves-light',
            confirmButtonText: "Si, adelante",
            cancelButtonText: "No, cancelar",
        }).then((result) => {
            if(result.value)
            {                
                $.ajax(urlAccion).done(function() {
                    swal({
                        title: "¡Realizado!",
                        text: "La acción deseada se ha realizado con éxito.",
                        type: "success",
                    }).then(() => {
                        window.location.href = urlGo;
                    })
                }).fail(function() {
                    swal("¡Error!", "La acción deseada no ha podido completarse. Intenta nuevamente", "error");
                });
            }
        })
    });
}

