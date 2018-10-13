var urlBase = ""; //SE DEBE VALIDAR CUAL ES LA URL EN LA QUE SE ESTA CORRIENDO LA APP
var numeroPregunta = 0;
var numeroRespuesta = 0;

var arrayColores= ["#000033","#0000CC","#003300","#0033FF","#006600","#006699",
    "#0066CC","#009966","#009999","#0099CC","#0099FF","#00CC99","#00CCCC","#00CCFF","#00FF00","#00FF33",
    "#00FF66","#00FF99","#330033","#330066","#330099","#3300CC","#3300FF","#333300","#333333","#333366","#333399","#3333CC","#3333FF",
    "#336600","#336633","#336666","#336699","#3366CC","#3366FF","#339900","#339933","#339966","#339999","#3399CC","#3399FF","#33CC00","#33CC33","#33CC66","#33CC99",
    "#66FF33","#66FF66","#66FF99","#66FFCC","#99CC00","#99CC33","#99CC66","#99FF00","#99FF33","#99FF66",
    "#99FF99","#99FFCC","#99FFFF","#CC0000","#CC00CC","#CC00FF","#CC3300","#CC3333","#CC3366","#CC3399","#CC33CC","#CC33FF","#CC6600",
    "#CC6633","#FF0066","#FF0099","#FF00CC","#FF00FF","#FF3300","#FF3333","#FF3366","#FF3399","#FF33CC","#FF33FF","#FF6600","#FF6633","#FF6666","#FF6699","#FF66CC",
    "#FF66FF","#FF9900","#FF9933","#FF9966","#FF9999"];

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
            title: "¡Gracias por participar en MiAutonomía, tu puntaje fue de: " + puntajeTotal + " Puntos!",
			imageUrl: 'http://mujeresquecrean.org/miautonomia/images/Logo.png',
            text: "Muchas gracias por responder la encuesta",
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

function verEstadisticas1(element,idEncuesta,idUsuario) {
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

function verEstadisticas(idEncuesta) {
    var token = $("#_token").val();
    PopupPosition();
    $.ajax({
        type: 'POST',
        url: urlBase +'estadisticasGenerales',
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


function validarCamporEstadisticas() {
    validarFormularioEstadisticas()
    if ($("#formEstadisticas").valid()) {
        construirGraficoEstadisticas()
    }
}

function validarFormularioEstadisticas(){
    $("#formEstadisticas").validate({
        rules: {
            Pregunta_id: {
                required: true
            }
        },
        messages: {
            Pregunta_id: {
                required: "*Se debe seleccionar una pregunta"
            }
        }

    });

}

function construirGraficoEstadisticas() {
    var token = $("#_token").val();
    var idEncuesta = $("#idEncuesta").val();
    var idPregunta = $("#Pregunta_id").val();
    var Sexo = $("#Sexo").val();
    var RangoEdad = $("#RangoEdad").val();
    $.ajax({
        type: 'POST',
        url: urlBase +'GenerarEstadisticas',
        dataType: 'json',
        headers: {'X-CSRF-TOKEN': token},
        data:{idEncuesta:idEncuesta,idPregunta:idPregunta,Sexo:Sexo,RangoEdad:RangoEdad},
        success: function (result) {
            if (result) {
                $("#divCanvas").html("");
                $("#divCanvas").append('<canvas style="height:600px !important;" id="canvasEstadisticasGenerales" class="img-responsive"></canvas>');
                var ctx = document.getElementById('canvasEstadisticasGenerales');
                var data = {
                    labels: result.etiquetas,
                    datasets: [
                        {
                            data: result.Cantidad,
                            backgroundColor: arrayColores
                        }]
                }
                var myPieChart = new Chart(ctx, {
                    type: 'pie',
                    data: data
                });
            }
        }
    });
}