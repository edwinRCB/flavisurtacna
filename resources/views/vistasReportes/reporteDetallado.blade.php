@extends('app')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-16 col-md-offset-0">
      <div class="panel panel-default">
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
                <th>Nombres</th>
                <th>Modulo</th>
                <th>Curso</th>
                <th>promedio</th>
              </tr>
            </thead>
            <tbody >
            @foreach($alumnos as $alumno)
                <tr data-id="{{$alumno->id}}" class="success">
                  <td>{{$alumno->matriculas->alumnos->id}}</td>
                  <td>{{$alumno->matriculas->alumnos->nombres}}</td>
                  <td>{{$alumno->grupos->ciclos->ciclo}}</td>
                  <td>{{$alumno->cursos->nombre}}</td>
                  <td>{{$alumno->promedio}}</td>
                </tr>

            @endforeach
            </tbody>
          </table> 
          <!--{!! $alumnos->setPath('')->render() !!}-->
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
<!--{!! Html::script('/js/eliminargrupo.js')!!}-->
@endsection