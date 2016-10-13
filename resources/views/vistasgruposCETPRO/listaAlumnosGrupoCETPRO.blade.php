@extends('app')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">Lista Alumnos:  CETPRO<BR>
        Carrera: {{$detgrup->grupos->carreras->nombre}} <BR>
        Modulo: {{$detgrup->grupos->ciclos->ciclo}}
        </div>
          <div class="alert alert-dismissible alert-success">
            <button type="button" class="close" data-dismiss="alert">CERRAR MENSAJE</button>
            <strong>La lista de alumnos puede ser ordenada alfabéticamente si usted le da clic en "Alumno"</strong>
          </div>
        <div class="panel-body">
          <div id="updatediv" class="table-responsive">
            <a></a>
            <table  id="mytable" class="table table-striped table-hover ">
            <thead>
              <tr>
                <th>#</th>
                <th>Alumno</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody >
              @foreach($detmat as $detallematricula)
              <tr data-id="{{$detallematricula->id}}" class="desmarcado" style='cursor:pointer'>
                <td>{{$detallematricula->id}}</td>
                <td>{{$detallematricula->matriculas->alumnos->nombres}}</td>
                <td data-id="{{$detallematricula->matriculas->alumnos->nombres}}">
                    <a href="{{ route('cetpromatricula.matriculacetpro.show', $detallematricula->matricula_id) }}" class="btn btn-info btn-xs", target="_blank"><span class="glyphicon glyphicon-plus-sign"></span></a>
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
  </div>
</div>
@endsection
@section('scripts')
{!! Html::script('/js/jquery.tablesorter.min.js')!!}
{!! Html::script('/js/funcionesNotasCETPRO.js')!!}
@endsection