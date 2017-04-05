/**
 * Created by Administrador on 22/03/2017.
 */

idResponsable=null;
function obtenerIDR($id) {
    idResponsable=$id;
}


$(document).ready(function () {
    $('#tablaResponsables').DataTable();
    $("li").removeClass("active");
    $("#responsable").addClass("active");
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

function validarCambio(respuesta) {
    if (respuesta === 'Si') {
        document.getElementById("contra"+idResponsable).style.display = "block";
        document.getElementById("confcontra"+idResponsable).style.display = "block";
    }
    if (respuesta === 'No') {
        document.getElementById("contra"+idResponsable).style.display = "none";
        document.getElementById("confcontra"+idResponsable).style.display = "none";
    }
};

function cambiarEstado(estado) {
    if (estado === 'Inactivo') {
        document.getElementById("justificacionEstado"+idResponsable).style.display = "block";
    }
    if (estado === 'Activo') {
        document.getElementById("justificacionEstado"+idResponsable).style.display = "none";
    }
};


function ajaxActualizarUsuario(){
    var id= $('#id' + idResponsable).val();
    var identificacion= $('#identificacion' + idResponsable).val();
    var nombre= $('#nombre' + idResponsable).val();
    var apellido= $('#apellidos' + idResponsable).val();
    var user_red= $('#user_red' + idResponsable).val();
    var tipo= $('#tipo' + idResponsable).val();
    var cambioContra= $('#precontra' + idResponsable).val();
    var contrasena= $('#contrasenaEResponsable' + idResponsable).val();


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: 'post',
        url: '/Usuario/actualizarUsuario',
        data: {id:id,identificacion:identificacion, nombre:nombre,apellido:apellido,user_red:user_red, tipo:tipo,
            cambioContra:cambioContra, contrasena:contrasena}
    })
};
