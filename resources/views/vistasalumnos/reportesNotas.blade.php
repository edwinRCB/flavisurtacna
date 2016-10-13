@extends('app')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">Matriculas
        </div>
        <div class="panel-body">

          <div class="table-responsive">
            <a></a>
            <table class="table table-striped table-hover ">
            <thead>
              <tr>
                <th>#</th>
                <th>Carrera</th>
                <th>Alumno</th>
                <th><center>C/S</center></th>
                <th>Fecha Matricula</th>
                <th>Inicio</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody >
              @foreach($matriculas as $matricula)
              <tr data-id="{{$matricula->id}}">
                <td>{{$matricula->id}}</td>
                <td>{{$matricula->carreras->nombre}}</td>
                <td>{{$matricula->alumnos->nombres}}</td>
                <td><center>{{$matricula->name_ciclo}}</center></td>
                <td>{{$matricula->fecha_matricula}}</td>
                <td>{{$matricula->InicioGrupo}}</td>
                <td>
                  <a href="{{ url('generarPDF', $matricula->id)}}" title="Reporte Global" class="btn btn-warning btn-xs" target="_blank" ><span class="glyphicon glyphicon-list"></span></a>
                  <a href="{{ route('alu.reportes.show', $matricula->id)}}" title="Reporte Elaborado" class="btn btn-info btn-xs" target="_blank" ><span class="glyphicon glyphicon-list"></span></a>
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
@endsection

@section('scripts')
@endsection