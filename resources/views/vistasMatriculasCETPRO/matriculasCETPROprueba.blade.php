@extends('app')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12 col-md-offset-0">
      <div class="panel panel-default">
        <div class="panel-heading">Lista de Matriculados CETPRO PRUEBA
          {!! Form::open(['route'=>'cetpromatricula.matriculacetpro.index', 'method'=>'GET','class'=>'navbar-form navbar-left pull-right', 'role'=>'search'])!!}
          <div class="form-group">
            {!! Form::text('nombres', null,['class'=> 'form-control', 'placeholder'=>'nombre de alumno']) !!}
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
                  <th>Carrera</th>
                  <th>Nombres</th>
                  <th>Grupo</th>
                  <th>Fecha Matricula</th>
                  <th>N° Boleta</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody >
              @foreach($matriculas as $matricula)
                @if($matricula->carreras->tipo == "CETPRO")
                <tr data-id="{{$matricula->id}}">
                  <td>{{$matricula->id}}</td>
                  <td>{{$matricula->carreras->nombre}}</td>
                  <td>{{$matricula->alumnos->nombres}}</td>
                  <td>{{$matricula->name_grupo}}</td>
                  <td>{{$matricula->fecha_matricula}}</td>
                  <td>{{$matricula->nroboleta}}</td>
                  
                  <td>
                      <a href="{{ route('cetpromatricula.matriculacetpro.edit', $matricula->id) }}" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-eye-open"></span></a>
                      <a href="{{ route('institutomatricula.matricula.show', $matricula->id) }}" class="btn btn-warning btn-xs", target="_blank"><span class="glyphicon glyphicon-list"></span></a>
                      <a href="{{ route('cetpromatricula.matriculacetpro.show', $matricula->id) }}" class="btn btn-info btn-xs", target="_blank"><span class="glyphicon glyphicon-plus-sign"></span></a>
                      <a href="#" class="btn btn-danger btn-xs" ><span class="glyphicon glyphicon-remove red"></span></a>
                  </td>
                </tr>
                @endif
              @endforeach
              </tbody>
            </table> 
            {!! $matriculas->setPath('')->render() !!}
            </div> 
             <a href="{{ route('cetpromatricula.inscripciones.create') }}" class='btn btn-primary' >Nuevo Registro</a>
          </div> 
        </div>       
    </div>
  </div>
</div>


@endsection
@section('scripts')
<!--{!! Html::script('/js/update.js')!!}-->
@endsection