@extends('app')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">Lista Alumnos:  CETPRO<BR>
        Carrera: {{$detgrup->grupos->carreras->nombre}} <BR>
        Modulo: {{$detgrup->grupos->ciclos->ciclo}}     Curso: {{$detgrup->cursos->nombre}}     Grupo: {{$detgrup->grupos->nombre_unidad}}
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
                <th>curso</th>
                <th>Promedio</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody >
              @foreach($detmat as $detallematricula)
              <tr data-id="{{$detallematricula->id}}" class="desmarcado" style='cursor:pointer'>
                <td>{{$detallematricula->id}}</td>
                <td>{{$detallematricula->matriculas->alumnos->nombres}}</td>
                <td>{{$detallematricula->cursos->nombre}}</td>
                <td>{{$detallematricula->promedio}}</td>
                <td data-id="{{$detallematricula->matriculas->alumnos->nombres}}">
                    <a href="#" class="btn-CETPRO" type="button" data-toggle='modal' data-target="#registrarNotasCETPRO"><span class="glyphicon glyphicon-pencil"></span></a>
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
      @include('vistasNotasCETPRO/registrarNotasCETPRO')
    </div>
  </div>
</div>
@endsection
@section('scripts')
{!! Html::script('/js/funcionesNotasCETPRO.js')!!}
{!! Html::script('/js/jquery.tablesorter.min.js')!!}
{!! Html::script('/js/alertify/lib/alertify.js')!!}
{!!Html::style('/js/alertify/themes/alertify.core.css')!!}
{!!Html::style('/js/alertify/themes/alertify.default.css')!!}
<!-- ///// -->
@endsection