<?php use App\Http\Controllers\MinutogramaController;?>
<div class="modal fade" id="verEntregables{{$Proceso->id}}" role="dialog">
    <div class="modal-content" role="document" id="modalVerTodo">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Entregables del proceso {{$Proceso->job}}</h4>
            </div>
            <div class="modal-body">
                <div class="table-hover">
                    <table class="table table-striped table-bordered table-hover table-responsive" align="center">
                        <thead>
                        <tr>
                            <th>Tipo</th>
                            <th>Ruta entregable</th>
                            <th>Hora aproximada de entrega</th>
                            <th>Estado</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php $busquedaEntregables = MinutogramaController::buscarEntregables($Proceso->id)?>
                        @foreach($busquedaEntregables as $entregables)
                            <tr>
                                <td> {{$entregables->Tipo}}</td>
                                <td> {{$entregables->Ruta}}</td>
                                <td> {{$entregables->Horario}}</td>
                                <td> {{$entregables->Estado}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>