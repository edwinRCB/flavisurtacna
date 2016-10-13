@extends('app')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading" style="font-weight: bold"><center>Editar Matricula</center><BR>
          Alumno: {{$matriculaModel->alumnos->nombres}} <BR>
          Carrera: {{$matriculaModel->carreras->nombre}}
        </div>
          <div class="panel-body">
            <div class="form-horizontal"> 
              {!! Form::model($matriculaModel, ['route' =>['cetpromatricula.matriculacetpro.update', $matriculaModel->id], 'method' => 'PUT'])!!}
                <div class="form-group">
                {!! Form::label(':','Grupo:',['class'=>'col-lg-2 control-label']) !!}
                  <div class="col-lg-8">
                    {!! Form::select('grupos[]', $grupos, '', ['class' => 'form-control','name'=>'grupo_id', 'id'=>'grupo_id']) !!}
                  </div>
                </div>
                <div class="form-group">
                  {!! Form::label('NroBoleta:', 'NroBoleta:',['class'=>'col-lg-2 control-label']) !!}
                    <div class="col-lg-8">
                      {!! Form::text('nroboleta', null, ['class'=>'form-control', 'placeholder'=>'nroboleta'])!!}
                    </div>
                </div>
                <div class="modal-footer">
                  <a class="btn btn-default" href="{{ url('/cetpromatricula/matriculacetpro')}}">Volver</a>
                  <input type="submit" value="Actualizar Matricula" class="btn btn-primary">
                </div>
                {!! Form::close() !!}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> 
</div>
@stop