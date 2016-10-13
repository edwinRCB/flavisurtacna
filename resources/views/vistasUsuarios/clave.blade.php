@extends('app')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-6 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">Cambiar Contraseña</div>
          <div class="panel-body">
            
            @if($errors->any())
            <div class="alert alert-danger" role="alert">
              <p>ERROR</p>
              <ul>
              @foreach($errors->all() as $error)
                <li>{{$error}}</li>
              @endforeach

              </ul>
              </div>
            @endif
            
            <div class="form-horizontal"> 
              {!! Form::Open(['route' =>['admin.usuariosAcciones.update'], 'method' => 'PUT', 'id'=>'form-update'])!!}
                <div class="form-group">
                  {!! Form::label('contraseña:', 'Antigua Contraseña:',['class'=>'col-lg-2 control-label']) !!}
                    <div class="col-lg-8">
                      {!! Form::password('clave_actual', ['class'=>'form-control', 'placeholder'=>'***************************'])!!}
                    </div>
                </div>
                <div class="form-group">
                  {!! Form::label('nuevaclave:', 'Nueva Contraseña:',['class'=>'col-lg-2 control-label']) !!}
                    <div class="col-lg-8">
                      {!! Form::password('password',['class'=>'form-control', 'placeholder'=>'***************************'])!!}
                    </div>
                </div>
                <div class="form-group">
                  {!! Form::label('nuevaclave', 'Verifique Contraseña:',['class'=>'col-lg-2 control-label']) !!}
                    <div class="col-lg-8">
                     {!! Form::password('password_confirmation', ['class'=>'form-control', 'placeholder'=>'***************************'])!!}
                    </div>
                </div>
                <div class="modal-footer">
                  <input type="submit" value="Actualizar Contraseña" class="btn btn-primary">
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
