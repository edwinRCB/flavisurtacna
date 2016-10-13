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
                  {!! Form::label('DNI:', 'DNI:',['class'=>'col-lg-2 control-label']) !!}
                    <div class="col-lg-8">
                      {!! Form::text('dni', null, ['class'=>'form-control','id'=>'dni', 'placeholder'=>'DNI'])!!}
                    </div>
                </div>
                <div class="form-group">
                  {!! Form::label(':','Nombres:',['class'=>'col-lg-2 control-label']) !!}
                    <div class="col-lg-8">
                      {!! Form::text('auto', '', ['class'=>'form-control', 'id' =>  'auto', 'placeholder' =>  'ingrese nombre'])!!}
                      {!! Form::hidden('alumno_id', '', ['id' => 'alumno_data']) !!}
                    <!--<input id="auto" name="auto" class="form-control input-sm" autocomplete="off" />-->
                    </div>
                </div>

                <div class="form-group">
                {!! Form::label(':','Maquina:',['class'=>'col-lg-2 control-label']) !!}
                  <div class="col-lg-6">
                    {!! Form::select('semestres[]', $semestres, 'Seleccione', ['class' => 'form-control','name'=>'semestres_id', 'id'=>'semestres']) !!}
                  </div>
                </div>
                <div class="form-group">
                  {!! Form::label(':', 'Fecha matricula44:',['class'=>'col-lg-2 control-label']) !!}
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
                    <option value="AREQUIPA">AREQUIPA</option>
                    <option value="TACNA">TACNA</option>
                </select>
                </div>
              </div>
                <div class="form-group">
                  {!! Form::label('operacion:', 'Operación:',['class'=>'col-lg-2 control-label']) !!}
                    <div class="col-lg-8">
                      {!! Form::text('operacionpr', null, ['class'=>'form-control','id'=>'operacionpr', 'placeholder'=>'0'])!!}
                    </div>
                </div>
                <div class="form-group">
                  {!! Form::label('mant:', 'Mantemient:',['class'=>'col-lg-2 control-label']) !!}
                    <div class="col-lg-8">
                      {!! Form::text('mantenimientopr', null, ['class'=>'form-control', 'id'=>'mantenimientopr', 'placeholder'=>'0'])!!}
                    </div>
                </div>
                <div class="form-group">
                  {!! Form::label('Ingles:', 'Ingles:',['class'=>'col-lg-2 control-label']) !!}
                    <div class="col-lg-8">
                      {!! Form::text('inglespro', null, ['class'=>'form-control','id'=>'inglespro', 'placeholder'=>'0'])!!}
                    </div>
                </div>
                <div class="form-group">
                  {!! Form::label('seg:', 'Seguridad:',['class'=>'col-lg-2 control-label']) !!}
                    <div class="col-lg-8">
                      {!! Form::text('seguridadpr', null, ['class'=>'form-control', 'id'=>'seguridadpr', 'placeholder'=>'0'])!!}
                    </div>
                </div>
                <div class="form-group">
                  {!! Form::label('prac:', 'Practica:',['class'=>'col-lg-2 control-label']) !!}
                    <div class="col-lg-8">
                      {!! Form::text('practicapr', null, ['class'=>'form-control', 'id'=>'practicapr', 'placeholder'=>'0'])!!}
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