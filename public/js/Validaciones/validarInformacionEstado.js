/**
 * Created by Administrador on 17/02/2017.
 */



function validarCambioEstadoProceso(estado){

    if(estado==="Inactivo"){
        document.getElementById("informacionEstado"+idProceso).style.display="block";
        document.getElementById("informacionEstadoB"+idProceso).style.display="none";
        document.getElementById('justificacionEstado'+idProceso).style.display = 'block';
    }
    if(estado==="Bloqueado"){
        document.getElementById("informacionEstado"+idProceso).style.display="none";
        document.getElementById("informacionEstadoB"+idProceso).style.display="block";
        document.getElementById('justificacionEstado'+idProceso).style.display = 'block';
    }
    if(estado==="Activo"){
        document.getElementById("informacionEstado"+idProceso).style.display="none";
        document.getElementById("informacionEstadoB"+idProceso).style.display="none";
        document.getElementById('justificacionEstado'+idProceso).style.display = 'none';
    }
}

function validarCambioReproceso(opcion){

    if(opcion==="Si"){
        document.getElementById("informacionEstadoSi"+idProceso).style.display="block";
        document.getElementById("informacionEstadoNo"+idProceso).style.display="none";
    }
    if(opcion==="No"){
        document.getElementById("informacionEstadoSi"+idProceso).style.display="none";
        document.getElementById("informacionEstadoNo"+idProceso).style.display="block";
    }

}

