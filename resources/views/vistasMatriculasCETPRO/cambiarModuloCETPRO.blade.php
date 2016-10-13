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
            @if(Session::has('message'))
            <div class="alert alert-danger">
              {{ Session::get('message')}}
            </div>
          @endif
          </div>
          <div class="panel-body">
            <div class="form-horizontal">
              {!! Form::Open(['route' =>['cetpromatricula.modificarGrupo.store'], 'method' => 'POST'])!!}
              {!! Form::hidden('detalle_id', $detallesMatriculas->id , ['id' => 'detalle_id']) !!}
                <div class="form-group">
                {!! Form::label(':','Nuevo Modulo:',['class'=>'col-lg-2 control-label']) !!}
                  <div class="col-lg-8">
                    {!! Form::select('modulos[]', $modulos, 'Seleccione', ['class' => 'form-control','name'=>'modulo_id', 'id'=>'modulo_id']) !!}
                  </div>
                </div>
                <div class="form-group">
                {!! Form::label(':','Grupo:',['class'=>'col-lg-2 control-label']) !!}
                 <div class="col-lg-8">
                  <select  class="form-control" id="grupo_id" name="grupo_id">
                    <option value= 0>Es necesario seleccionar un Modulo</option>
                  </select>
                 </div>
                </div>

                <div class="modal-footer">
                  <a class="btn btn-warning" href="{{ url('/cetpromatricula/matriculacetpro')}}">Cancelar <span class="glyphicon glyphicon-remove"></span></a>
                  <input type="submit" value="Cambiar de Modulo" class="btn btn-primary" data-toggle='modal' data-target="#Loading">

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
@section('scripts')
{!! Html::script('/js/matriculafCETPRO.js')!!}
@endsection