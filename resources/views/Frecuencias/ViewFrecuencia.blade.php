<div class="modal fade" id="verFrecuencia{{$frecuencias->id}}" tabindex="-1" role="dialog" >
    <div class="modal-content" role="document" id="modalVerTodo">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Frecuencia {{$frecuencias -> nombre}}</h4>
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
                            <td>{{$frecuencias->justificacion}}</td>
                            <td>{{$frecuencias->registro}}</td>
                            <td>{{$frecuencias->updated_at}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>