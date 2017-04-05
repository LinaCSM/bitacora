/**
 * Created by Administrador on 17/03/2017.
 */

idCargue=null;
tipoUsuario=null;
function obtenerID(id) {
    idCargue = id;
    datepicker();
}

function cambiarEstado(estado) {
    if (estado === 'Represado' || estado === 'Detenido' || estado === 'Fallando') {
        document.getElementById('justificacionEstadoC'+idCargue).style.display = 'block';
    } else {
        document.getElementById('justificacionEstadoC'+idCargue).style.display = 'none';
    }
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

    $('#horaEjecucion'+idCargue).datetimepicker({
        format: 'LT'
    });

};



$(document).ready(function () {
    $('#tablaCarguesColombia').dataTable();
    $('#tablaCarguesPanama').dataTable();
    $("li").removeClass("active");
    $("#cargue").addClass("active");

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

    tipoUsuario=$("#tipoU").val();
});

$('#btnColombia').click(function() {
    document.getElementById('tablaColombia').style.display="block";
    document.getElementById('tablaPanama').style.display="none";
    document.getElementById('tColombia').style.display="block";
    document.getElementById('tPanama').style.display="none";
    if(tipoUsuario==="1" ||tipoUsuario==="2" ){
        document.getElementById('exportarColombia').style.display="block";
        document.getElementById('exportarPanama').style.display="none";
    }
    $("#btnColombia").removeClass('btn-info');
    $("#btnPanama").addClass('btn-info');
});

$('#btnPanama').click(function() {
    document.getElementById('tablaColombia').style.display="none";
    document.getElementById('tablaPanama').style.display="block";
    document.getElementById('tColombia').style.display="none";
    document.getElementById('tPanama').style.display="block";
    if(tipoUsuario==="1" ||tipoUsuario==="2" ){
        document.getElementById('exportarColombia').style.display="none";
         document.getElementById('exportarPanama').style.display="block";
    }
    $("#btnColombia").addClass('btn-info');
    $("#btnPanama").removeClass('btn-info');
});


function ajaxBPais($pais){

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
            $('#grupo'+idCargue).empty();
            $.each(JSON.parse(data), function(key, value) {
                $('#grupo'+idCargue).append('<option value="'+ key +'">'+ value +'</option>');
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
                $('#grupoCargue').append('<option value="'+ key +'">'+ value +'</option>');
            });
        }
    })
};


function ajaxActualizarCargue(){

    var id=$('#id' + idCargue).val();
    var nombre=$('#nombre' + idCargue).val();
    var t_archivo=$('#archivo' + idCargue).val();
    var plataforma=$('#plataforma' + idCargue).val();
    var servidor=$('#servidor' + idCargue).val();
    var catalogo=$('#catalogo' + idCargue).val();
    var bd=$('#bd' + idCargue).val();
    var job=$('#job' + idCargue).val();
    var tarea=$('#tarea' + idCargue).val();
    var ruta=$('#ruta' + idCargue).val();
    var periodicidad=$('#periodicidad' + idCargue).val();
    var horario=$('#horaEjecucion' + idCargue).val();
    var tipo=$('#tipo' + idCargue).val();
    var grupo=$('#grupo' + idCargue).val();
    var idCG=$('#cargueGrupo' + idCargue).val();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: 'post',
        url: '/Cargue/actualizarCargue',
        data: {id:id, nombre:nombre,t_archivo:t_archivo,plataforma:plataforma,servidor:servidor, catalogo:catalogo, bd:bd,
            job:job, tarea:tarea,ruta:ruta, periodicidad:periodicidad, horario:horario, tipo:tipo, FK_Grupo:grupo, idCG:idCG}

    })
};

function ajaxRegistrarCargue(){

    var nombre=$('#nombre').val();
    var t_archivo=$('#tipo_archivo').val();
    var plataforma=$('#plataforma').val();
    var servidor=$('#servidor').val();
    var catalogo=$('#catalogo').val();
    var bd=$('#bd').val();
    var job=$('#job').val();
    var tarea=$('#tarea').val();
    var ruta=$('#ruta').val();
    var periodicidad=$('#periodicidad').val();
    var horario=$('#horaEjecucion').val();
    var tipo=$('#tipo').val();
    var grupo=$('#grupoCargue').val();



    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: 'post',
        url: '/Cargue/store',
        data: {nombre:nombre,t_archivo:t_archivo,plataforma:plataforma,servidor:servidor, catalogo:catalogo, bd:bd,
            job:job, tarea:tarea,ruta:ruta, periodicidad:periodicidad, horario:horario, tipo:tipo, FK_Grupo:grupo},
        success: function (resp) {
            if (resp != "") {
                alert("U");
            }
        },
        error: function (data) {
            alert("E");
        }
    })
};