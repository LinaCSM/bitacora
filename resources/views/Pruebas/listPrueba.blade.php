@extends('app')

@section('contenido')

    @foreach($procesos as $Proceso)
        {!! Form::model($Proceso, ['method'=>'put',
        'route' => ['Proceso.update', $Proceso->id]])!!}

        <div class="col-md-12">
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form:: label('nombre','Nombre:',['class' => 'col-md-3 control-label'])!!}
                    <div class="col-md-9">
                        {!!Form::textarea ('nombre',null, ['class'=>'form-control', 'rows' =>1, 'cols'=>24,'tabindex'=>1])!!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form:: label('job','Job:',['class' => 'col-md-3 control-label'])!!}
                    <div class="col-md-9">
                        {!!Form::textarea ('job',null,  ['class'=>'form-control', 'rows' =>1, 'cols'=>24,'tabindex'=>2])!!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form:: label('tarea_programada','Tarea:',['class' => 'col-md-3 control-label'])!!}
                    <div class="col-md-9">
                        {!!Form::textarea ('tarea_programada',null,  ['class'=>'form-control', 'rows' =>1, 'cols'=>24,'tabindex'=>3])!!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form:: label('prerequisitos','Pre-requisito:',['class' => 'col-md-3 control-label'])!!}
                    <div class="col-md-9">
                        {!!Form::textarea ('prerequisitos',null,  ['class'=>'form-control', 'rows' =>2, 'cols'=>24,'tabindex'=>4])!!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form:: label('catalogo','Catálogo:',['class' => 'col-md-3 control-label'])!!}
                    <div class="col-md-9">
                        {!! Form:: text('catalogo', null,  ['class' => 'form-control input-md', 'tabindex'=>5])!!}
                    </div>
                </div>

            </div>

            <div class="col-md-4">
                <div class="form-group">
                    {!! Form:: label('FK_Turno','Turno:',['class' => 'col-md-4 control-label'])!!}
                    <div class="col-md-8">
                        {!!Form :: select('FK_Turno', $turnos, null, ['class' => 'form-control', 'tabindex'=>6])!!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form:: label('horario','Horario:',['class' => 'col-md-3 control-label'])!!}
                    <div class="col-md-8">
                        {!! Form:: text('horario', null, ['class' => 'form-control input-md', 'tabindex'=>7])!!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form:: label('t_ejecucion','Tiempo ejecución:',['class' => 'col-md-4 control-label'])!!}
                    <div class="col-md-8" style="margin-top: 15px;">
                        {!! Form:: text('t_ejecucion', null, ['class' => 'form-control input-md', 'tabindex'=>8])!!}
                    </div>
                </div>


                <div class="form-group">
                    {!! Form:: label('FK_Frecuencia','Frecuencia:',['class' => 'col-md-5 control-label'])!!}
                    <div class="col-md-7">
                        {!!Form :: select('FK_Frecuencia', $frecuencias, null, ['class' => 'form-control', 'tabindex'=>9])!!}
                    </div>
                </div>

                <div class="form-group" id="diasFrecuencia">
                    {!! Form:: label('dia','Dias ejecución:',['class' => 'col-md-4 control-label'])!!}
                    <div class="col-md-8">
                        {!!Form::textarea ('dia',null, ['class'=>'form-control', 'rows' =>2, 'cols'=>15,'tabindex'=>10])!!}
                    </div>
                </div>

            </div>

            <div class="col-md-4">
                <div class="form-group">
                    {!! Form:: label('FK_Pais','País:',['class' => 'col-md-3 control-label'])!!}
                    <div class="col-md-9">
                        {!!Form :: select('FK_Pais',$paises, null, ['class' => 'form-control', 'tabindex'=>11])!!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form:: label('FK_Grupo','Grupo:',['class' => 'col-md-3 control-label'])!!}
                    <div class="col-md-9">
                        {!!Form :: select('FK_Grupo', $grupos, null, ['class' => 'form-control', 'tabindex'=>12])!!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form:: label('sysdate','Sysdate:',['class' => 'col-md-3 control-label'])!!}
                    <div class="col-md-9">
                        {!! Form:: text('sysdate', null, ['class' => 'form-control input-md', 'tabindex'=>13])!!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form:: label('servidor','Servidor:',['class' => 'col-md-3 control-label'])!!}
                    <div class="col-md-9">
                        {!! Form:: text('servidor', null, ['class' => 'form-control input-md', 'tabindex'=>14])!!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form:: label('plataforma','Plataforma:',['class' => 'col-md-5 control-label'])!!}
                    <div class="col-md-7">
                        {!!Form :: select('plataforma', ['Oracle'=>'Oracle', 'Netezza'=>'Netezza'], null, ['class' => 'form-control', 'tabindex'=>15])!!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form:: label('FK_Tipo','Responsable:',['class' => 'col-md-5 control-label'])!!}
                    <div class="col-md-7">
                        {!!Form :: select('FK_Tipo', $tipos,  null, ['class' => 'form-control', 'tabindex'=>16])!!}
                    </div>
                </div>

                <div class="form-group">

                    {!! Form:: label('semaforo','¿Pertenece al semaforo?:',['class' => 'col-md-6 control-label'])!!}
                    <div class="col-md-6" style="margin-top: 6px; margin-bottom: 50px">

                        <label class="radio-inline control-label" >
                            {!! Form::radio('semaforo', 'Si') !!} Si
                        </label>
                        <label class="radio-inline control-label">
                            {!! Form::radio('semaforo', 'No') !!} No
                        </label>
                    </div>
                </div>
            </div>


        </div>

            {!! Form::submit('Actualizar',['class' => 'btn btn-success'])!!}
        {!! Form::close() !!}
    @endforeach
@stop

