@extends('app')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">Matricular Alumno CETPRO  PRUEBA</div>
          <div class="panel-body">
            <div class="form-horizontal"> 
              {!! Form::Open(['route' =>['cetpromatricula.inscripciones.store'], 'method' => 'POST'])!!}
                <div class="form-group">
                {!! Form::label(':','Carrera:',['class'=>'col-lg-2 control-label']) !!}
                  <div class="col-lg-8">
                    {!! Form::select('carreras[]', $carreras, 'Seleccione', ['class' => 'form-control','name'=>'carrera_id', 'id'=>'carrera']) !!}
                  </div>
                </div>
              <div class="form-group">
                {!! Form::label(':','Modulos:',['class'=>'col-lg-2 control-label']) !!}
                <div class="col-lg-8">
                  <select  class="form-control" id="modulo_id" name="modulo_id">
                    <option value="">Es necesario seleccionar una carrera</option>
                  </select>
                </div>
              </div>
                <div class="form-group">
                  {!! Form::label('nombre:', 'Alumno:',['class'=>'col-lg-2 control-label']) !!}
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
                  {!! Form::label(':', 'N° Boleta:',['class'=>'col-lg-2 control-label']) !!}
                  <div class="col-lg-8">
                      {!! Form::text('nroboleta', null, ['class'=>'form-control','id'=>'nroboleta', 'placeholder'=>'nro  boleta'])!!}
                  </div>
                </div>
                <div class="modal-footer">
                  <a class="btn btn-default" href="{{ url('/cetpromatricula/matriculacetpro')}}">Volver</a>
                  <input type="submit" value="Matricula" class="btn btn-primary">
                </div>
                
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> 
</div>
<!--siguiente div-->
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">Detalles</div>
          <div class="panel-body">
            <div class="form-horizontal"> 
              <div class="form-group">
                {!! Form::label(':','Grupos:',['class'=>'col-lg-2 control-label']) !!}
                <div class="col-lg-8">
                  <select  class="form-control" id="grupo_id" name="grupo_id">
                    <option value="">Es necesario seleccionar una carrera</option>
                  </select>
                </div>
              </div>
               <div id="panel-semestre" class="panel panel-primary">
                        <!-- Aquí listamos todos los cursos de un ciclo -->
                        <div class ="table-responsive">
                          <table id="cursos" class="table table-striped table-hover">
                            <thead>
                              <th>#</th>
                              <th>Curso</th>
                              <th>Creditos</th>
                              <th>Acciones</th>
                            </thead>
                            <tbody id="ttbody">
                            </tbody>
                          </table>
                        </div>
                  </div>
                  {!! Form::close() !!}
                <!--<a id="add" class="btn btn-default" href="#">Volver</a>-->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> 
</div>
@endsection
@section('scripts')
{!! Html::script('/js/funcionesCETPRO.js')!!}
{!! Html::script('/js/funcionpicker.js')!!}
{!! Html::script('/js/prettify.js')!!}
{!! Html::script('/js/mockjax.js')!!}
{!! Html::script('/js/autocomplete.js')!!}
@endsection