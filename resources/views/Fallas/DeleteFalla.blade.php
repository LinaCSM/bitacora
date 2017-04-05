<div class="modal fade" id="eliminarFalla{{$Falla->id}}" role="dialog">
    <div class="modal-content" role="dialog" id="modalEliminar">
        <div class="modal-content">
            <div class="modal-header" >
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="title">Eliminar falla del proceso {{$Falla->job}}</h4>
            </div>
            <div class="modal-body">
                <div id="iconoEliminar">
                    <i class="fa fa-exclamation-triangle"></i>
                </div>
                <div id="textoModal">
                    <h4 style="font-weight: bold;">¿Está seguro de eliminar la falla?</h4>
                    <br>
                    <p style="font-size: 18px;">Recuerde que una vez eliminada no se puede recuperar.</p>
                    <br>
                </div>
                    <div style="margin-left: 250px">
                        <a class="btn btn-danger" href="{{route('Falla/destroy',['id'=> $Falla -> id])}}">Eliminar</a>
                    </div>
            </div>
        </div>
    </div>
</div>