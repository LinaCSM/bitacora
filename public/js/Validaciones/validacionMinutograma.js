/**
 * Created by Administrador on 21/02/2017.
 */
var idProceso=null;
var idEntrega=null;

function validarEstado(estado) {
    if (estado === 'Fallido') {
        $("#registrarEntregable"+idProceso).modal({backdrop: "static"});
        $("#fallaEntregable"+idProceso).modal({backdrop: "static"});
        $("#registrarEntregable"+idProceso).modal("hide");
        $("#fallaEntregable"+idProceso).modal("show");
        document.getElementById("HFinalEntregable"+idProceso).style.display = "block";
        document.getElementById("EstadoJustificacion"+idProceso).style.display = "none";
    }else if (estado === 'No se ejecuta'){
        document.getElementById("HFinalEntregable"+idProceso).style.display = "none";
        document.getElementById("EstadoJustificacion"+idProceso).style.display = "block";
    }else{
        document.getElementById("HFinalEntregable"+idProceso).style.display = "block";
        document.getElementById("EstadoJustificacion"+idProceso).style.display = "none";
    }
};


function validarEstadoUpdate(estado) {


    if (estado === 'Fallido') {
        $("#updateEntregable"+idProceso).modal({backdrop: "static"});
        $("#fallaEntregableU"+idProceso).modal({backdrop: "static"});
        $("#updateEntregable"+idEntrega).modal("hide");
        $("#fallaEntregableU"+idProceso).modal("show");
        document.getElementById("HFinalEntregableE"+idEntrega).style.display = "block";
        document.getElementById("EstadoJustificacionE"+idEntrega).style.display = "none";
    }else if (estado === 'No se ejecuta'){
        document.getElementById("HFinalEntregableE"+idEntrega).style.display = "none";
        document.getElementById("EstadoJustificacionE"+idEntrega).style.display = "block";
    }else{
        document.getElementById("HFinalEntregableE"+idEntrega).style.display = "block";
        document.getElementById("EstadoJustificacionE"+idEntrega).style.display = "none";
    }
};


function validarEstadoFalla(estado) {
    if (estado === 'Solucionada') {
        document.getElementById("soluFalla"+idProceso).style.display = "block";
    }else{
        document.getElementById("soluFalla"+idProceso).style.display = "none";
    }
};
function validarEstadoFallaE(estado) {
    if (estado === 'Solucionada') {
        document.getElementById("soluFallaE"+idProceso).style.display = "block";
    }else{
        document.getElementById("soluFallaE"+idProceso).style.display = "none";
    }
};

$(document).ready(function () {
    $('#tablaEntregablesMañana').DataTable( {
        "order": [[ 3, "asc" ]]
    } );

    $('#tablaEntregablesTarde').DataTable( {
        "order": [[ 3, "asc" ]]
    } );

    $('#tablaEntregablesNoche').DataTable( {
        "order": [[ 3, "desc" ]]
    } );

    $('#tablaEntregablesMensuales').DataTable( {
        "order": [[ 3, "asc" ]]
    } );

    $('#tablaEntregablesSemanales').DataTable( {
        "order": [[ 3, "asc" ]]
    } );

    $('#tablaEntregablesDemanda').DataTable( {
        "order": [[ 3, "asc" ]]
    } );


    setTimeout(function() {
        $("#mensajeAlerta").fadeToggle();
    },2000);
});

function salirFalla() {
    $("#registrarEntregable"+idProceso).modal("show");
    $("#fallaEntregable"+idProceso).modal("hide");
    document.getElementById("estado"+idProceso).value=0;
};

function salirFallaU() {
    $("#updateEntregable"+idEntrega).modal("show");
    $("#fallaEntregableU"+idProceso).modal("hide");
    document.getElementById("estadoE"+idProceso).value=0;
};

function obtenerID(id) {
    idProceso=id;
    idEntrega = $('#e'+idProceso).val();
    datepicker();
};


