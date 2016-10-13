<div class="modal fade" id="crearAlumno">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">Nuevo Curso</h4>
      </div>
      <div class="modal-body">
        <div class="form-horizontal"> 
          {!! Form::Open(['route' => 'planestudio.curso.store', 'method' => 'POST'])!!}
            <div class="form-group">
              {!! Form::label('Curso:', 'Curso:',['class'=>'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                  {!! Form::text('nombre', null, ['class'=>'form-control', 'placeholder'=>'curso'])!!}
                </div>
            </div>
            <div class="form-group">
              {!! Form::label('descripcion:', 'Tipo:',['class'=>'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                  <select class="form-control" name='descripcion'>
                    <option >Seleccione</option>
                    <option value="INSTITUTO">INSTITUTO</option>
                    <option value="CETPRO">CETPRO</option>
                  </select>
                </div>
            </div>
            <div class="form-group">
              {!! Form::label('Creditos', 'Creditos:',['class'=>'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                  {!! Form::text('creditos', null, ['class'=>'form-control', 'placeholder'=>'creditos'])!!}
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              <input type="submit" value="Guardar" class="btn btn-primary">
            </div>
                {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div> 
</div>