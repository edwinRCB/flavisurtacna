@extends('app')
@section('content')
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">OPERACIÓN DE MAQUINARIA PESADA 2 AÑOS!!</h4>
      </div>
      <div class="modal-body">
        <div class="form-horizontal"> 
          {!! Form::Open(['route' => 'alu.notasAntiguasOP2.update', 'method' => 'PUT', 'id'=>'form-update'])!!}
                <div class="form-group">
                  {!! Form::label(':','Nombres:',['class'=>'col-lg-2 control-label']) !!}
                    <div class="col-lg-8">
                      {!! Form::text('auto', '', ['class'=>'form-control', 'id' =>  'auto', 'placeholder' =>  'ingrese nombre'])!!}
                      {!! Form::hidden('alumno_id', '', ['id' => 'alumno_data']) !!}
                    <!--<input id="auto" name="auto" class="form-control input-sm" autocomplete="off" />-->
                    </div>
                </div>
                <div class="form-group">
                  {!! Form::label(':', 'Fecha matricula:',['class'=>'col-lg-2 control-label']) !!}
                    <div class="col-lg-8">
                          <div class='input-group date' id="inicio">
                              <input type='text' class="form-control" name="fecha_matricula"/>
                              <span class="input-group-addon">
                                  <span class="glyphicon glyphicon-calendar"></span>
                              </span>
                          </div>
                    </div>
                </div>

                <div class="form-group">
                  {!! Form::label(':', 'Ciudad:',['class'=>'col-lg-2 control-label']) !!}
                <div class="col-xs-4">
                <select class="form-control" name="ciudad">
                    <option >Seleccione</option>
                    <option value="TACNA">TACNA</option>
                </select>
                </div>
              </div>
                <div class="form-group">
                {!! Form::label(':','MÓDULO:',['class'=>'col-lg-2 control-label']) !!}
                  <div class="col-lg-6">
                    {!! Form::select('semestres[]', $semestres, 'Seleccione', ['class' => 'form-control','name'=>'semestres_id', 'id'=>'semestres']) !!}
                  </div>
                </div>
                <div class="form-group">
                {!! Form::label(':','Curso:',['class'=>'col-lg-2 control-label']) !!}
                <div class="col-lg-8">
                  <select class="form-control" id="curso_id" name="curso_id">
                    <option value="">Es necesario seleccionar un Módulo</option>
                  </select>
                </div>
                </div>
                <div class="form-group">
                  {!! Form::label('ExamenOral:', 'CT1:',['class'=>'col-lg-2 control-label']) !!}
                    <div class="col-lg-8">
                      {!! Form::text('examenoral', null, ['class'=>'form-control','id'=>'examenoral', 'placeholder'=>'Capacidad Terminal 1'])!!}
                    </div>
                </div>
                <div class="form-group">
                  {!! Form::label('T.I:', 'CT2:',['class'=>'col-lg-2 control-label']) !!}
                    <div class="col-lg-8">
                      {!! Form::text('trabajoinvestigacion', null, ['class'=>'form-control', 'id'=>'trabajoinvestigacion', 'placeholder'=>'Capacidad Terminal 2'])!!}
                    </div>
                </div>
                <div class="form-group">
                  {!! Form::label('C.P:', 'CT3:',['class'=>'col-lg-2 control-label']) !!}
                    <div class="col-lg-8">
                      {!! Form::text('conductapuntual', null, ['class'=>'form-control','id'=>'conductapuntual', 'placeholder'=>'Capacidad Terminal 3'])!!}
                    </div>
                </div>
                <div class="form-group">
                  {!! Form::label('P.C:', 'CT4:',['class'=>'col-lg-2 control-label']) !!}
                    <div class="col-lg-8">
                      {!! Form::text('presentacioncuaderno', null, ['class'=>'form-control', 'id'=>'presentacioncuaderno', 'placeholder'=>'Capacidad Terminal 4'])!!}
                    </div>
                </div>
                <div class="form-group">
                  {!! Form::label('E.P.', 'CT5:',['class'=>'col-lg-2 control-label']) !!}
                    <div class="col-lg-8">
                      {!! Form::text('examenpractico', null, ['class'=>'form-control', 'id'=>'examenpractico', 'placeholder'=>'Capacidad Terminal 5'])!!}
                    </div>
                </div>
                <div class="form-group">
                  {!! Form::label('EXF:', 'CT6:',['class'=>'col-lg-2 control-label']) !!}
                    <div class="col-lg-8">
                      {!! Form::text('examenfinal', null, ['class'=>'form-control', 'id'=>'examenfinal', 'placeholder'=>'Capacidad Terminal 6'])!!}
                    </div>
                </div>
                <div class="form-group">
                  {!! Form::label('', '',['class'=>'col-lg-2 control-label']) !!}
                  <div class="col-lg-8">
                  <label>
                    {!! Form::checkbox('matricula', 'mat') !!} Matricular
                  </label></div>
                </div>
            <div class="modal-footer">
              <a href="#" id="btn-updateRegistro" data-dismiss="modal" class="btn btn-primary" type="button" >Guardar <span class="glyphicon glyphicon-floppy-saved"></span></a>
            </div>
                {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>

@endsection

@section('scripts')

<!--{!!Html::style('/css/metroStyle.css')!!}-->
{!! Html::script('/js/cursos.js')!!}
{!! Html::script('/js/funcionpicker.js')!!}
{!! Html::script('/js/prettify.js')!!}
{!! Html::script('/js/mockjax.js')!!}
{!! Html::script('/js/autocomplete.js')!!}
{!! Html::script('/js/funcionesRegistrosAntiguos.js')!!}
{!! Html::script('/js/alertify/lib/alertify.js')!!}

{!!Html::style('/js/alertify/themes/alertify.core.css')!!}
{!!Html::style('/js/alertify/themes/alertify.default.css')!!}
@endsection