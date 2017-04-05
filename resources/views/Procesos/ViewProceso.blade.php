<?php use App\Http\Controllers\MinutogramaController;?>
<div class="modal fade" id="verProceso{{$Proceso->id}}" tabindex="-1" role="dialog" >
    <div class="modal-content" role="document" id="modalVerTodo">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Proceso {{$Proceso->nombre}}</h4>
        </div>
            <?php $busquedaDias = MinutogramaController::buscarDiasEjecucion($Proceso->id)?>
            <div class="modal-body">
                <div class="table-hover">
                    <table class="table table-striped table-bordered table-hover table-responsive" align="center">
                        <thead>
                        <tr>
                            <th>Job</th>
                            <th>Tarea</th>
                            <th>Pre-requisitos</th>
                            <th>Horario</th>
                            <th>Tiempo ejecución</th>
                            <th>Sysdate</th>
                            <th>Pertenece al semaforo</th>
                            <th>Días que se ejecuta</th>
                            @if($Proceso->estado!="Activo")
                                <th>Justificacion estado</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{$Proceso->job}}</td>
                            <td>{{$Proceso->tarea_programada}}</td>
                            <td>{{$Proceso->prerequisitos}}</td>
                            <td>{{$Proceso->horario}}</td>
                            <td>{{$Proceso->t_ejecucion}}</td>
                            <td>{{$Proceso->sysdate}}</td>
                            <td>{{$Proceso->semaforo}}</td>
                            <td>
                                @foreach($busquedaDias as $dias)
                                    {{$dias->Dia}}<br>
                                @endforeach
                            </td>
                            @if($Proceso->estado!="Activo")
                                <td>{{$Proceso->justificacion}}</td>
                            @endif
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>