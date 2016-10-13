@extends('app')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-info">
        <div class="panel-heading">REPORTES DE ALUMNOS
        	<div class="panel-body">
            	<div class="form-horizontal"> 
              	{!! Form::Open(['route' =>['reportes.alumnosCetpro.show'], 'method' => 'GET'])!!}
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
                	<div class="col-lg-3">
                		{!! Form::label(':', 'Fecha_Inicial:',['class'=>'col-lg-2 control-label']) !!}
                	</div>
                    <div class="col-lg-6">
                          <div class='input-group date' id="inicio">
                              <input type='text' class="form-control" name="inicio"/>
                              <span class="input-group-addon">
                                  <span class="glyphicon glyphicon-calendar"></span>
                              </span>
                          </div>
                    </div>
                </div>
                  <div class="form-group">
                  <div class="col-lg-3">
                    {!! Form::label(':', 'Fecha_Final:',['class'=>'col-lg-2 control-label']) !!}
                  </div>
                    <div class="col-lg-6">
                          <div class='input-group date' id="fin">
                              <input type='text' class="form-control" name="fin"/>
                              <span class="input-group-addon">
                                  <span class="glyphicon glyphicon-calendar"></span>
                              </span>
                          </div>
                    </div>
                    <div>
                      <input type="submit" target="_blank" value="Aceptar" data-toggle='modal' data-target="#Loading"class="btn btn-info">
                    </div>
                </div>
                {!! Form::close() !!}
            	</div>
            </div>
        </div> 
       </div>   
    </div>
  </div>
</div>


@endsection
@section('scripts')
{!! Html::script('/js/matriculafCETPRO.js')!!}
{!! Html::script('/js/funcionpicker.js')!!}
@endsection