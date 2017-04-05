<?php use App\Http\Controllers\SLAController;?>
<div class="modal fade"  id="justificarSLA{{$Proceso -> id}}" role="dialog" style="overflow-y: auto">
    <?php $sla=SLAController::buscarSLA($Proceso -> id)?>
    <div class="modal-content" role="dialog"  id="modalTipo2">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <div id="icono">
                    <i class="fa fa-pencil"></i>
                    <h4 class="modal-title">Justificar SLA
                        @foreach($sla as $SLA)
                            {{$SLA->porcentaje}}
                        @endforeach
                        <br>{{$Proceso -> job}}</h4>
                </div>
            </div>
            <div class="modal-body">

                @foreach($sla as $SLA)
                {!! Form::model($SLA, ['method' => 'PATCH', 'action' => ['SemaforoController@update', $SLA->idPS], 'files' => true])!!}
                    {!! Form::hidden('id',$SLA->idPS)!!}
                <div class="col-md-12">
                    <div class="form-group">
                        {!! Form:: label('justificacion','Justificacion:',['class' => 'col-md-4 control-label'])!!}
                        <div class="col-md-8">
                            {!!Form::textarea ('justificacion_SLA',null, ['class'=>'form-control', 'rows' =>2, 'cols'=>24,'tabindex'=>1])!!}
                        </div>
                    </div>
                </div>
                <div>
                </div>
                <div id="btnActualizar" class="form-group">
                    {!! Form::submit('Justificar',['class' => 'btn btn-success'])!!}
                </div>
                {!! Form::close()!!}
                    @endforeach
            </div>
        </div>
    </div>
</div>