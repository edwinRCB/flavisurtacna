@extends('app')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">Lista de Grupos Inscritos<BR>
          Alumno: {{$matriculaModel->alumnos->nombres}}<br>
          carrera: {{$matriculaModel->carreras->nombre}}
        </div>
        <div class="panel-body"></div>
          <div class="panel-body">
            <div class="table-responsive">
              <a></a>
              <table class="table table-striped table-hover ">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Grupo</th>
                  <th>Inicio</th>
                  <th>Horario</th>
                  <th>Modulo</th>
                  <th>Curso</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody >
              @foreach($matriculaModel->detalles_matriculas as $detalle)
                <tr data-id="{{$detalle->id}}">
                  <td>{{$detalle->id}}</td>
                  <td>{{$detalle->NameGrupo}}</td>
                  <td>{{$detalle->grupos->inicio}}</td>
                  <td>{{$detalle->grupos->Horario}}</td>
                  <td>{{$detalle->NameModulo}}</td>
                  <td>{{$detalle->cursos->nombre}}</td>
                  <td>
                      <a href="{{ route('cetpromatricula.modificarGrupo.edit', $detalle->id)}}" class="btn btn-success btn-xs" title="Cambiar de Grupo"><span class="glyphicon glyphicon-retweet"></span></a>
                      <a href="{{ route('cetpromatricula.modificarGrupo.show', $detalle->id)}}" class="btn btn-warning btn-xs" title="Cambiar de Modulo"><span class="glyphicon glyphicon-random"></span></a>
                      <a href="#" class="btn btn-danger btn-xs" title="Eliminar" data-toggle='modal' data-target="#msjEliminarAlumnoGrupo" ><span class="glyphicon glyphicon-remove red"></span></a>

                  </td>
                </tr>
              @endforeach
              </tbody>
            </table> 
            </div> 
          </div> 
        </div>       
    </div>
  </div>
</div>
@include('vistasMatriculasCETPRO/msjEliminarAlumnoGrupo')
@include('load') 
@endsection
@section('scripts')
{!! Html::script('/js/eliminarAlumnoGrupoCetpro.js')!!}
{!! Html::script('/js/alertify/lib/alertify.js')!!}
{!!Html::style('/js/alertify/themes/alertify.core.css')!!}
{!!Html::style('/js/alertify/themes/alertify.default.css')!!}
@endsection