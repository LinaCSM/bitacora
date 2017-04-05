<div class="modal fade"  id="eliminarPais{{$paises -> id}}" role="dialog">
    <div class="modal-content" role="dialog" id="modalEliminar">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Eliminar país {{$paises -> nombre}}</h4>
            </div>
            <div class="modal-body">
                <div id="iconoEliminar">
                    <i class="fa fa-exclamation-triangle"></i>
                </div>
                <div id="textoModal">
                    <h4 style="font-weight: bold;">¿Está seguro de eliminar el país?</h4>
                    <br>
                    <p style="font-size: 18px;">Recuerde que al eliminar un país también eliminara todos los grupos asociados aeste y a su vez
                        todos los procesos asociados a esos grupos.
                        <br>Una vez eliminado no se puede recuperar.</p>
                    <br>
                </div>
                <div style="margin-left: 250px">
                    <a class="btn btn-danger" href="{{route('Pais/destroy',['id'=> $paises -> id])}}">Eliminar</a>
                </div>
            </div>
        </div>
    </div>
</div>