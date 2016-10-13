@extends('app')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">Lista de Alumnos
          {!! Form::open(['route'=>'alu.alumnos.index', 'method'=>'GET','class'=>'navbar-form navbar-left pull-right', 'role'=>'search'])!!}
          <div class="form-group">
            {!! Form::text('dni', null,['class'=> 'form-control', 'placeholder'=>'DNI de alumno']) !!}
          </div>
          <div class="form-group">
            {!! Form::text('nombres', null,['class'=> 'form-control', 'placeholder'=>'nombre de alumno']) !!}
          </div>
          <button type="submit" class="btn btn-default">Buscar</button>
          {!! Form::close() !!}
        </div>
            @if($errors->any())
            <div class="alert alert-danger" role="alert">
              <p>ERROR</p>
              <ul>
              @foreach($errors->all() as $error)
                <li>{{$error}}</li>
              @endforeach

              </ul>
              </div>
            @endif
        <div class="panel-body">
          <div id ="successMessages"></div>
        </div>
        <div class="panel-body">
          <div class="table-responsive">
            <a></a>
            <table class="table table-striped table-hover ">
            <thead>
              <tr>
                <th>#</th>
                <th>DNI</th>
                <th>Nombres</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody >
              @foreach($alumnos->take(20) as $alumno)
              <tr data-id="{{$alumno->id}}">
                <td>{{$alumno->id}}</td>
                <td>{{$alumno->dni}}</td>
                <td>{{$alumno->nombres}}</td>
                <td>
                    <a href="{{ route('alu.alumnos.edit', $alumno->id) }}" title="Ver y Editar" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-eye-open"></span></a>
                    <a href="{{ route('alu.alumnos.show', $alumno->id) }}" title="Historial" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-list-alt"></span></a>
                    <a href="#" class="btn btn-danger btn-xs" title="Eliminar"  data-toggle='modal' data-target="#msjalertaeliminar"><span class="glyphicon glyphicon-remove red"></span></a> 
                </td>
              </tr>
              @endforeach
            </tbody>
          </table> 
         {!! $alumnos->appends(Request::only(['nombres']))->setPath('')->render() !!}
          </div>
           <a href="#!" data-toggle='modal' class='btn btn-primary' data-target="#crearAlumno">Nuevo Registro</a>
          </div>   
          </div>        
        </div>
      </div>    

      @include('vistasalumnos/crear')
      @include('vistasalumnos/msjAlertaEliminar')
      @include('load') 
      @include('vistasalumnos/notificacion')
      
    </div>
  </div>
</div>
{!! Form::Open(['route' => [ 'alu.alumnos.destroy', ':VAR_ID'], 'method' => 'DELETE', 'id'=>'form-delete' ]) !!}
{!! Form::close() !!}
@endsection

@section('scripts')
{!! Html::script('/js/eliminarAlumno.js')!!}
{!! Html::script('/js/miniNotification.js')!!}
{!! Html::script('/js/alertify/lib/alertify.js')!!}
{!!Html::style('/js/alertify/themes/alertify.core.css')!!}
{!!Html::style('/js/alertify/themes/alertify.default.css')!!}
{!! Html::script('/js/funcionpicker.js')!!}
@endsection
