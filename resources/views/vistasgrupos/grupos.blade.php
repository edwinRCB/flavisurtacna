@extends('app')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-16 col-md-offset-0">
      <div class="panel panel-default">
        <div class="panel-heading">Lista de Grupos
          {!! Form::model(Request::all(),['route'=>'generalgrupo.grupo.index', 'method'=>'GET','class'=>'navbar-form navbar-left pull-right', 'role'=>'search'])!!}
          <div class="form-group">
            {!! Form::select('carreras[]', $carreras, 'Seleccione', ['class' => 'form-control','name'=>'carrera_id', 'id'=>'carrera_id']) !!}
          </div>
          <button type="submit" class="btn btn-default">Buscar</button>
          {!! Form::close() !!}
        </div>
        <div class="panel-body">
            @if(Session::has('message'))
            <div class="alert alert-info">
              {{ Session::get('message')}}
            </div>
          @endif
        </div>
        <div class="panel-body">
          <div class="table-responsive">
            <a></a>
            <table class="table table-striped table-hover ">
            <thead>
              <tr>
                <th>#</th>
                <th>Carrera</th>
                <th>Ciclo</th>
                <th>Nombre de Unidad</th>
                <th>Horario</th>
                <th>inicio</th>
                <th>Fin</th>
                <th>Local</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody >
            @foreach($grupos as $grupo)
              @if($grupo->carreras->tipo=='INSTITUTO')
                @if($grupo->estado==1)
                <tr data-id="{{$grupo->id}}" class="success">
                  <td>{{$grupo->id}}</td>
                  <td>{{$grupo->carreras->nombre}}</td>
                  <td>{{$grupo->ciclos->ciclo}}</td>
                  <td>{{$grupo->nombre_unidad}}</td>
                  <td>{{$grupo->Horario}}</td>
                  <td>{{$grupo->inicio}}</td>
                  <td>{{$grupo->fin}}</td>
                  <td>{{$grupo->Local}}</td>
                  <td>
                      <a href="{{ route('generalgrupo.grupo.edit', $grupo->id) }}" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-eye-open"></span></a>
                      <a href="#"  class="btn btn-danger btn-xs" data-toggle='modal' data-target="#msjalertaeliminar"><span class="glyphicon glyphicon-remove red"></span></a>
                      <a href="!#" data-toggle='modal' data-target="#msjalerta" class="btn btn-warning btn-xs" ><span class="glyphicon glyphicon-open"></span></a>
                  </td>
                </tr>
                @endif
                @if($grupo->estado==0)
                  <tr data-id="{{$grupo->id}}" class="danger">
                  <td>{{$grupo->id}}</td>
                  <td>{{$grupo->carreras->nombre}}</td>
                  <td>{{$grupo->ciclos->ciclo}}</td>
                  <td>{{$grupo->nombre_unidad}}</td>
                  <td>{{$grupo->Horario}}</td>
                  <td>{{$grupo->inicio}}</td>
                  <td>{{$grupo->fin}}</td>
                  <td>{{$grupo->Local}}</td>
                  <td>
                      <a href="{{ route('generalgrupo.grupo.edit', $grupo->id) }}" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-eye-open"></span></a>
                      <a href="#" class="btn btn-danger btn-xs" ><span class="glyphicon glyphicon-remove red"></span></a>
                      <a href="!#" data-toggle='modal' data-target="#msjalerta" class="btn btn-warning btn-xs" ><span class="glyphicon glyphicon-open"></span></a>
                  </td>
                </tr>
                @endif
              @endif
            @endforeach
            </tbody>
          </table> 
          {!! $grupos->appends(Request::only(['carrera_id']))->setPath('')->render() !!}
          </div>
          @include('vistasgrupos/msjAlerta')
          @include('vistasgrupos/msjAlertaEliminar')
          @include('vistasgrupos/load')
           <a href="{{ route('generalgrupo.grupo.create') }}" class='btn btn-primary' >Nuevo Registro</a>
          </div>   
          </div>       
        </div>
      </div>
    </div>
  </div>
</div>
{!! Form::Open(['route' => [ 'generalgrupo.grupo.destroy', ':VAR_ID'], 'method' => 'DELETE', 'id'=>'form-delete' ]) !!}
{!! Form::close() !!}
@endsection
@section('scripts')
{!! Html::script('/js/eliminargrupo.js')!!}
@endsection