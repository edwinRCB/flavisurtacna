@extends('app')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">Lista de Alumnos</div>
          <div class="panel-body">
            <div class="form-horizontal"> 
              {!! Form::model($alumnomodel, ['route' =>['alu.alumnos.update', $alumnomodel->id], 'method' => 'PUT'])!!}
                <div class="form-group">
                  {!! Form::label('dni:', 'DNI:',['class'=>'col-lg-2 control-label']) !!}
                    <div class="col-lg-8">
                      {!! Form::text('dni', null, ['class'=>'form-control', 'placeholder'=>'dni'])!!}
                    </div>
                </div>
                <div class="form-group">
                  {!! Form::label('nombre:', 'Nombres:',['class'=>'col-lg-2 control-label']) !!}
                    <div class="col-lg-8">
                      {!! Form::text('nombres', null, ['class'=>'form-control', 'placeholder'=>'nombres'])!!}
                    </div>
                </div>
                <div class="form-group">
                  {!! Form::label(':', 'Fecha Nacimiento:',['class'=>'col-lg-2 control-label']) !!}
                    <div class="col-lg-8">
                          <div class='input-group date' id='fin'>
                              {!! Form::text('fec_nacimiento', null, ['class'=>'form-control'])!!}
                              <span class="input-group-addon">
                                  <span class="glyphicon glyphicon-calendar"></span>
                              </span>
                          </div>
                    </div>
                </div>
                <div class="form-group">
                  {!! Form::label('Telefono', 'Teléfono:',['class'=>'col-lg-2 control-label']) !!}
                    <div class="col-lg-8">
                      {!! Form::text('telefono', null, ['class'=>'form-control', 'placeholder'=>'teléfonos'])!!}
                    </div>
                </div>
                <div class="form-group">
                  {!! Form::label('Email:', 'Email:',['class'=>'col-lg-2 control-label']) !!}
                    <div class="col-lg-8">
                      {!! Form::email('email', null, ['class'=>'form-control', 'placeholder'=>'ejemplo@ejemplo.com'])!!}
                    </div>
                </div>
                <div class="modal-footer">
                  <a class="btn btn-default" href="{{ url('/alu/alumnos')}}">Volver</a>
                  <input type="submit" value="ActualizarUsuario" class="btn btn-primary">
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
{!! Html::script('/js/funcionpicker.js')!!}
@endsection