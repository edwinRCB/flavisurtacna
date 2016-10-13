<div class="modal fade" id="crearCiclo">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">Nuevo Ciclo</h4>
      </div>
      <div class="modal-body">
        <div class="form-horizontal"> 
          {!! Form::Open(['route' => 'planestudio.semestre.store', 'class'=>'registrar_ciclo', 'method' => 'POST', 'id'=>'form-guardar'])!!}
            <div class="form-group">
              {!! Form::label('carreras123', 'Carrera:',['class'=>'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                  {!! Form::text('carrera', $carreras->nombre, ['class'=>'form-control','disabled'=>''])!!}
                  {!! Form::hidden('carrera_id', $carreras->id, array('id' => 'carrera_id')) !!}
                </div>
            </div>
            <div class="form-group">
              {!! Form::label(':', 'CICLO-MODULO:',['class'=>'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                  {!! Form::text('ciclo', null, ['class'=>'form-control', 'placeholder'=>'ciclo-modulo'])!!}
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">cerrar</button>
              <a href="#"  id="btn-guardarCiclo" class="btn btn-primary" data-dismiss="modal" type="button">Guardar <span class="glyphicon glyphicon-floppy-saved"></span></a> 
            </div>
                {!! Form::close() !!}
               
        </div>
      </div>
    </div>
  </div> 
</div>