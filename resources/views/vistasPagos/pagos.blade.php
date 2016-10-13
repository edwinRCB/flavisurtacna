@extends('app')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">Matricular Alumno</div>
          <div class="panel-body">
            <div class="form-horizontal"> 
                <div class="form-group">
                  {!! Form::label(':','Nombres:',['class'=>'col-lg-2 control-label']) !!}
                    <div class="col-lg-8">
                      {!! Form::text('auto', '', ['class'=>'form-control', 'id' =>  'auto', 'placeholder' =>  'ingrese nombre'])!!}
                      {!! Form::hidden('alumno_id', '', ['id' => 'alumno_data']) !!}
                    <!--<input id="auto" name="auto" class="form-control input-sm" autocomplete="off" />-->
                    </div>
                </div>
                <div class="form-group">
                  {!! Form::label('boleta:', 'Nro Boleta:',['class'=>'col-lg-2 control-label']) !!}
                    <div class="col-lg-8">
                      {!! Form::text('nroboleta', null, ['class'=>'form-control', 'placeholder'=>'nro boleta'])!!}
                    </div>
                </div>
                <div class="form-group">
                  {!! Form::label('dni:', 'DNI:',['class'=>'col-lg-2 control-label']) !!}
                    <div class="col-lg-8">
                      {!! Form::text('dni', null, ['class'=>'form-control', 'placeholder'=>'dni'])!!}
                    </div>
                </div>
                <div class="form-group">
                  {!! Form::label('pension:', 'Pensión:',['class'=>'col-lg-2 control-label']) !!}
                    <div class="col-lg-8">
                      {!! Form::text('pension', null, ['class'=>'form-control', 'placeholder'=>'dni'])!!}
                    </div>
                </div>
                <div class="form-group">
                  {!! Form::label('monto:', 'Monto:',['class'=>'col-lg-2 control-label']) !!}
                    <div class="col-lg-8">
                      {!! Form::text('monto', null, ['class'=>'form-control', 'placeholder'=>'monto'])!!}
                    </div>
                </div>
                <div class="modal-footer">
                  <a value="Ver Notas" class="btn btn-prifsdfsdmary" data-toggle='modal' data-target="#Lofading"></a>
                  <a class="btn btn-success" id="btn-danger">Registrar Pago  <span class="glyphicon glyphicon-pushpin"></span></a>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> 
</div>
<!--siguiente div-->
@include('load')
@endsection
@section('scripts')
{!! Html::script('/js/funcionesReportes.js')!!}
{!! Html::script('/js/prettify.js')!!}
{!! Html::script('/js/mockjax.js')!!}
{!! Html::script('/js/autocomplete.js')!!}
{!! Html::script('/js/matriculafCETPRO.js')!!}
{!! Html::script('/js/alertify/lib/alertify.js')!!}
{!!Html::style('/js/alertify/themes/alertify.core.css')!!}
{!!Html::style('/js/alertify/themes/alertify.default.css')!!}
@endsection