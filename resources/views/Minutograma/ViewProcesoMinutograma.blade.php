<?php use App\Http\Controllers\MinutogramaController;?>
<div class="modal fade" id="verEntregableM{{$Proceso -> id}}" role="dialog">
    <div class="modal-content" role="document" id="modalVerTodo">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Proceso {{$Proceso -> job}}</h4>
            </div>
            <?php $busquedaDias = MinutogramaController::buscarDiasEjecucion($Proceso->id)?>
            <div class="modal-body">
                    <table class="table table-striped table-bordered table-hover table-responsive" align="center">
                        <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Tarea</th>
                            <th>Pre-requisitos</th>
                            <th>Tiempo ejecucion aprox.</th>
                            <th>Dias ejecucion</th>
                            <th>Sysdate</th>
                            <th>Pertenece al semaforo</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{$Proceso -> nombre}}</td>
                            <td>{{$Proceso -> tarea_programada}}</td>
                            <td>{{$Proceso -> prerequisitos}}</td>
                            <td>{{$Proceso -> t_ejecucion}}</td>
                            <td>
                                @foreach($busquedaDias as $dias)
                                    {{$dias->Dia}}<br>
                                @endforeach
                            </td>
                            <td>{{$Proceso-> sysdate}}</td>
                            <td>{{$Proceso->semaforo}}</td>

                        </tr>
                        </tbody>
                    </table>

                <br>
                <h4 class="modal-title">Entregables</h4>
                    <table class="table table-striped table-bordered table-hover table-responsive" align="center">
                        <thead>
                        <tr>
                            <th>Tipo entregable</th>
                            <th>Ruta</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php $busquedaEntregables = MinutogramaController::buscarEntregables($Proceso->id)?>
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
