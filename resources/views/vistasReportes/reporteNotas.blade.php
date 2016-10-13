@extends('app')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">Matricular Alumno</div>
          <div class="panel-body">
            <div class="form-horizontal"> 
                <div class="form-group">
                  {!! Form::label(':','Nombres:',['class'=>'col-lg-2 control-label']) !!}
                    <div class="col-lg-8">
                      {!! Form::text('auto', '', ['class'=>'form-control', 'id' =>  'auto', 'placeholder' =>  'ingrese nombre'])!!}
                      {!! Form::hidden('alumno_id', '', ['id' => 'alumno_data']) !!}
                    <!--<input id="auto" name="auto" class="form-control input-sm" autocomplete="off" />-->
                    </div>
                </div>
                <div class="form-group">
                {!! Form::label(':','Carrera:',['class'=>'col-lg-2 control-label']) !!}
                  <div class="col-lg-6">
                    {!! Form::select('carreras[]', $carreras, 'Seleccione', ['class' => 'form-control','name'=>'carrera_id', 'id'=>'carrera']) !!}
                  </div>
                </div>
              <div class="form-group">
                {!! Form::label(':','Modulos:',['class'=>'col-lg-2 control-label']) !!}
                <div class="col-lg-6">
                  <select  class="form-control" id="modulo_id" name="modulo_id">
                    <option value="">Es necesario seleccionar una carrera</option>
                  </select>
                </div>
              </div>
                <div class="modal-footer">
                  <a value="Ver Notas" class="btn btn-prifsdfsdmary" data-toggle='modal' data-target="#Lofading"></a>
                  <a class="btn btn-info" id="btn-danger"><span class="glyphicon glyphicon-eye-open"></span>Ver Notas</a>
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
        <div class="panel-heading">Notas</div>
          <div class="panel-body">
            <div class="form-horizontal"> 
               <div id="panel-semestre" class="panel panel-primary">
                        <!-- Aquí listamos todos los cursos de un ciclo -->
                        <div class ="table-responsive">
                          <table id="cursos" class="table table-striped table-hover">
                            <thead>
                              <th>#</th>
                              <th>Curso</th>
                              <th>Maquina</th>
                              <th>Promedio</th>
                              <th>Inicio/Fin</th>
                            </thead>
                            <tbody >
                            </tbody>
                          </table>
                        </div>
                  </div>
                <!--<a id="add" class="btn btn-default" href="#">Volver</a>-->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> 
</div>
@include('load')
@endsection
@section('scripts')
{!! Html::script('/js/funcionesReportes.js')!!}
{!! Html::script('/js/prettify.js')!!}
{!! Html::script('/js/mockjax.js')!!}
{!! Html::script('/js/autocomplete.js')!!}
{!! Html::script('/js/matriculafCETPRO.js')!!}
{!! Html::script('/js/alertify/lib/alertify.js')!!}
{!!Html::style('/js/alertify/themes/alertify.core.css')!!}
{!!Html::style('/js/alertify/themes/alertify.default.css')!!}
@endsection