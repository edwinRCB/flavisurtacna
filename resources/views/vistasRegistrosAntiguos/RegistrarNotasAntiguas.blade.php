@extends('app')
@section('content')
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">Regitros de Datos</h4>
      </div>
      <div class="modal-body">
        <div class="form-horizontal"> 
          {!! Form::Open(['route' => 'alu.notasAntiguas.update', 'method' => 'PUT', 'id'=>'form-update'])!!}
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
                {!! Form::label(':','Maquina:',['class'=>'col-lg-2 control-label']) !!}
                  <div class="col-lg-6">
                    {!! Form::select('semestres[]', $semestres, 'Seleccione', ['class' => 'form-control','name'=>'semestres_id', 'id'=>'semestres']) !!}
                  </div>
                </div>
                <div class="form-group">
                  {!! Form::label('ExamenOral:', 'E.O.:',['class'=>'col-lg-2 control-label']) !!}
                    <div class="col-lg-8">
                      {!! Form::text('examenoral', null, ['class'=>'form-control','id'=>'examenoral', 'placeholder'=>'Examen Oral'])!!}
                    </div>
                </div>
                <div class="form-group">
                  {!! Form::label('T.I:', 'T.I.:',['class'=>'col-lg-2 control-label']) !!}
                    <div class="col-lg-8">
                      {!! Form::text('trabajoinvestigacion', null, ['class'=>'form-control', 'id'=>'trabajoinvestigacion', 'placeholder'=>'Trabajo Investigación'])!!}
                    </div>
                </div>
                <div class="form-group">
                  {!! Form::label('C.P:', 'C.P.:',['class'=>'col-lg-2 control-label']) !!}
                    <div class="col-lg-8">
                      {!! Form::text('conductapuntual', null, ['class'=>'form-control','id'=>'conductapuntual', 'placeholder'=>'Conducta Puntual'])!!}
                    </div>
                </div>
                <div class="form-group">
                  {!! Form::label('P.C:', 'P.C.:',['class'=>'col-lg-2 control-label']) !!}
                    <div class="col-lg-8">
                      {!! Form::text('presentacioncuaderno', null, ['class'=>'form-control', 'id'=>'presentacioncuaderno', 'placeholder'=>'Presentación Cuaderno'])!!}
                    </div>
                </div>
                <div class="form-group">
                  {!! Form::label('E.P.', 'E.P.:',['class'=>'col-lg-2 control-label']) !!}
                    <div class="col-lg-8">
                      {!! Form::text('examenpractico', null, ['class'=>'form-control', 'id'=>'examenpractico', 'placeholder'=>'Examen Practico'])!!}
                    </div>
                </div>
                <div class="form-group">
                  {!! Form::label('EXF:', 'E.F.:',['class'=>'col-lg-2 control-label']) !!}
                    <div class="col-lg-8">
                      {!! Form::text('examenfinal', null, ['class'=>'form-control', 'id'=>'examenfinal', 'placeholder'=>'Examen Final'])!!}
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
{!! Html::script('/js/funcionpicker.js')!!}
{!! Html::script('/js/prettify.js')!!}
{!! Html::script('/js/mockjax.js')!!}
{!! Html::script('/js/autocomplete.js')!!}
{!! Html::script('/js/funcionesRegistrosAntiguos.js')!!}
{!! Html::script('/js/alertify/lib/alertify.js')!!}
{!!Html::style('/js/alertify/themes/alertify.core.css')!!}
{!!Html::style('/js/alertify/themes/alertify.default.css')!!}
@endsection