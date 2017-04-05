/**
 * Created by Administrador on 10/02/2017.
 */
/**
 * Created by Administrador on 10/02/2017.
 */

/*Script para Datepicker*/
$(function () {
    var  dateFormat= 'yy-mm-dd',
        from=$('#searchFechaProcesoI').datepicker({
            defaultDate:"+lw",
            dateFormat: 'yy-mm-dd'
        }).on("change", function () {
            to.datepicker("option","minDate",getDate(this));
        }),
        to= $('#searchFechaProcesoF').datepicker({
            defaultDate:"+lw",
            dateFormat: 'yy-mm-dd'
        }).on("change", function () {
            from.datepicker("option","maxDate",getDate(this));
        });

    function getDate(element) {
        var date;
        try{
            date=$.datepicker.parseDate(dateFormat, element.value)  ;
        }
        catch(error){
            date=null;
        }
        return date;
    }
});


$('#btnFiltro').click(function() {
    document.getElementById('filtros').style.display = 'block';
    document.getElementById('formularioFiltros').style.display = 'block';
    document.getElementById('btnFiltro').style.display = 'none';
    document.getElementById('btnTodos').style.display = 'block';

});

$('#btnTodos').click(function() {
    document.getElementById('filtros').style.display = 'none';
    document.getElementById('formularioFiltros').style.display = 'none';
    document.getElementById('btnFiltro').style.display = 'block';
    document.getElementById('btnTodos').style.display = 'none';
});

$(document).ready(function () {
    $("li").removeClass("active");
    $("#reportes").addClass("active");
    $('#tablaEntregablesR').dataTable();
    $('#tablaSemaforoDiario').dataTable();
    $('#horarioEjecucion').datetimepicker({
        format: 'LT'
    });

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

    $("#fechaFiltro").datepicker({dateFormat: 'yy-mm-dd'}).datepicker("setDate","0");

});

