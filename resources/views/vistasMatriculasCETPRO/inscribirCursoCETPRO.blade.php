@extends('app')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading" style="font-weight: bold"><center>Incribir a Modulo</center><BR>
          Carrera: {{$matricula->carreras->nombre}}<BR>
          Alumno: {{$matricula->alumnos->nombres}}
          </div>
          <div class="panel-body">
            <div class="form-horizontal"> 
              {!! Form::Open(['route' =>['cetpromatricula.inscripcioncetpro.store'], 'method' => 'POST'])!!}
                <div class="form-group">
                {!! Form::label(':','Modulo:',['class'=>'col-lg-2 control-label']) !!}
                  <div class="col-lg-8">
                    {!! Form::select('modulos[]', $modulos, 'Seleccione', ['class' => 'form-control','name'=>'modulo_id', 'id'=>'modulo_id']) !!}
                  </div>
                </div>
                  {!! Form::hidden('matricula_id', $matricula->id , ['id' => 'matricula_id']) !!}
                <div class="modal-footer">
                  <a class="btn btn-default" href="{{ url('/cetpromatricula/matriculacetpro')}}">Volver</a>
                  <input type="submit" value="Inscribir" class="btn btn-primary" data-toggle='modal' data-target="#Loading">
                </div>  
                @include('load')
            </div>
          </div>
      </div>
    </div>
  </div>
</div>
<!--siguiente div-->
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">Detalles</div>
          <div class="panel-body">
            <div class="form-horizontal"> 
              <div class="form-group">
                {!! Form::label(':','Grupos:',['class'=>'col-lg-2 control-label']) !!}
                <div class="col-lg-8">
                  <select  class="form-control" id="grupo_id" name="grupo_id">
                    <option value="">Es necesario seleccionar un Modulo</option>
                  </select>
                  </div>
              </div>
               <div id="panel-semestre" class="panel panel-primary">
                        <!-- Aquí listamos todos los cursos de un ciclo -->
                        <div class ="table-responsive">
                          <table id="cursos" class="table table-striped table-hover">
                            <thead>
                              <th>#</th>
                              <th>Curso</th>
                              <th>Creditos</th>
                              <th>Acciones</th>
                            </thead>
                            <tbody id="ttbody">
                            </tbody>
                          </table>
                        </div>
                  </div>
                  {!! Form::close() !!}
                <!--<a id="add" class="btn btn-default" href="#">Volver</a>-->
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
{!! Html::script('/js/matriculafCETPRO.js')!!}

@endsection