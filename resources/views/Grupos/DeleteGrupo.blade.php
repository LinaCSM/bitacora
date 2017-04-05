<div class="modal fade" id="eliminarGrupo{{$grupos->id}}" role="dialog">
    <div class="modal-content" role="dialog" id="modalEliminar">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Eliminar grupo {{$grupos -> nombre}} - {{$grupos -> pais}}</h4>
            </div>
            <div class="modal-body">
                <div id="iconoEliminar">
                    <i class="fa fa-exclamation-triangle"></i>
                </div>
                <div id="textoModal">
                    <h4 style="font-weight: bold;">¿Está seguro de eliminar el grupo?</h4>
                    <br>
                    <p style="font-size: 18px;">Recuerde que al eliminar el grupo también eliminara todos los procesos asociados a este.
                        <br>Una vez eliminado no se puede recuperar.</p>
                    <br>
                </div>
                <form>
                    <div style="margin-left: 250px">
                        <a class="btn btn-danger" href="{{route('Grupo/destroy',['id'=> $grupos -> id])}}">Eliminar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>