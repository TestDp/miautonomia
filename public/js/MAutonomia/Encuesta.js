var urlBase = ""; //SE DEBE VALIDAR CUAL ES LA URL EN LA QUE SE ESTA CORRIENDO LA APP
var numeroPregunta = 0;
var numeroRespuesta = 0;

try {
    urlBase = obtenerUlrBase();
} catch (e) {
    console.error(e.message);
    throw new Error("El modulo transversales es requerido");
};

//Funcion para cargar la vista de crear Encuesta
function ajaxRenderSectionVistaCrearEncuesta() {
    PopupPosition();
    $.ajax({
        type: 'GET',
        url: urlBase +'vistaCrearEncuesta',
        dataType: 'json',
        success: function (data) {
            OcultarPopupposition();
            $('#principalPanel').empty().append($(data));
        },
        error: function (data) {
            OcultarPopupposition();
            var errors = data.responseJSON;
            if (errors) {
                $.each(errors, function (i) {
                    console.log(errors[i]);
                });
            }
        }
    });
}


//Funcion para mostrar la lista de encuestas
function ajaxRenderSectionListaEncuestas() {
    PopupPosition();
    $.ajax({
        type: 'GET',
        url: urlBase +'encuestas',
        dataType: 'json',
        success: function (data) {
            OcultarPopupposition();
            $('#principalPanel').empty().append($(data));
        },
        error: function (data) {
            OcultarPopupposition();
            var errors = data.responseJSON;
            if (errors) {
                $.each(errors, function (i) {
                    console.log(errors[i]);
                });
            }
        }
    });
}



function AgregarPregunta(){
    //funcionalidad de agregar y mostrar pregunta
    var divPregunta = $("#divPregunta").clone();
    divPregunta.attr("id","pregunta");
    divPregunta.attr("name","pregunta");
    divPregunta.find("a[name=eliminarPregunta]").attr("data-target","#modalElimianarPregunta"+numeroPregunta);
    divPregunta.find("div[name=modalElimianarPregunta]").attr("id","modalElimianarPregunta"+numeroPregunta);
    //bloque para asignar id diferentes a los modales de eliminar pregunta
    divPregunta.find("div[name=Respuesta]").each(function(ind,element){
        $(element).find("a[name=eliminarRespuesta]").attr("data-target","#modalElimianarRespuesta"+numeroRespuesta+numeroPregunta);
        $(element).find("div[name=modalElimianarRespuesta]").attr("id","modalElimianarRespuesta"+numeroRespuesta+numeroPregunta);
        numeroRespuesta++;
    });
    numeroPregunta++;
    $("#ListaPreguntas").append(divPregunta);
}

function  EliminarPregunta(element) {
    $("#elmentosEliminados").append($(element).closest("div[name=pregunta]"));
}

function  AgregarRespuesta(element){
    var divRespuesta = $("#RespuestaPlantilla").clone();
    divRespuesta.removeAttr('hidden')
    divRespuesta.attr("id","Respuesta");
    divRespuesta.attr("name","Respuesta");
    divRespuesta.find("a[name=eliminarRespuesta]").attr("data-target","#modalElimianarRespuesta"+numeroRespuesta+numeroPregunta);
    divRespuesta.find("div[name=modalElimianarRespuesta]").attr("id","modalElimianarRespuesta"+numeroRespuesta+numeroPregunta);
    $(element).closest("div[name=pregunta]").append(divRespuesta);
    numeroRespuesta++;
}

function  EliminarRespuesta(element) {
    $("#elmentosEliminados").append($(element).closest("div[name=Respuesta]"));
}

//Metodo para  editar los nombres  de los  elementos para  ser enviados  al  controlador
function EditarNombrePreguntasYRespuetas(){
    $("#ListaPreguntas").find("div[name=pregunta]").each(function (i,pregunta) {
        $(pregunta).find("input[name=TextoPregunta]").attr("name","Enunciado[" + i+ "]");
        $(pregunta).find("input[name=TextoRespuesta]").each(function (j,respuesta) {
            $(respuesta).attr("name","TextoRespuesta[" + i + "][" + j +"]");
        });
        $(pregunta).find("input[name=Puntaje]").each(function (j,puntaje) {
            $(puntaje).attr("name","Puntaje[" + i + "][" + j +"]");
        });
    });
}


function validarCamposCrearEncuesta() {
    validarFormularioCrearEncuesta();
    var respuestaTextArea = validarTextArea();
    var respuestaPreguntas = validarCamposDinamicos($('#crearEncuesta'),'TextoPregunta','input','*','','*La pregunta es obligatoria');
    var respuestaRespuesta = validarCamposDinamicos($('#crearEncuesta'),'TextoRespuesta','input','*','','*La respuesta es obligatoria');
    var respuestaPuntaje = validarCamposDinamicos($('#crearEncuesta'),'Puntaje','input','*','','*El puntaje es obligatorio');
    var respuestaCategoria = validarCamposDinamicos($('#crearEncuesta'),'Categoria_id','select','*','','*La categoría es obligatoria');
    var respuestaExplicacion = validarCamposDinamicos($('#crearEncuesta'),'Explicacion','input','*','','*La explicación es obligatoria');
    if ($("#crearEncuesta").valid() && respuestaTextArea && respuestaPreguntas &&
        respuestaRespuesta && respuestaPuntaje && respuestaExplicacion && respuestaCategoria) {
        EditarNombrePreguntasYRespuetas();
        $("#DescripcionEncuesta").val(CKEDITOR.instances['DesEncuesta'].getData());
        GuardarEncuesta();
    }

}

