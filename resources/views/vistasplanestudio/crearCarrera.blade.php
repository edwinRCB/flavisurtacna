<div class="modal fade" id="crearAlumno">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">Nueva Carrera</h4>
      </div>
      <div class="modal-body">
        <div class="form-horizontal"> 
          {!! Form::Open(['route' => 'planestudio.carrera.store', 'method' => 'POST'])!!}
            <div class="form-group">
              {!! Form::label('carrera:', 'Carrera:',['class'=>'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                  {!! Form::text('nombre', null, ['class'=>'form-control', 'placeholder'=>'carrera'])!!}
                </div>
            </div>
            <div class="form-group">
              {!! Form::label('descripcion:', 'Descripción:',['class'=>'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                  {!! Form::text('descripcion', null, ['class'=>'form-control', 'placeholder'=>'descripción'])!!}
                </div>
            </div>
            <div class="form-group">
              {!! Form::label('Tipo', 'Tipo:',['class'=>'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                  <select class="form-control" name='tipo'>
                    <option >Seleccione</option>
                    <option value="INSTITUTO">INSTITUTO</option>
                    <option value="CETPRO">CETPRO</option>
                  </select>
                </div>
            </div>
            <div class="form-group">
              {!! Form::label('Duracion', 'Duración:',['class'=>'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                  {!! Form::text('duracion', null, ['class'=>'form-control', 'placeholder'=>'duración'])!!}
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