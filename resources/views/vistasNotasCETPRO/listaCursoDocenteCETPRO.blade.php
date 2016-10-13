@extends('app')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-14 col-md-offset-0">
      <div class="panel panel-default">
        <div class="panel-heading">Cursos Asignados</div>
        <div class="panel-body">
          <div class="alert alert-dismissible alert-success">
            <button type="button" class="close" data-dismiss="alert">CERRAR MENSAJE</button>
            <strong>Nueva forma de Ingresar Notas, Descargar Tutorial--> <a href='https://mega.nz/#!6UUwUYYa!LSiSi9x6DBSZnTz4Zk_lk-ghFTk5gW9NTtIlor1vVZ0' target="_blank"/>click aqui</a></strong>
          </div>
          <div class="table-responsive">
            <a></a>
            <table class="table table-striped table-hover ">
            <thead>
              <tr>
                <th>#</th>
                <th>carrera</th>
                <th>Curso</th>
                <th>Modulo</th>
                <th>Grupo</th>
                <th>Horario</th>
                <th>Inicio</th>
                <th>Fin</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody >
              @foreach($detallesgrupos as $detallegrupo)
              <tr data-id>
                <td>{{$detallegrupo->id}}</td>
                <td>{{$detallegrupo->grupos->carreras->nombre}}</td>
                <td>{{$detallegrupo->cursos->nombre}}</td>
                <td>{{$detallegrupo->grupos->ciclos->ciclo}}</td>
                <td>{{$detallegrupo->grupos->nombre_unidad}}</td>
                <td>{{$detallegrupo->grupos->Horario}}</td>
                <td>{{$detallegrupo->grupos->inicio}}</td>
                <td>{{$detallegrupo->grupos->fin}}</td>
                <td>
                    <a href="{{ route('usuarios.calificacionescetpro.show', $detallegrupo->id) }}" title="ver curso" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-eye-open"></span></a>
                    <a href="{{ route('usuarios.calificacionescetpro.edit', $detallegrupo->id) }}" title="Exportar a PDF" class="btn btn-info btn-xs" target="_blank"><span class="glyphicon glyphicon-list-alt"></span></a>
                    <a href="{{ route('asistencia.asistenciacetpro.show', $detallegrupo->id) }}" title="Asistencia" class="btn btn-warning btn-xs" ><span class="glyphicon glyphicon-check"></span></a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table> 
         {!! $detallesgrupos->setPath('')->render() !!}
          </div>
          </div>   
          </div>        
        </div>
      </div>     
      <!--@include('vistasalumnos/crear')-->
    </div>
  </div>
</div>
@endsection
@section('scripts')

@endsection