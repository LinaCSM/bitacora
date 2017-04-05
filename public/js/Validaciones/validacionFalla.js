/**
 * Created by Administrador on 15/02/2017.
 */
var idF=null;
function obtenerID(id) {
    idProceso=id;
};

function obtenerIDFalla(id) {
    idF=id;
};

function validarEstadoFalla(estado) {
    if (estado === 'Solucionada') {
        document.getElementById("solucionFalla"+idF).style.display = "block";
    }else{
        document.getElementById("solucionFalla"+idF).style.display = "none";
    }
};

$(function () {
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

    $("#searchFechaFalla").datepicker({dateFormat: 'yy-mm-dd'});

});

$(document).ready(function () {
    $('#tablaFalla').DataTable( {
        "order": [[ 1, "asc" ]]
    } );

    $('#tablaFallaMensuales').DataTable( {
        "order": [[ 6, "asc" ]]
    } );
});

$('#btnFiltro').click(function traerFiltros() {
    document.getElementById('filtros').style.display = 'block';
    document.getElementById('formularioFiltros').style.display = 'block';
    document.getElementById('btnFiltro').style.display = 'none';
    document.getElementById('btnTodos').style.display = 'block';
});

$('#btnTodos').click(function traerFiltros() {
    document.getElementById('filtros').style.display = 'none';
    document.getElementById('formularioFiltros').style.display = 'none';
    document.getElementById('btnFiltro').style.display = 'block';
    document.getElementById('btnTodos').style.display = 'none';
});


function ajaxCambiarEstadoFalla(){
    var idFalla= $('#idF' + idF).val();;
    var estado= $('#estadoFalla' + idF).val();
    var solucion= $('#solucion' + idF).val();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: 'post',
        url: '/Falla/actualizarEstado',
        data: {idFallaU:idFalla,estadoU:estado, solucionU:solucion}
    })
};

