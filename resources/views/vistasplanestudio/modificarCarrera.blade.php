@extends('app')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">Carrera</div>
          <div class="panel-body">
            <div class="form-horizontal"> 
              {!! Form::model($carreras, ['route' =>['planestudio.carrera.update', $carreras->id], 'method' => 'PUT'])!!}
                <div class="form-group">
                  {!! Form::label('Nombre:', 'Nombre Carrera:',['class'=>'col-lg-2 control-label']) !!}
                    <div class="col-lg-8">
                      {!! Form::text('nombre', null, ['class'=>'form-control', 'placeholder'=>'nombre'])!!}
                    </div>
                </div>
                <div class="form-group">
                  {!! Form::label('Descripcion:', 'Descripción:',['class'=>'col-lg-2 control-label']) !!}
                    <div class="col-lg-8">
                      {!! Form::text('descripcion', null, ['class'=>'form-control', 'placeholder'=>'descripción'])!!}
                    </div>
                </div>
                <div class="form-group">
                  {!! Form::label('Tipo', 'Tipo:',['class'=>'col-lg-2 control-label']) !!}
                    <div class="col-lg-8">
                     {!! Form::text('tipo', null, ['class'=>'form-control', 'placeholder'=>'tipo'])!!}
                    </div>
                </div>
                <div class="form-group">
                  {!! Form::label('Duracion', 'Duración:',['class'=>'col-lg-2 control-label']) !!}
                    <div class="col-lg-8">
                      {!! Form::text('duracion', null, ['class'=>'form-control', 'placeholder'=>'duracion'])!!}
                    </div>
                </div>
                <div class="modal-footer">
                  <a class="btn btn-default" href="{{ url('/planestudio/carrera')}}">Volver</a>
                  <input type="submit" value="ActualizarCarrera" class="btn btn-primary">

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
        <div class="panel-heading">Semestres - Modulos
          <a type="#" data-toggle='modal' data-target="#crearCiclo" class="btn btn-default pull-right btn-sm"><span>Agregar Semestre</span></a>
          <a type="#" data-toggle='modal' data-target="#agregarCurso" class="btn btn-default pull-right btn-sm"><span>Agregar Curso</span></a>
          <a href="" class="btn btn-default pull-right btn-sm"><span class="glyphicon glyphicon-refresh"> Actualizar</span></a>
        </div>
          <div class="col-md-12 col-md-offset">
            <div class="panel-body">
             <div class="row marketing">
                <!-- Aquí listamos todos los Ciclos -->
                @foreach($carreras->semestres as $semestre)
                  <div id="panel-semestre" class="panel panel-primary">
                      <div data-id="{{$semestre->id}}" class="panel-heading">{{ $semestre->ciclo}}
                        <a type="#" class="btn btn-danger pull-right btn-sm">Eliminara Registro</a> 
                      </div>
                        <!-- Aquí listamos todos los cursos de un ciclo -->
                        <div class ="table-responsive">
                          <table class="table table-striped table-hover">
                            <thead>
                              <th>#</th>
                              <th>Curso</th>
                              <th>Creditos</th>
                              <th>Acciones</th>
                            </thead>
                            <tbody>
                              @foreach($semestre->cursos as $curso)
                              <tr data-id="{{$curso->id}}">
                                <td>{{$curso->id}}</td>
                                <td>{{$curso->nombre}}</td>
                                <td>{{$curso->creditos}}</td>
                                <td data-id="{{$semestre->id}}"><a href="#" class="btn-deletecurso" title="Eliminar" ><span class="glyphicon glyphicon-remove red"></span></a> </td>
                                </td>
                              </tr>
                              @endforeach
                            </tbody>
                          </table>
                        </div>
                  </div>
                @endforeach
              </div> 
            </div> 
          </div>
      </div>
    </div>
  </div>
</div>
{!! Form::Open(['route' => [ 'planestudio.semestre.destroy', ':VAR_ID'], 'method' => 'DELETE', 'id'=>'form-delete' ]) !!}
{!! Form::close() !!}
{!! Form::Open(['route' => [ 'planestudio.cursosemestre.destroy', ':VAR_ID'], 'method' => 'DELETE', 'id'=>'form-Eliminar' ]) !!}
{!! Form::close() !!}
@include('vistasplanestudio/crearCiclo')
@include('vistasplanestudio/agregarCurso')
@stop
@section('scripts')
{!! Html::script('/js/eliminarCiclo.js')!!}
{!! Html::script('/js/funciones.js')!!}
@endsection