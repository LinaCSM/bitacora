/**
 * Created by Administrador on 22/03/2017.
 */
var idGrupo=null;
function obtenerID($id) {
    idGrupo=$id;
}
$(document).ready(function () {
    $('#tablaGrupos').DataTable();
    $("li").removeClass("active");
    $("#general").addClass("active");
});

function validarCambioEstadoGrupo(estadoRecibido){

    if(estadoRecibido==="Inactivo") {
        document.getElementById("informacionEstadoGrupo"+idGrupo).style.display = "block";
        document.getElementById("justificacionEstadoGrupo"+idGrupo).style.display="block";
    }
    if(estadoRecibido==="Activo"){
        document.getElementById("informacionEstadoGrupo"+idGrupo).style.display="none";
        document.getElementById("justificacionEstadoGrupo"+idGrupo).style.display="none";

    }
}