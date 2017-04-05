<div class="modal fade" id="modalFSemanalE" role="dialog" style="overflow-y: auto; z-index:1100">
    <div class="modal-content" role="dialog" id="modalTipo1">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" onclick="Cancelar()">&times;</button>
                <h4 class="modal-title">Registrar frecuencia semanal</h4>
            </div>
            <div class="modal-body semanal">
                <div class="col-md-12" >
                    <form id="formFrecuenciaS" class="form-inline col-md-8" style="margin-top: 15px; margin-bottom: 40px">
                        <div class="form-group">
                            <label class="col-md-6 control-label" for="diasEjecucion">¿Cuántos días se ejecuta?</label>
                            <div class="col-md-5">
                                <input type="text" id="diasEjecucion" name="diasEjecucion" class="form-control" tabindex="1">
                            </div>
                        </div>
                    </form>
                    <div class="col-md-4" style="margin-top: 20px;">
                        <button class="btn btn-info" id="btnDias">Aceptar</button>
                        <button class="btn"  data-dismiss="modal" onclick="Cancelar()" id="btnCancelar">Cancelar</button>
                    </div>
                </div>
                <div id="main"></div>
            </div>
        </div>
    </div>
</div>