/**
 * Created by Administrador on 14/03/2017.
 */
var idProceso=null;

function obtenerID(id) {
    idProceso=id;
    console.log(idProceso);
    datepicker();
    dias=document.getElementById('diasEjecucion'+idProceso).value;
    frecuencia=document.getElementById('frecuencia'+idProceso).value;
    document.getElementById("diasE"+idProceso).value=dias;

    console.log(dias);
    if(arrayValues.length==0 && frecuencia!="2"){
        arrayValues.push(dias);
    }

    document.getElementById("tamano"+idProceso).value=arrayValues.length;
    document.getElementById("tamano").value=arrayValues.length;
};


jQuery(document).ready(function() {

    // next step
    $('.editproceso-form .btn-next').on('click', function() {
        var parent_fieldset = $(this).parents('fieldset');
        var next_step = true;
        if( next_step ) {
            parent_fieldset.fadeOut(0, function() {
                $(this).next().fadeIn();
            });
        }
    });

    // previous step
    $('.editproceso-form .btn-previous').on('click', function() {
        $(this).parents('fieldset').fadeOut(0, function() {
            $(this).prev().fadeIn();
        });
    });


});

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

    $('#t_ejecucionE'+idProceso).datetimepicker({
        format: 'LT'
    });
    $('#h_ejecucionE'+idProceso).datetimepicker({
        format: 'LT'
    });
};

//var int = self.setInterval("traerArray()", 3000);


function traerArray()
{
    console.log(arrayValues);

}

function ajaxBPais($pais){

    var pais = $pais;

    console.log(pais,grupo);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: 'post',
        url: '/Proceso/buscarGrupos',
        data: {pais: pais},
        dataType: "html",
        success: function (data) {
            $('#grupo'+idProceso).empty();
            $.each(JSON.parse(data), function(key, value) {
                $('#grupo'+idProceso).append('<option value="'+ key +'">'+ value +'</option>');
            });
        }
    })
};

function ajaxBuscarPais($pais){

    var pais = $pais;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: 'post',
        url: '/Proceso/buscarGrupos',
        data: {pais: pais},
        dataType: "html",
        success: function (data) {
            $.each(JSON.parse(data), function(key, value) {
                $('#grupo').append('<option value="'+ key +'">'+ value +'</option>');
            });
        }
    })
};


function ajaxActualizarProceso(){

    var id=$('#id' + idProceso).val();
    var nombre=$('#nombre' + idProceso).val();
    var plataforma=$('#plataforma' + idProceso).val();
    var job=$('#job' + idProceso).val();
    var servidor=$('#servidor' + idProceso).val();
    var catalogo=$('#catalogo' + idProceso).val();
    var t_programada=$('#t_programada' + idProceso).val();
    var prerequisito=$('#prerequisito' + idProceso).val();
    var horario=$('#h_ejecucionE' + idProceso).val();
    var t_ejecucion=$('#t_ejecucionE' + idProceso).val();
    var sysdate=$('#sysdate' + idProceso).val();
    var semaforo=$('#semaforo' + idProceso).val();
    var grupo=$('#grupo' + idProceso).val();
    var turno=$('#turno' + idProceso).val();
    var tipo=$('#tipo' + idProceso).val();
    var justificacion=$('#justificacion' + idProceso).val();
    var frecuencia=$('#FrecuenciaFK' + idProceso).val();
    var dias=arrayValues;
    var tamano= $("#tamano"+idProceso).val();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: 'post',
        url: '/Proceso/actualizarP',
        data: {id:id, nombre:nombre,plataforma:plataforma,job:job, servidor:servidor, catalogo:catalogo, t_programada:t_programada,
        prerequisitos:prerequisito, horario:horario, t_ejecucion:t_ejecucion, sysdate:sysdate, semaforo:semaforo, FK_Grupo:grupo,
        FK_Turno:turno,FK_Tipo:tipo, justificacion:justificacion, diasFrecuencia:dias, tamano:tamano, FK_Frecuencia:frecuencia},
        success: function (resp) {
            if (resp != "") {
               console.log(tamano);
            }
        },
        error: function (data) {
            console.log(tamano);
        }
    })
};

function ajaxRegistrarProceso(){

    var nombre=$('#nombre').val();
    var plataforma=$('#plataforma').val();
    var job=$('#job').val();
    var servidor=$('#servidor').val();
    var catalogo=$('#catalogo').val();
    var t_programada=$('#tarea_programada').val();
    var prerequisito=$('#prerequisito').val();
    var horario=$('#horarioProceso').val();
    var t_ejecucion=$('#t_ejecucionProceso').val();
    var sysdate=$('#sysdate').val();
    var semaforo=$('#semaforoP').val();
    var grupo=$('#grupo').val();
    var turno=$('#turno').val();
    var tipo=$('#tipo').val();
    var frecuencia=$('#frecuencia').val();
    var dias=arrayValues;
    var tamano= $("#tamano").val();
    var tipoEntregable= $("#tipoE").val();
    var ruta= $("#ruta").val();

    alert(dias);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: 'post',
        url: '/Proceso/store',
        data: {nombre:nombre,plataforma:plataforma,job:job, servidor:servidor, catalogo:catalogo, t_programada:t_programada,
            prerequisitos:prerequisito, horario:horario, t_ejecucion:t_ejecucion, sysdate:sysdate, semaforo:semaforo, FK_Grupo:grupo,
            FK_Turno:turno,FK_Tipo:tipo, diasFrecuencia:dias, tamano:tamano, FK_Frecuencia:frecuencia,tipoEntregable:tipoEntregable,
            rutaEntregable:ruta},
        success: function (resp) {
            if (resp != "") {
                alert("U");
                console.log(tamano);
            }
        },
        error: function (data) {
            alert("E");
            console.log(tamano);
        }
    })
};
