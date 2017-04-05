<div class="modal fade" id="modalFMensual" role="dialog" style="overflow-y: auto; z-index:1100">
    <div class="modal-content" role="dialog" id="modalTipo1">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Registrar frecuencia mensual</h4>
            </div>
            <div class="modal-body">
                <form id="formFrecuenciaM" class="form-inline col-md-8"
                      style="margin-left: 180px;margin-top: 20px;margin-right: 20px;">
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="diaMes">Dia:</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control input-md input-mes" id="diaMes"/>
                        </div>
                    </div>
                </form>
                <button class="btn btn-success" style="float: right" onclick="GetTextValue()" id="btSubmit">Registrar</button>

                <div id="main">
                </div>
            </div>
        </div>
    </div>
</div>
</div>