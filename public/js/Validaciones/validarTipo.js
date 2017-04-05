/**
 * Created by Administrador on 10/02/2017.
 */

var idTipo=null;

function obtenerID($id) {
    idTipo=$id;
}

function validarCambioEstadoTipo(estadoRecibido){

    if(estadoRecibido==="Inactivo") {
        document.getElementById("justificacionEstadoTipo"+idTipo).style.display = "block";
        document.getElementById("informacionEstadoTipo"+idTipo).style.display="block";
    }
    if(estadoRecibido==="Activo"){
        document.getElementById("informacionEstadoTipo"+idTipo).style.display="none";
        document.getElementById("justificacionEstadoTipo"+idTipo).style.display="none";

    }
}

$(document).ready(function () {
    $('#tablaTipos').DataTable();
    $("li").removeClass("active");
    $("#general").addClass("active");
});
