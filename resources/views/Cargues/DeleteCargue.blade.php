<div class="modal fade" id="eliminarCargue{{$Cargue->id}}" role="dialog">
    <div class="modal-content" role="dialog" id="modalEliminar">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Eliminar cargue GPRS</h4>
            </div>
            <div class="modal-body">
                <div id="iconoEliminar">
                    <i class="fa fa-exclamation-triangle"></i>
                </div>
                <div id="textoModal">
                    <h4 style="font-weight: bold;">¿Está seguro de eliminar el cargue?</h4>
                    <br>
                    <p style="font-size: 18px;">Recuerde que una vez eliminado no se puede recuperar.</p>
                    <br>
                </div>
                <form>
                    <div id="btnEliminar">
                        <a class="btn btn-danger" href="{{route('Cargue/destroy',['id'=> $Cargue -> id])}}">Eliminar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>