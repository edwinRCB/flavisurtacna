@extends('app')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">Carrera:{{$repmatricula->carreras->nombre}}<BR>
        Alumno:{{$repmatricula->alumnos->nombres}}</div>
        <div class="panel-body">

          <div class="table-responsive">
            <a></a>
            <table class="table table-striped table-hover ">
            <thead>
              <tr>
                <th>#</th>
                <th>curso</th>
                <th>creditos</th>
                <th>grupo</th>
              </tr>
            </thead>
            <tbody >
              @foreach($repmatricula->detalles_matriculas as $detalle)
              <tr>
                <td></td>
                <td>{{$detalle->cursos->nombre}}</td>
                <td>{{$detalle->cursos->creditos}}</td>
                <td>{{$detalle->grupos->nombre_unidad}}</td>
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
  </div>
</div>

@endsection