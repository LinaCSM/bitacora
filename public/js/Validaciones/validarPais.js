/**
 * Created by Administrador on 22/03/2017.
 */
var idPais=null;
function obtenerID($id) {
    idPais=$id;
    console.log("idPais"+$id);
}
$(document).ready(function () {
    $('#tablaPaises').DataTable();
    $("li").removeClass("active");
    $("#general").addClass("active");
});

function validarCambioEstadoPais(estadoRecibido){

    if(estadoRecibido==="Inactivo") {
        document.getElementById("informacionEstadoPais"+idPais).style.display = "block";
        document.getElementById("justificacionEstadoPais"+idPais).style.display="block";
    }
    if(estadoRecibido==="Activo"){
        document.getElementById("informacionEstadoPais"+idPais).style.display="none";
        document.getElementById("justificacionEstadoPais"+idPais).style.display="none";

    }
}