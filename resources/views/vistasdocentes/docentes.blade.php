@extends('app')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">Lista de Alumnos</div>
        <div class="panel-body">

          <div class="table-responsive">
            <a></a>
            <table class="table table-striped table-hover ">
            <thead>
              <tr>
                <th>#</th>
                <th>DNI</th>
                <th>Nombres</th>
                <th>Dirección</th>
                <th>Estado Civil</th>
                <th>Teléfonos</th>
                <th>Email</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody >
              @foreach($docentes as $docente)
              <tr data-id="{{$docente->id}}">
                <td>{{$docente->id}}</td>
                <td>{{$docente->dni}}</td>
                <td>{{$docente->nombres}}</td>
                <td>{{$docente->direccion}}</td>
                <td>{{$docente->estadocivil}}</td>
                <td>{{$docente->telefonos}}</td>
                <td>{{$docente->email}}</td>
                <td>
                    <a href="{{ route('profesores.docente.edit', $docente->id) }}" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-eye-open"></span></a>
                    <a href="#" class="btn-delete" ><span class="glyphicon glyphicon-remove red"></span></a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table> 
         {!! $docentes->setPath('')->render() !!}
          </div>
           <a href="#!" data-toggle='modal' class='btn btn-primary' data-target="#nuevoDocente">Nuevo Registro</a>
          </div>   
          </div>        
        </div>
      </div>     
     @include('vistasdocentes/nuevoDocente')
    </div>
  </div>
</div>
{!! Form::Open(['route' => [ 'profesores.docente.destroy', ':VAR_ID'], 'method' => 'DELETE', 'id'=>'form-delete' ]) !!}
{!! Form::close() !!}
@endsection

@section('scripts')
{!! Html::script('/js/eliminar.js') !!}
@endsection