/*Script para Datetimepicker*/
function datepicker() {
    $.datepicker.regional['es'] =
    {
        closeText: 'Cerrar',
        prevText: 'Previo',
        nextText: 'Próximo',
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
        monthStatus: 'Ver otro mes', yearStatus: 'Ver otro año',
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sáb'],
        dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
        dateFormat: 'dd/mm/yy', firstDay: 0,
        initStatus: 'Selecciona la fecha', isRTL: false};
    $.datepicker.setDefaults($.datepicker.regional['es']);

    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();

    if (h<=9)
        h="0"+h;
    if (m<=9)
        m="0"+m;
    if (s<=9)
        s="0"+s;
    hora=h + ":" + m + ":" + s;

    if (hora >= "00:00:00" && hora <= "21:59:59") {
        $("#fEntregableNoche" + idProceso).datepicker({maxDate: 0, dateFormat: 'yy-mm-dd'}).datepicker("setDate", "-1");
        $("#fEntregableNocheE" + idProceso).datepicker({
            maxDate: 0,
            dateFormat: 'yy-mm-dd'
        }).datepicker("setDate", "-1");
        $("#fEjecucionNoche" + idProceso).datepicker({maxDate: 0, dateFormat: 'yy-mm-dd'}).datepicker("setDate", "-1");
        $("#fechaEntregableFallaN" + idProceso).datepicker({maxDate: 0,dateFormat: 'yy-mm-dd'}).datepicker("setDate", "-1");
        $("#fechaEntregableFallaEN"+idProceso).datepicker({maxDate: 0, dateFormat: 'yy-mm-dd'}).datepicker("setDate","-1");
    }else if (hora >= "22:00:00" && hora <= "23:59:59") {
        $("#fEntregableNoche" + idProceso).datepicker({maxDate: 0, dateFormat: 'yy-mm-dd'}).datepicker("setDate", "0");
        $("#fEntregableNocheE" + idProceso).datepicker({maxDate: 0, dateFormat: 'yy-mm-dd'}).datepicker("setDate", "0");
        $("#fEjecucionNoche" + idProceso).datepicker({maxDate: 0, dateFormat: 'yy-mm-dd'}).datepicker("setDate", "0");
        $("#fechaEntregableFallaN"+idProceso).datepicker({maxDate: 0, dateFormat: 'yy-mm-dd'}).datepicker("setDate","0");
        $("#fechaEntregableFallaEN"+idProceso).datepicker({maxDate: 0, dateFormat: 'yy-mm-dd'}).datepicker("setDate","0");
    }

    $("#fEntregable"+idProceso).datepicker({maxDate: 0, dateFormat: 'yy-mm-dd'}).datepicker("setDate","0");
    $("#fEntregableE"+idProceso).datepicker({maxDate: 0, dateFormat: 'yy-mm-dd'}).datepicker("setDate","0");
    $("#fechaEjecucion"+idProceso).datepicker({maxDate: 0, dateFormat: 'yy-mm-dd'}).datepicker("setDate","0");
    $("#fechaEntregableFalla"+idProceso).datepicker({maxDate: 0, dateFormat: 'yy-mm-dd'}).datepicker("setDate","0");
    $("#fechaEntregableFallaE"+idProceso).datepicker({maxDate: 0, dateFormat: 'yy-mm-dd'}).datepicker("setDate","0");
    $('#horafEntregable'+idProceso).datetimepicker({
        format: 'LT'
    });
    $('#horafEntregableE'+idEntrega).datetimepicker({
        format: 'LT'
    });


};

$('#btnMañana').click(function() {
    document.getElementById('tablaMañana').style.display="block";
    document.getElementById('tablaTarde').style.display="none";
    document.getElementById('tablaNoche').style.display="none";
    document.getElementById('tMañana').style.display="block";
    document.getElementById('tTarde').style.display="none";
    document.getElementById('tNoche').style.display="none";
    $("#btnMañana").removeClass('btn-info');
    $("#btnTarde").addClass('btn-info');
    $("#btnNoche").addClass('btn-info');
});

$('#btnTarde').click(function() {
    document.getElementById('tablaMañana').style.display="none";
    document.getElementById('tablaTarde').style.display="block";
    document.getElementById('tablaNoche').style.display="none";
    document.getElementById('tMañana').style.display="none";
    document.getElementById('tTarde').style.display="block";
    document.getElementById('tNoche').style.display="none";
    $("#btnMañana").addClass('btn-info');
    $("#btnTarde").removeClass('btn-info');
    $("#btnNoche").addClass('btn-info');
});

$('#btnNoche').click(function() {
    document.getElementById('tablaMañana').style.display="none";
    document.getElementById('tablaTarde').style.display="none";
    document.getElementById('tablaNoche').style.display="block";
    document.getElementById('tMañana').style.display="none";
    document.getElementById('tTarde').style.display="none";
    document.getElementById('tNoche').style.display="block";
    $("#btnMañana").addClass('btn-info');
    $("#btnTarde").addClass('btn-info');
    $("#btnNoche").removeClass('btn-info');
});


/*VALIDACIONES AJAX*/

function ajaxStore(){
    var horaF = $('#horafEntregable'+idProceso).val();
    var asignacion = $('#asignacion'+idProceso).val();
    var estado = $('#estado'+idProceso).val();
    var justificacion= $('#JustificacionEstado'+idProceso).val();
    var semaforo= $('#semaforo'+idProceso).val();
    var turno= $('#turno'+idProceso).val();
    var idP=$('#proceso'+idProceso).val();

    if(turno!="Noche"){
        var fecha=$('#fEntregable'+idProceso).val();
    }else{
        var fecha=$('#fEntregableNoche'+idProceso).val();
    }


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type    :  'post',
        url     : '/Minutograma/store',
        data: {horaF:horaF,asignacion:asignacion,estado:estado,justificacion:justificacion, proceso_id:idP,
            semaforo:semaforo,turno:turno,fecha:fecha}
    });
};


