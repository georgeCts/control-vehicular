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

