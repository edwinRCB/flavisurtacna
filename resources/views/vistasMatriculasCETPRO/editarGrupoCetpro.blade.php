@extends('app')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading" style="font-weight: bold"><center>Editar Matricula</center><BR>
          Alumno: {{$matriculaModel->alumnos->nombres}} <BR>
          Carrera: {{$matriculaModel->carreras->nombre}} -- Modulo: {{$detallesMatriculas->NameModulo}}
        </div>
          <div class="panel-body">
            <div class="form-horizontal"> 
              {!! Form::model($matriculaModel, ['route' =>['cetpromatricula.modificarGrupo.update', $detallesMatriculas->id], 'method' => 'PUT'])!!}
                <div class="form-group">
                {!! Form::label(':','Grupo:',['class'=>'col-lg-2 control-label']) !!}
                <div class="col-lg-8">
                  <select  class="form-control" id="grupo_id" name="grupo_id">
                    @foreach($grupos as $grupo)
                    <option value= {{$grupo->id}}>{{$grupo->nombre_unidad}} | Horario: {{$grupo->Horario}} | Inicio: {{$grupo->inicio}}</option>
                    @endforeach
                  </select>
                </div>

                </div>

                <div class="modal-footer">
                  <input type="submit" value="Cambiar de Grupo" class="btn btn-primary" data-toggle='modal' data-target="#Loading">
                </div>
                {!! Form::close() !!}
            </div>
            @include('load')
          </div>
        </div>
      </div>
    </div>
  </div> 
</div>
@stop