function ajaxUp(){
    var horaFin = $('#horafEntregableE'+idEntrega).val();
    var entrega = $('#entrega'+idProceso).val();
    var estadoE = $('#estadoE'+idProceso).val();
    var justificacionE= $('#justificacionEstado'+idProceso).val();
    var turno= $('#turnoE'+idProceso).val();

    if(turno!="Noche"){
        var fechaE=$('#fEntregableE'+idProceso).val();
    }else{
        var fechaE=$('#fEntregableNocheE'+idProceso).val();
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: 'post',
        url: '/editEntrega',
        data: {horaFin:horaFin,idE:entrega,estadoE:estadoE,justificacionE:justificacionE, fechaE:fechaE,turnoE:turno}
    });
};

function ajaxFalla(){
    $("#registrarEntregable"+idProceso).modal("show");
    $("#fallaEntregable"+idProceso).modal("hide");

    var proceso = $('#proceso' + idProceso).val();
    var ncaso = $('#numeroCaso' + idProceso).val();
    var descripcionF = $('#descripcionFalla' + idProceso).val();
    var tipoF = $('#tipoFalla' + idProceso).val();
    var estadoF = $('#estadoFalla' + idProceso).val();
    var solucionF = $('#solucionFalla' + idProceso).val();
    var reprocesoP = $('#relanzarProceso' + idProceso).val();
    var turno = $('#turno' + idProceso).val();

    if(turno!="Noche"){
        var fecha = $('#fechaEntregableFalla' + idProceso).val();
    }else{
        var fecha = $('#fechaEntregableFallaN' + idProceso).val();
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: 'post',
        url: '/Falla/store',
        data: {idProceso: proceso, n_caso: ncaso, descripcion: descripcionF, tipo: tipoF, estado: estadoF,solucion: solucionF,
            turno:turno,fecha:fecha
        },
        success: function (resp) {
            if (resp != "") {
                alert("Falla guardada.");
                if(reprocesoP=="Si"){
                    document.getElementById('estado'+idProceso).value="Exitoso";
                    $('#btnF'+idProceso).attr('disabled', 'disabled');
                }
                if(reprocesoP=="No"){
                    document.getElementById('estado'+idProceso).value="Fallido";
                    $('#btnF'+idProceso).attr('disabled', 'disabled');
                }
                document.getElementById('estado'+idProceso).disabled="true";
            }
        },
        error: function (data) {
            alert("Falla no guardada.");
        }
    })
};

function ajaxFallaU(){
    $("#updateEntregable"+idEntrega).modal("show");
    $("#fallaEntregableU"+idProceso).modal("hide");

    var proceso = $('#procesoE' + idProceso).val();
    var ncaso = $('#numeroCasoE' + idProceso).val();
    var descripcionF = $('#descripcionFallaE' + idProceso).val();
    var tipoF = $('#tipoFallaE' + idProceso).val();
    var estadoF = $('#estadoFallaE' + idProceso).val();
    var solucionF = $('#solucionFallaE' + idProceso).val();
    var reprocesoP = $('#relanzarProcesoE' + idProceso).val();
    var turno = $('#turno' + idProceso).val();

    if(turno!="Noche"){
        var fecha = $('#fechaEntregableFallaE' + idProceso).val();
    }else{
        var fecha = $('#fechaEntregableFallaEN' + idProceso).val();
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: 'post',
        url: '/Falla/store',
        data: {idProceso: proceso, n_caso: ncaso, descripcion: descripcionF, tipo: tipoF, estado: estadoF,
            solucion: solucionF,turno:turno,fecha:fecha},
        success: function (resp) {
            if (resp != "") {
                alert("Falla guardada.");
                if(reprocesoP=="Si"){
                    document.getElementById('estadoE'+idProceso).value="Exitoso";
                    $('#btnFE'+idProceso).attr('disabled', 'disabled');
                }
                if(reprocesoP=="No"){
                    alert(reprocesoP)
                    document.getElementById('estadoE'+idProceso).value="Fallido";
                    $('#btnFE'+idProceso).attr('disabled', 'disabled');
                }
               document.getElementById('estadoE'+idProceso).disabled="true";
            }
        },
        error: function (data) {
            alert("Falla no guardada");
        }
    })
};

function ajaxEjecucion(){
    var turno = $('#turno' + idProceso).val();
    var estado = $('#estadoEje' + idProceso).val();
    var proceso= $('#proceso' + idProceso).val();
    var asignacion= $('#asignacion' + idProceso).val();

    if(turno!="Noche"){
        var fecha = $('#fechaEjecucion' + idProceso).val();
    }else{
        var fecha = $('#fEjecucionNoche' + idProceso).val();
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: 'post',
        url: '/Minutograma/registrarEjecucion',
        data: {fecha: fecha,idProceso:proceso, asignacion:asignacion,estado:estado,turno:turno}
    })
};

