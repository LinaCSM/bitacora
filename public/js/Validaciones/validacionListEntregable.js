/**
 * Created by Administrador on 14/02/2017.
 */
var idEntregable=null;

$(document).ready(function () {
    $('#tablaEntregables').dataTable();
    $('#tablaEntregablesR').dataTable();
    $('#tablaPEntregados').dataTable();
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

function obtenerID($entregable) {
    idEntregable=$entregable;
    console.log(idEntregable);
}


function ajaxBuscarProceso($proceso){
    var proceso = $proceso;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: 'post',
        url: '/Proceso/buscarInformacion',
        data: {proceso: proceso},
        dataType: "json",
        success: function (data) {
            $.each(data, function(i, item) {
                document.getElementById("sysdate"+idEntregable).value=data[i].Sysdate;
                document.getElementById("horaEntrega"+idEntregable).value=data[i].Hora;
                document.getElementById("responsable"+idEntregable).value=data[i].Responsable;
            })
        }
    })
};

function ajaxInformacionProceso($proceso){
    var proceso = $proceso;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: 'post',
        url: '/Proceso/buscarInformacion',
        data: {proceso: proceso},
        dataType: "json",
        success: function (data) {
            $.each(data, function(i, item) {
                document.getElementById("sysdate").value=data[i].Sysdate;
                document.getElementById("horaEntrega").value=data[i].Hora;
                document.getElementById("responsableP").value=data[i].Responsable;
                document.getElementById("grupoPais").value=data[i].Grupo +"/"+ data[i].Pais;
                document.getElementById("plataforma").value=data[i].Plataforma;
            })
        }
    })
};




function validarCambioEstado(estado){

    if(estado==="Inactivo"){
        document.getElementById("justificacion"+idEntregable).style.display = 'block';
    }
    if(estado==="Bloqueado"){
        document.getElementById("justificacion"+idEntregable).style.display = 'block';
}
    if(estado==="Activo"){
        document.getElementById("justificacion"+idEntregable).style.display = 'none';
    }
}