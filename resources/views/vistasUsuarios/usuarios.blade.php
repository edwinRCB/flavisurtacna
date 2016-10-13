@extends('app')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">Lista de usuarios
          {!! Form::open(['route'=>'admin.usuarios.index', 'method'=>'GET','class'=>'navbar-form navbar-left pull-right', 'role'=>'search'])!!}
          <div class="form-group">
            {!! Form::text('usuario', null,['class'=> 'form-control', 'placeholder'=>'nombre de usuario']) !!}
          </div>
          <button type="submit" class="btn btn-default">Buscar</button>
          {!! Form::close() !!}
        </div>
        <div class="panel-body"></div>
        <div class="panel-body">
          <div class="table-responsive">
            <a></a>
            <table class="table table-striped table-hover ">
            <thead>
              <tr>
                <th>#</th>
                <th>Nombres</th>
                <th>E-MAIL</th>
                <th>Tipo</th>
                <th>Contraseña</th>
              </tr>
            </thead>
            <tbody >
              @foreach($usuarios as $usuario)
              <tr data-id="{{$usuario->id}}">
                <td>{{$usuario->id}}</td>
                <td>{{$usuario->name}}</td>
                <td>{{$usuario->email}}</td>
                <td>{{$usuario->tipo}}</td>
                <td>{{$usuario->clavesss}}</td>
                <td>
                  <a href="{{ route('admin.usuarios.edit', $usuario->id) }}" title="Ver y Editar" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-eye-open"></span></a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table> 
         {!! $usuarios->setPath('')->render() !!}

          </div>

           <a href="#!" data-toggle='modal' class='btn btn-primary' data-target="#crearUsuario">Nuevo Registro</a>
          </div>   
          </div>        
        </div>
      </div>  
      @include('vistasUsuarios/crearUsuario')   
    </div>
  </div>
</div>
{!! Form::Open(['route' => [ 'alu.alumnos.destroy', ':ALUMNO_ID'], 'method' => 'DELETE', 'id'=>'form-delete' ]) !!}
{!! Form::close() !!}
@endsection

@section('scripts')
@endsection
