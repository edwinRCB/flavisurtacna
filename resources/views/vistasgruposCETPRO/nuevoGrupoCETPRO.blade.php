@extends('app')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">Nuevo Grupo CETPRO</div>
          <div class="panel-body">
            <div class="form-horizontal"> 
              {!! Form::Open(['route' =>['generalgrupo.grupocetpro.store'], 'method' => 'POST'])!!}
                <div class="form-group">
                {!! Form::label(':','Carrera:',['class'=>'col-lg-2 control-label']) !!}
                  <div class="col-lg-8">
                    {!! Form::select('carreras[]', $carreras, 'Seleccione', ['class' => 'form-control','name'=>'carrera_id', 'id'=>'carrera']) !!}
                  </div>
                </div>
                 <div class="form-group">
                    {!! Form::label(':','Unidad:',['class'=>'col-lg-2 control-label']) !!}
                  <div class="col-lg-8">
                  <select  class="form-control" id="ciclo_id" name="ciclo_id">
                    <option value="">Es necesario seleccionar una carrera</option>
                  </select>
                  </div>
                </div>
                <div class="form-group">
                  {!! Form::label('nombre:', 'Nombre Unidad:',['class'=>'col-lg-2 control-label']) !!}
                    <div class="col-lg-8">
                      {!! Form::text('nombre_unidad', null, ['class'=>'form-control', 'placeholder'=>'nombre unidad'])!!}
                    </div>
                </div>
                <div class="form-group">
                  {!! Form::label(':', 'Horario:',['class'=>'col-lg-2 control-label']) !!}
                    <div class="col-lg-8">
                      {!! Form::text('Horario', null, ['class'=>'form-control', 'placeholder'=>'horario'])!!}
                    </div>
                </div>

                <div class="form-group">
                  {!! Form::label(':', 'Ciudad:',['class'=>'col-lg-2 control-label']) !!}
                  <div class="col-xs-4">
                    <select class="form-control" name="ciudad">
                        <option >Seleccione</option>
                        <option value="AREQUIPA">AREQUIPA</option>
                        <option value="TACNA">TACNA</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  {!! Form::label(':', 'Local:',['class'=>'col-lg-2 control-label']) !!}
                    <div class="col-lg-8">
                      {!! Form::text('Local', null, ['class'=>'form-control', 'placeholder'=>'Local'])!!}
                    </div>
                </div>
                <div class="form-group">
                  {!! Form::label(':', 'Inicio:',['class'=>'col-lg-2 control-label']) !!}
                    <div class="col-lg-8">
                          <div class='input-group date' id='inicio'>
                              <input type='text' class="form-control" name="inicio"/>
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
                              <input type='text' class="form-control" name='fin' />
                              <span class="input-group-addon">
                                  <span class="glyphicon glyphicon-calendar"></span>
                              </span>
                          </div>
                    </div>
                </div>
                <div class="modal-footer">
                  <a class="btn btn-default" href="{{ url('/generalgrupo/grupocetpro')}}">Volver</a>
                  <input type="submit" value="Crear Grupo" class="btn btn-primary" data-toggle='modal' data-target="#Loading" >
                </div>
                {!! Form::close() !!}
                @include('vistasgruposCETPRO/load')
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> 
</div>
@endsection
@section('scripts')
{!! Html::script('/js/funciones.js')!!}
{!! Html::script('/js/funcionpicker.js')!!}
@endsection