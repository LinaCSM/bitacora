<?php use App\Http\Controllers\MinutogramaController;?>
<div class="modal fade" id="verEntregable{{$Entregable->idP}}" role="dialog">
    <div class="modal-content" role="document" id="modalVerTodo">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Entregable de proceso {{$Entregable->Proceso}}</h4>
            </div>
            <?php $busquedaDias = MinutogramaController::buscarDiasEjecucion($Entregable->idP)?>
            <div class="modal-body">
                <div class="table-hover">
                    <table class="table table-striped table-bordered table-hover table-responsive" align="center">
                        <thead>
                        <tr>
                            <th>Plataforma</th>
                            <th>Frecuencia</th>
                            <th>Dias ejecución</th>
                            <th>Sysdate</th>
                            <th>Servidor</th>
                            <th>Catálogo</th>
                            <th>Grupo</th>
                            <th>País</th>
                            @if($Entregable->estado!="Activo")
                                <th>Justificacion estado</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{$Entregable->plataforma}}</td>
                            <td>{{$Entregable->frecuencia}}</td>
                            <td>
                                @foreach($busquedaDias as $dias)
                                    {{$dias->Dia}}<br>
                                @endforeach
                            </td>
                            <td>{{$Entregable->sysdate}}</td>
                            <td>{{$Entregable->servidor}}</td>
                            <td>{{$Entregable->catalogo}}</td>
                            <td>{{$Entregable->Grupo}}</td>
                            <td>{{$Entregable->Pais}}</td>
                            @if($Entregable->estado!="Activo")
                                <td>{{$Entregable->justificacion}}</td>
                            @endif

                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>