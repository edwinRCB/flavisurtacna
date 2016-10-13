@extends('app')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">Carrera</div>
          <div class="panel-body">
            <div class="form-horizontal"> 
              {!! Form::model($curso, ['route' =>['planestudio.curso.update', $curso->id], 'method' => 'PUT'])!!}
                <div class="form-group">
                  {!! Form::label('Nombre:', 'Curso:',['class'=>'col-lg-2 control-label']) !!}
                    <div class="col-lg-8">
                      {!! Form::text('nombre', null, ['class'=>'form-control', 'placeholder'=>'nombre'])!!}
                    </div>
                </div>
                <div class="form-group">
                  {!! Form::label('Descripcion:', 'Creditos:',['class'=>'col-lg-2 control-label']) !!}
                    <div class="col-lg-8">
                      {!! Form::text('creditos', null, ['class'=>'form-control', 'placeholder'=>'descripción'])!!}
                    </div>
                </div>
                <div class="modal-footer">
                  <a class="btn btn-default" href="{{ url('/planestudio/curso')}}">Volver</a>
                  <input type="submit" value="Actualizar Curso" class="btn btn-primary">
                </div>
                {!! Form::close() !!}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> 
</div>
@stop
@section('scripts')
{!! Html::script('/js/funciones.js')!!}
@endsection