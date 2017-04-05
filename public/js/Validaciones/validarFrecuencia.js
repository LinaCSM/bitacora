/**
 * Created by Administrador on 10/02/2017.
 */

var idFrecuencia=null;

function obtenerID($id) {
    idFrecuencia=$id;
}

function validarCambioEstadoFrecuencia(estadoRecibido){

    if(estadoRecibido==="Inactivo") {
        document.getElementById("justificacionEstadoFrecuencia"+idFrecuencia).style.display = "block";
        document.getElementById("informacionEstadoFrecuencia"+idFrecuencia).style.display="block";
    }
    if(estadoRecibido==="Activo"){
        document.getElementById("informacionEstadoFrecuencia"+idFrecuencia).style.display="none";
        document.getElementById("justificacionEstadoFrecuencia"+idFrecuencia).style.display="none";

    }
}
