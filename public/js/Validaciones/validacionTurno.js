/**
 * Created by Administrador on 22/03/2017.
 */

idTurno=null;
function obtenerIDT($id) {
    idTurno=$id;
    datepicker();
}

function datepicker() {
    $('#horaInicioTurnoE'+idTurno).datetimepicker({
        format: 'LT'
    });

    $('#horaFinalTurnoE'+ idTurno).datetimepicker({
        format: 'LT'
    });
}

$(document).ready(function () {
    $('#tablaTurnos').DataTable( {
        "order": [[ 1, "asc" ]]
    } );
    $("li").removeClass("active");
    $("#general").addClass("active");


    $('#horaInicioTurno').datetimepicker({
        format: 'LT'
    });

    $('#horaFinalTurno').datetimepicker({
        format: 'LT'
    });

});


function validarCambioEstado(estadoRecibido){

    if(estadoRecibido==="Inactivo") {
        document.getElementById("informacionEstado"+idTurno).style.display = "block";
        document.getElementById("justificacionEstadoTurno"+idTurno).style.display = "block";

    }
    if(estadoRecibido==="Activo"){
        document.getElementById("informacionEstado"+idTurno).style.display="none";
        document.getElementById("justificacionEstadoTurno"+idTurno).style.display="none";
    }
}

function ajaxActualizarTurno(){
    var id= $('#idTurno' + idTurno).val();
    var nombre= $('#nombre' + idTurno).val();
    var hora_inicio= $('#horaInicioTurnoE' + idTurno).val();
    var hora_final= $('#horaFinalTurnoE' + idTurno).val();
    var estado= $('#estado' + idTurno).val();
    var justificacion= $('#justificacion' + idTurno).val();


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: 'post',
        url: '/Turno/actualizarTurno',
        data: {id:id,nombre:nombre, hora_inicio:hora_inicio, hora_final:hora_final,estado:estado,justificacion:justificacion}
    })
};

function ajaxRegistrarTurno(){
    var nombre= $('#nombre').val();
    var hora_inicio= $('#horaInicioTurno').val();
    var hora_final= $('#horaFinalTurno').val();


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: 'post',
        url: '/Turno/store',
        data: {nombre:nombre, hora_inicio:hora_inicio, hora_final:hora_final}
    })
};

