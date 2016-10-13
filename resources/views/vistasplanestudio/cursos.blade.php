@extends('app')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">Lista de cursos</div>
        <div class="panel-body">

          <div class="table-responsive">
            <a></a>
            <table class="table table-striped table-hover ">
            <thead>
              <tr>
                <th>#</th>
                <th>Curso</th>
                <th>Tipo</th>
                <th>Creditos</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody >
              @foreach($cursos as $curso)
              <tr data-id="{{$curso->id}}">
                <td>{{$curso->id}}</td>
                <td>{{$curso->nombre}}</td>
                <td>{{$curso->descripcion}}</td>
                <td>{{$curso->creditos}}</td>
                <td>
                    <a href="{{ route('planestudio.curso.edit', $curso->id)}}" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-eye-open"></span></a>
                    <a href="#" class="btn btn-danger btn-xs" ><span class="glyphicon glyphicon-remove"></span></a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table> 
          {!! $cursos->setPath('')->render() !!}
          </div>
           <a href="#!" data-toggle='modal' class='btn btn-primary' data-target="#crearAlumno">Nuevo Registro</a>
          </div>   
          </div> 
          @include('vistasplanestudio/crearCurso')       
        </div>
      </div>
    </div>
  </div>
</div>
{!! Form::Open(['route' => [ 'planestudio.curso.destroy', ':VAR_ID'], 'method' => 'DELETE', 'id'=>'form-delete' ]) !!}
{!! Form::close() !!}
@endsection
@section('scripts')
{!! Html::script('/js/eliminar.js')!!}
@endsection