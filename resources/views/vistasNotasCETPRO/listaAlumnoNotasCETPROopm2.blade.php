@extends('app')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12 col-md-offset-0">
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
                <th>CT1</th>
                <th>CT2</th>
                <th>CT3</th>
                <th>CT4</th>
                <th>CT5</th>
                <th>CT6</th>
                <th>Promedio</th>
              </tr>
            </thead>
            <tbody >
              @foreach($detmat as $detallematricula)
              <tr data-id="{{$detallematricula->id}}" class="desmarcado" style='cursor:pointer'>
                <td>{{$detallematricula->id}}</td>
                <td>{{$detallematricula->matriculas->alumnos->nombres}}</td>
                <td class="nota1" contenteditable="true">{{$detallematricula->nota1}}</td>
                <td class="nota2" contenteditable="true">{{$detallematricula->nota2}}</td>
                <td class="nota3" contenteditable="true">{{$detallematricula->nota3}}</td>
                <td class="nota4" contenteditable="true">{{$detallematricula->pr_unidad}}</td>
                <td class="nota5" contenteditable="true">{{$detallematricula->sg_unidad}}</td>
                <td class="nota6" contenteditable="true">{{$detallematricula->tr_unidad}}</td>
                <td class="promedio" contenteditable="false">{{$detallematricula->promedio}}</td>
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