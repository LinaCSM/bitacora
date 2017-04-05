<?php use App\Http\Controllers\MinutogramaController;?>
<div class="modal fade" id="verEntregableE{{$Proceso -> id}}" role="dialog">
    <div class="modal-content" role="document" id="modalVerTodo">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Proceso {{$Proceso -> job}}</h4>
            </div>
            <div class="modal-body">
                <div class="table-hover">

                    @if($Proceso->FK_Turno=="Noche")
                        <?php $busquedaEntregas = MinutogramaController::buscarEntregaNoche($Proceso->id)?>
                    @else
                        <?php $busquedaEntregas = MinutogramaController::buscarEntrega($Proceso->id)?>
                     @endif
                    <table class="table table-striped table-bordered table-hover table-responsive" align="center">
                        <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Tarea</th>
                            <th>Pre-requisitos</th>
                            <th>Tiempo ejecucion aprox.</th>
                            @foreach($busquedaEntregas as $Entregas)
                                @if($Entregas->estado=='No se ejecuta')
                                    <th>Justificación estado</th>
                                @endif
                            @endforeach
                            <th>Pertenece al semaforo</th>
                            <th>Registrado por</th>
                            @if($Proceso->FK_Turno=="Noche")
                                <th>Fecha entrega</th>
                            @endif
                            <th>Creado</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{$Proceso -> nombre}}</td>
                            <td>{{$Proceso -> tarea_programada}}</td>
                            <td>{{$Proceso -> prerequisitos}}</td>
                            <td>{{$Proceso -> t_ejecucion}}</td>
                            @foreach($busquedaEntregas as $Entregas)
                                @if($Entregas->estado=='No se ejecuta')
                                    <td>{{$Entregas -> justificacion}}</td>
                                @endif
                            @endforeach
                            <td>{{$Proceso->semaforo}}</td>
                            @foreach($busquedaEntregas as $Entregas)
                            <td>{{$Entregas -> registro}}</td>
                                @if($Proceso->FK_Turno=="Noche")
                                    <td>{{$Entregas -> Fecha}}</td>
                                @endif
                            <td>{{$Entregas-> created_at}}</td>
                            @endforeach
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
</div>
