@extends('app')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">Lista de Carreras</div>
        <div class="panel-body">

          <div class="table-responsive">
            <a></a>
            <table class="table table-striped table-hover ">
            <thead>
              <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Tipo</th>
                <th>Duración</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody >
              @foreach($carreras as $carrera)
              <tr data-id="{{$carrera->id}}">
                <td>{{$carrera->id}}</td>
                <td>{{$carrera->nombre}}</td>
                <td>{{$carrera->descripcion}}</td>
                <td>{{$carrera->tipo}}</td>
                <td>{{$carrera->duracion}}</td>
                <td>
                    <a href="{{ route('planestudio.carrera.edit', $carrera->id)}}" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-eye-open"></span></a>
                    <a href="#" class="btn btn-danger btn-xs" ><span class="glyphicon glyphicon-remove"></span></a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table> 
          {!! $carreras->setPath('')->render() !!}
          </div>
           <a href="#!" data-toggle='modal' class='btn btn-primary' data-target="#crearAlumno">Nuevo Registro</a>
          </div>   
          </div> 
          @include('vistasplanestudio/crearCarrera')       
        </div>
      </div>
    </div>
  </div>
</div>
{!! Form::Open(['route' => [ 'planestudio.carrera.destroy', ':VAR_ID'], 'method' => 'DELETE', 'id'=>'form-delete' ]) !!}
{!! Form::close() !!}
@endsection

@section('scripts')
{!! Html::script('/js/eliminar.js')!!}
@endsection