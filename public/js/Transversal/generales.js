//funcion para obtener la url en al cual se esta ejecuntando la aplicación
function obtenerUlrBase() {
    var rootFolder = "";
    switch (document.location.hostname) {
        case 'facin.co':
            rootFolder = '/'; break;
        case 'localhost':
            rootFolder = '/miautonomia/trunk/public/'; break;
        default:  // set whatever you want
    }
    var urlBase = location.protocol + '//' + location.hostname + (location.port ? ':' + location.port : '') + rootFolder;
    return urlBase;
};


//Muestra los divs que se utilizan para mostrar
//el efecto de espera en una petición ajax.
function PopupPosition() {
    var topLoading = $(window).scrollTop() + ($(window).height() / 2);
    var leftLoading = $(window).scrollLeft() + ($(window).width() / 2);
    //$("#capa_loading").css({ "top": $(window).scrollTop() }).show();
    $("#capa_loading").show();
    $("#_loading").css({ "top": topLoading, "left": leftLoading }).show();
}

//Oculta los divs que se utilizan para mostrar
//el efecto de espera en una petición ajax.
function OcultarPopupposition() {
    $("#capa_loading").hide();
    $("#_loading").hide();
}