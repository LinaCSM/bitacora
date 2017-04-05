<div class="modal fade" id="verCargue{{$Cargue->id}}" tabindex="-1" role="dialog" >
    <div class="modal-content" role="document" id="modalVerTodo">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">{{$Cargue->nombre}}</h4>
            </div>
            <?php $tipo=Auth::user()->FK_Tipo ?>
            <div class="modal-body">
                <div class="table-hover">
                    <table class="table table-striped table-bordered table-hover table-responsive" align="center">
                        <thead>
                        <tr>
                            <th>Tipo Archivo</th>
                            <th>Plataforma</th>
                            <th>Base de datos</th>
                            <th>Job</th>
                            <th>Tarea</th>
                            @if($tipo!= "7")
                                @if($Cargue->estado!="Correcto")
                                <th>Justificación estado</th>
                                @endif
                                @if($Cargue->updated_at!=null)
                                    <th>Modificado</th>
                                    <th>Actualizado por</th>
                                @endif
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{$Cargue->tipo_archivo}}</td>
                            <td>{{$Cargue->plataforma}}</td>
                            <td>{{$Cargue->bd}}</td>
                            <td>{{$Cargue->job}}</td>
                            <td>{{$Cargue->tarea}}</td>
                            @if($tipo!= "7")
                                @if($Cargue->estado!="Correcto")
                                <td>{{$Cargue->justificacion}}</td>
                                @endif
                                @if($Cargue->updated_at!=null)
                                <td>{{$Cargue->updated_at}}</td>
                                <td>{{$Cargue->registro}}</td>
                                @endif
                            @endif
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>