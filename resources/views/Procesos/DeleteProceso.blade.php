<div class="modal fade" id="eliminarProceso{{$Proceso -> id}}" role="dialog">
    <div class="modal-content" role="dialog" id="modalEliminar">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Eliminar proceso {{$Proceso -> nombre}}</h4>
            </div>
            <div class="modal-body">
                <div id="iconoEliminar">
                    <i class="fa fa-exclamation-triangle"></i>
                </div>
                <div id="textoModal">
                    <h4 style="font-weight: bold;">¿Está seguro de eliminar el proceso?</h4>
                    <br>
                    <p style="font-size: 18px;">Recuerde que al eliminar el proceso también eliminara todos los SLA, entregas y fallas asociadas a este.
                        <br>Una vez eliminado no se puede recuperar.</p>
                    <br>
                </div>
                <form>
                    <div style="margin-left: 250px">
                        <a class="btn btn-danger" href="{{route('Proceso/destroy',['id'=> $Proceso -> id])}}">Eliminar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>