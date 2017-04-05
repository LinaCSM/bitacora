<?php use App\Http\Controllers\MinutogramaController;?>
<div class="modal fade" id="verEntregables{{$Semaforo->idP}}" role="dialog">
    <div class="modal-content" role="document" id="modalVerTodo">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Entregables del proceso {{$Semaforo->nombre}}</h4>
            </div>
            <div class="modal-body">
                <div class="table-hover">
                    <table class="table table-striped table-bordered table-hover table-responsive" align="center">
                        <thead>
                        <tr>
                            <th>Tipo entregable</th>
                            <th>Ruta </th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php $busquedaEntregables = MinutogramaController::buscarEntregables($Semaforo->idP)?>
                        @foreach($busquedaEntregables as $entregables)
                            <tr>
                                <td> {{$entregables->Tipo}}</td>
                                <td> {{$entregables->Ruta}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>