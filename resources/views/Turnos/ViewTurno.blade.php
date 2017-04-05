<div class="modal fade" id="verTurno{{$turno->id}}" tabindex="-1" role="dialog" >
    <div class="modal-content" role="document" id="modalVerTodo">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Turno {{$turno -> nombre}}</h4>
        </div>
            <div class="modal-body">
                <div class="table-hover">
                    <table class="table table-striped table-bordered table-hover table-responsive" align="center">
                        <thead>
                        <tr>
                            <th>Justificacion estado</th>
                            <th>Actualizado por</th>
                            <th>Fecha</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{$turno->justificacion}}</td>
                            <td>{{$turno->registro}}</td>
                            <td>{{$turno->updated_at}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>