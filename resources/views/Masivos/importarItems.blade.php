<div class="modal fade" id="miventana" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" >
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header" style="border-bottom: 1px solid #5CB85C;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center>
                    <h3>Archivo</h3>
                </center>
            </div>
            <section class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group  col-md-12">
                            {!! Form::open(['route'=>'Masivo/MasivoItems','method'=>'post','files'=>true])!!}

                            <label>Documento</label>
                            <div class="col-md-12">
                                <input type="file" class="form-control" name="archivo" >
                            </div>
                            <hr>
                            <div class="form-group">

                                <button type="submit" class="btn btn-primary btnB--outline">Enviar</button>

                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </section>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
            </div>

        </div>
    </div>
</div>