function validarFormularioCrearEncuesta(){
    $("#crearEncuesta").validate({
        rules: {
            NombreEncuesta: {
                required: true
            }
        },
        messages: {
            NombreEncuesta: {
                required: "*El nombre de la encuesta es obligatorio"
            }
        }

    });

}

//función para validar que el textarea tenga contenido
function validarTextArea() {
    var respuesta = true;
    var valtextArea = CKEDITOR.instances['DesEncuesta'].getData();
    if(valtextArea =='')
    {
        $("#errorTextArea").text("*La descripción es obligatoria");
        respuesta =false;
    }else{
        $("#errorTextArea").text('');
    }
    return respuesta;
}

//función para guarda la informacion de la categoria y retorna la vista con todos las categorias
function GuardarEncuesta() {
    PopupPosition();
    var form = $("#crearEncuesta");
    var token = $("#_token").val();
    $.ajax({
        type: 'POST',
        url: urlBase +'guardarEncuesta',
        dataType: 'json',
        headers: {'X-CSRF-TOKEN': token},
        data:form.serialize(),
        success: function (data) {
            OcultarPopupposition();
            swal({
                title: "Transaccción exitosa!",
                text: "La encuesta fue grabada con exito!",
                icon: "success",
                button: "OK",
            });
            $('#principalPanel').empty().append($(data));
        },
        error: function (data) {
            OcultarPopupposition();
            swal({
                title: "Transacción con error!",
                text: "No fue posible grabar la encuesta!",
                icon: "error",
                button: "OK",
            });

        }
    });
}

//función para guardar la respuesta del usuario
function guardarRespuestaUsuario(element,idrespuesta) {
    $.ajax({
        type: 'GET',
        url: urlBase +'guardarRespuesta/'+idrespuesta,
        dataType: 'json',
        success: function (respuestaPeticion) {
            if(respuestaPeticion)
            {
                $(element).closest('fieldset[name=RespuestasUsuario]').find('input').each(function (j,respuestaUsuario) {
                    $(respuestaUsuario).attr('disabled','disabled');
                });
                $(element).removeAttr('disabled');
                $(element).removeAttr('onclick');
            }
        },
        error: function (data) {
            var errors = data.responseJSON;
            if (errors) {
                $.each(errors, function (i) {
                    console.log(errors[i]);
                });
            }
        }
    });
}

//función para validar que todas las preguntas sean respuestas
function validarRespuetas() {
    var respuesta = true;
    var puntajeTotal=0;
    $('#seccionPreguntas').find('fieldset[name=RespuestasUsuario]').each(function (j,pregunta) {
        var respuestaPregunta = true;
        $(pregunta).find('input[type=radio]').each(function (j,respuestaUsuario) {
            if( $(respuestaUsuario).prop( "checked" )){
                puntajeTotal = puntajeTotal + parseInt($(respuestaUsuario).data('num'));
                respuestaPregunta = false;
            }
        });
        if(respuestaPregunta){
            $(pregunta).find('label[name=respuestaSinResponder]').text('*se debe seleccionar una opción');
            respuesta=false;
        }else{
            $(pregunta).find('label[name=respuestaSinResponder]').text('');
        }
    });
    if(respuesta){
        swal({
            title: "Encuesta registrada con exito,su puntaje fue: " + puntajeTotal + " Puntos!",
            text: "Muchas gracias por responder la encuesta ",
            icon: "success",
            button: "OK",
        }).then((value) => {
            window.location.href = '../encuestas';
        });
    }
    /**else{
        swal({
            title: "Faltan preguntas por responder!",
            text: "se deben responder todas la preguntas para finalizar!",
            icon: "error",
            button: "OK",
        });
    }*/
}

function verEstadisticas(element,idEncuesta,idUsuario) {
    var token = $("#_token").val();
    PopupPosition();
    $.ajax({
        type: 'POST',
        url: urlBase +'estadisticas',
        dataType: 'json',
        headers: {'X-CSRF-TOKEN': token},
        data:{idEncuesta:idEncuesta,idUsuario:idUsuario},
        success: function (data) {
            OcultarPopupposition();
            $('#panelRespuestas').empty().append($(data));
            pintarFilaSelecciona(element)
        },
        error: function (data) {
            OcultarPopupposition();
        }
    });
}

function pintarFilaSelecciona(element)
{
    $(element).closest('tbody').find('tr').each(function (j,tr) {
        $(tr).removeAttr('style');
    });
    $(element).closest('tr').attr("style","background: #dff0d8");
}

function verUsuariosEncuestados(idEncuesta) {
    var token = $("#_token").val();
    PopupPosition();
    $.ajax({
        type: 'POST',
        url: urlBase +'usuariosEncuestados',
        dataType: 'json',
        headers: {'X-CSRF-TOKEN': token},
        data:{idEncuesta:idEncuesta},
        success: function (data) {
            OcultarPopupposition();
            $('#principalPanel').empty().append($(data));
        },
        error: function (data) {
            OcultarPopupposition();
        }
    });
}

function mostrarLiSiguiente(numeroLi) {
    var numeroLisiguiente =  numeroLi +1;
    $('#seccionPreguntas').find('li[name=li'+numeroLi+']').attr('hidden','hidden');
    $('#seccionPreguntas').find('li[name=li'+numeroLisiguiente+']').removeAttr('hidden');
}