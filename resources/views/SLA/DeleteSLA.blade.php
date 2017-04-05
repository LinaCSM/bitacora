<div class="modal fade" id="eliminarSLA{{$SLAS->id}}" role="dialog">
    <div class="modal-content" role="dialog" id="modalEliminar">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Eliminar SLA {{$SLAS->porcentaje}}</h4>
            </div>
            <div class="modal-body">
                <div id="iconoEliminar">
                    <i class="fa fa-exclamation-triangle"></i>
                </div>
                <div id="textoModal">
                    <h4 style="font-weight: bold;">¿Está seguro de eliminar el SLA?</h4>
                    <br>
                    <p style="font-size: 18px;">Recuerde que al eliminar el SLA eliminara todos los datos del semáforo asociados a este,
                        presentará fallas el registro de datos por lo tanto debe modificar el código.
                        <br>Una vez eliminado no se puede recuperar.</p>
                    <br>
                </div>
                <form>
                    <div style="margin-left: 250px">
                        <a class="btn btn-danger" href="{{route('SLA/destroy',['id'=> $SLAS -> id])}}">Eliminar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>