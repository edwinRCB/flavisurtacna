<div class="modal fade" id="registrarNotasCETPRO">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">Operación y Mantenimiento de maquinaria pesada</h4>
      </div>
      <div class="modal-body">
        <div class="form-horizontal"> 
          {!! Form::Open(['route' => ['usuarios.calificacionescetpro.update'], 'method' => 'PUT', 'id'=>'form-update'])!!}
            <div class="form-group">
              {!! Form::label('alumno:', 'Alumno:',['class'=>'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                {!! Form::text('nombre_alumno', null, ['class'=>'form-control', 'id'=>'nombre_alumno', 'disabled'=>''])!!}
              </div>
            </div>
            <!-- -->
            {!! Form::hidden('detallematricula_id', '', ['id' => 'detalle_data']) !!}
            <div class="form-group">
              {!! Form::label('promedio:', 'promedio:',['class'=>'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                {!! Form::text('promedio', null, ['class'=>'form-control', 'id'=>'promedio' ,'placeholder'=>'0'])!!}
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">cerrar</button>
              <a href="#" id="btn-updateRegistro" data-dismiss="modal" class="btn btn-primary" type="button" >Guardar <span class="glyphicon glyphicon-floppy-saved"></span></a>
              
            </div>
            {!! Form::close() !!}
               
        </div>
      </div>
    </div>
  </div> 
</div> 