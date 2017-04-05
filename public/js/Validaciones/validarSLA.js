/**
 * Created by Administrador on 10/02/2017.
 */

var idSLA=null;

function obtenerID($id) {
    idSLA=$id;
    datepicker();
}

function validarCambioEstadoSLA(estadoRecibido){

    if(estadoRecibido==="Inactivo") {
        document.getElementById("justificacionEstadoSLA"+idSLA).style.display = "block";
    }
    if(estadoRecibido==="Activo"){
        document.getElementById("justificacionEstadoSLA"+idSLA).style.display="none";

    }
}

$(document).ready(function () {
    $('#tablaSLA').DataTable( {
        "order": [[ 1, "asc" ]]
    } );
    $("li").removeClass("active");
    $("#general").addClass("active");

    $('#h_atraso').datetimepicker({
        format: 'LT'
    });
});

function datepicker() {

    $('#h_atrasoE'+idSLA).datetimepicker({
        format: 'LT'
    });
}

function ajaxActualizarSLA(){
    var id= $('#idSLA' + idSLA).val();
    var porcentaje= $('#porcentaje' + idSLA).val();
    var hora_atraso= $('#h_atrasoE' + idSLA).val();
    var estado= $('#estado' + idSLA).val();
    var justificacion= $('#justificacion' + idSLA).val();


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: 'post',
        url: '/SLA/actualizarSLA',
        data: {id:id,porcentaje:porcentaje, hora_atraso:hora_atraso, estado:estado,justificacion:justificacion}
    })
};

function ajaxRegistrarSLA(){
    var porcentaje= $('#porcentaje').val();
    var hora_atraso= $('#h_atraso').val();


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: 'post',
        url: '/SLA/store',
        data: {porcentaje:porcentaje, hora_atraso:hora_atraso}
    })
};