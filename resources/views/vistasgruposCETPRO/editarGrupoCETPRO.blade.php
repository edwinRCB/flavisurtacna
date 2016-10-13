@extends('app')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">Actualizar Grupo: {{$grupos->carreras->nombre}}</div>
          <div class="panel-body">
            <div class="form-horizontal"> 
              {!! Form::model($grupos, ['route' =>['generalgrupo.grupocetpro.update', $grupos->id], 'method' => 'PUT'])!!}
                <div class="form-group">
                  {!! Form::label(':','Modulo:',['class'=>'col-lg-2 control-label']) !!}
                  <div class="col-lg-8">
                    {!! Form::select('modulos[]', $modulos, '', ['class' => 'form-control','name'=>'ciclo_id', 'id'=>'ciclo_id']) !!}
                  </div>
                </div>
                <div class="form-group">
                  {!! Form::label(':', 'Nombre Grupo:',['class'=>'col-lg-2 control-label']) !!}
                    <div class="col-lg-8">
                      {!! Form::text('nombre_unidad', null, ['class'=>'form-control', 'placeholder'=>'nombre unidad'])!!}
                    </div>
                </div>
                <div class="form-group">
                  {!! Form::label('nombre:', 'Horario:',['class'=>'col-lg-2 control-label']) !!}
                    <div class="col-lg-8">
                      {!! Form::text('Horario', null, ['class'=>'form-control', 'placeholder'=>'ejemplo: 8:00 am - 11:00am'])!!}
                    </div>
                </div>
                <div class="form-group">
                  {!! Form::label('nombre:', 'Local:',['class'=>'col-lg-2 control-label']) !!}
                    <div class="col-lg-8">
                      {!! Form::text('Local', null, ['class'=>'form-control', 'placeholder'=>'Local'])!!}
                    </div>
                </div>
                <div class="form-group">
                  {!! Form::label(':', 'Inicio:',['class'=>'col-lg-2 control-label']) !!}
                    <div class="col-lg-8">
                          <div class='input-group date' id='inicio'>
                              {!! Form::text('inicio', null, ['class'=>'form-control'])!!}
                              <span class="input-group-addon">
                                  <span class="glyphicon glyphicon-calendar"></span>
                              </span>
                          </div>
                    </div>
                </div>
                <div class="form-group">
                  {!! Form::label(':', 'Fin:',['class'=>'col-lg-2 control-label']) !!}
                    <div class="col-lg-8">
                          <div class='input-group date' id='fin'>
                              {!! Form::text('fin', null, ['class'=>'form-control'])!!}
                              <span class="input-group-addon">
                                  <span class="glyphicon glyphicon-calendar"></span>
                              </span>
                          </div>
                    </div>
                </div>
                <div class="modal-footer">
                  <a class="btn btn-default" href="{{ url('/generalgrupo/grupocetpro')}}">Volver</a>
                  <input type="submit" value="Actualizar Grupo" class="btn btn-primary">
                </div>
                {!! Form::close() !!}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> 
</div>
<div id='update' class="container">
  <div class="row marketing">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-primary">
        <div class="panel-heading">Cursos - Docentes
          <a href="" class="btn btn-default pull-right btn-sm"><span class="glyphicon glyphicon-refresh"> Actualizar</span></a>
        </div>
          <div class="col-md-12 col-md-offset">
            <div class="panel-body">
             <div class="row marketing">
                <!-- Aquí listamos todos los Ciclos -->
                  <div  class="panel panel-primary">
                        <!-- Aquí listamos todos los cursos de un ciclo -->
                        <div class ="table-responsive">
                          <table class="table table-striped table-hover">
                            <thead>
                              <th>#</th>
                              <th>Curso</th>
                              <th>Docente</th>
                              <th>Acciones</th>
                            </thead>
                            <tbody>
                              @foreach($grupos->detalles_grupos as $detalles)
                              <tr data-id= "{{$detalles->id}}">
                                <td>{{$detalles->id}}</td>
                                <td id="tdcurso" data-id="{{$detalles->cursos->nombre}}">{{$detalles->cursos->nombre}}</td>
                                <td>{{$detalles->users->name}}</td>
                                <td data-id="{{$detalles->cursos->nombre}}">
                                  <a href="" class="btn-update" type="button" data-toggle='modal' data-target="#asignarDocente"><span class= "glyphicon glyphicon-pencil"></span></a>
                                  <a href="{{ route('generalgrupo.grupocetpro.show', $detalles->id) }}" class="btn btn-warning btn-xs", target="_blank"><span class="glyphicon glyphicon-list"></span></a>
                                  <a href="{{ route('generalgrupo.accionesAdicionales.show', $detalles->id) }}" class="btn btn-info btn-xs", target="_blank"><span class="glyphicon glyphicon-edit"></span></a>
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
</div>
@include('vistasgrupos/asignarDocente')
@endsection
@section('scripts')
{!! Html::script('/js/funcionpicker.js')!!}
{!! Html::script('/js/funciones.js')!!}
@endsection