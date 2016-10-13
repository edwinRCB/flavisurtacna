@extends('app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12 col-md-offset-0">
      <div class="panel panel-default">
        <div class="panel-heading">Cursos Asignados<BR>
        Carrera: {{$detgrup->grupos->carreras->nombre}} <BR>
        Modulo: {{$detgrup->grupos->ciclos->ciclo}}     Curso: {{$detgrup->cursos->nombre}}     Grupo: {{$detgrup->grupos->nombre_unidad}}
        </div>
          <div class="panel-body">
            @if(Session::has('message'))
            <div class="alert alert-info">
              {{ Session::get('message')}}
            </div>
          @endif
        </div>
        <div class="panel-body">

          <div id="updatediv" class="table-responsive">
            <a></a>
            <table id="mytable" class="table table-striped table-hover ">
            <thead>
              <tr>
                <th>#</th>
                <th>Alumno</th>
                <th>curso</th>
                <th>1raUnidad</th>
                <th>2daUnidad</th>
                <th>3raUnidad</th>
                <th>Promedio</th>
              </tr>
            </thead>
            <tbody >
              @foreach($detmat as $detallematricula)
              <tr data-id="{{$detallematricula->id}}" class="desmarcadoInstituto" style='cursor:pointer'>
                <td>{{$detallematricula->id}}</td>
                <td>{{$detallematricula->matriculas->alumnos->nombres}}</td>
                <td>{{$detallematricula->cursos->nombre}}</td>
                <td class="n1" contenteditable="true">{{$detallematricula->pr_unidad}}</td>
                <td class="n2" contenteditable="true">{{$detallematricula->sg_unidad}}</td>
                @if($detallematricula->cursos->nombre == 'Operación de Maquinaria Pesada')
                <td>-/-</td>
                @else
                <td class="n3" contenteditable="true">{{$detallematricula->tr_unidad}}</td>
                @endif
                <td>{{$detallematricula->promedio}}</td>
              </tr>
              @endforeach
            </tbody>
          </table> 
         {!! $detmat->setPath('')->render() !!}
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
{!! Html::script('/js/funcionesNotas.js')!!}
{!! Html::script('/js/jquery.tablesorter.min.js')!!}
{!! Html::script('/js/alertify/lib/alertify.js')!!}
{!!Html::style('/js/alertify/themes/alertify.core.css')!!}
{!!Html::style('/js/alertify/themes/alertify.default.css')!!}
@endsection