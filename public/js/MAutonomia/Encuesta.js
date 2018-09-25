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
    var respuestaPreguntas= validarCamposDinamicos($('#crearEncuesta'),'TextoPregunta','input','*','','*La pregunta es obligatoria');
    var respuestaRespuesta= validarCamposDinamicos($('#crearEncuesta'),'TextoRespuesta','input','*','','*La respuesta es obligatoria');
    var respuestaPuntaje= validarCamposDinamicos($('#crearEncuesta'),'Puntaje','input','*','','*El puntaje es obligatorio');
    if ($("#crearEncuesta").valid() && respuestaTextArea && respuestaPreguntas && respuestaRespuesta) {
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

//Metodo para guarda la informacion de la categoria y retorna la vista con todos las categorias
function GuardarEncuesta() {
    PopupPosition();
    var form = $("#crearEncuesta");
    var token = $("#_token").val()
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

