@extends('app')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">Lista Alumnos:  CETPRO PRUEBA</div>
        <div class="panel-body">

          <div id="updatediv" class="table-responsive">
            <a></a>
            <table class="table table-striped table-hover ">
            <thead>
              <tr>
                <th>#</th>
                <th>Alumno</th>
                <th>curso</th>
                <th>Promedio</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody >
              @foreach($detalle_inscripcion as $detalleinscripcion)
              <tr data-id="{{$detalleinscripcion->id}}" class="desmarcado" style='cursor:pointer'>
                <td>{{$detalleinscripcion->id}}</td>
                <td>{{$detalleinscripcion->inscripciones->matriculas->alumnos->nombres}}</td>
                <td>{{$detalleinscripcion->cursos->nombre}}</td>
                <td>{{$detalleinscripcion->promedio}}</td>
                <td data-id="{{$detalleinscripcion->inscripciones->matriculas->alumnos->nombres}}">
                    <a href="#" class="btn-updateNotasCETPRO" type="button" data-toggle='modal' data-target="#registrarNotasCETPRO2"><span class="glyphicon glyphicon-pencil"></span></a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table> 
         {!! $detalle_inscripcion->setPath('')->render() !!}
          </div>
          </div>   
          </div>        
        </div>
      </div>     
      @include('vistasNotasCETPRO/registrarNotasCETPRO2')
    </div>
  </div>
</div>
@endsection
@section('scripts')
{!! Html::script('/js/funciones.js')!!}
@endsection