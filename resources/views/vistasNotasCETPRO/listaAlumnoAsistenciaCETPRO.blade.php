@extends('app')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">CETPRO ASISTENCIA<BR>
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
                <th><center>Asistencia</center></th>
              </tr>
            </thead>
            <tbody >
              @foreach($detmat as $detallematricula)
              <tr data-id="{{$detallematricula->id}}" class="desmarcado" style='cursor:pointer'>
                <td>{{$detallematricula->id}}</td>
                <td>{{$detallematricula->matriculas->alumnos->nombres}}</td>
                <td ><center>{!! Form::checkbox('matricula', 'mat', null, array('class' => 'asistencia')) !!}</center></td>
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
{!! Html::script('/js/asistencia.js')!!}
{!! Html::script('/js/jquery.tablesorter.min.js')!!}
{!! Html::script('/js/alertify/lib/alertify.js')!!}
{!!Html::style('/js/alertify/themes/alertify.core.css')!!}
{!!Html::style('/js/alertify/themes/alertify.default.css')!!}
<!-- ///// -->
@endsection