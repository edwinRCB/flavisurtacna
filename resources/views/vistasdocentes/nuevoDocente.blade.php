<div class="modal fade" id="nuevoDocente">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">Nuevo Docente</h4>
      </div>
      <div class="modal-body">
        <div class="form-horizontal"> 
          {!! Form::Open(['route' => 'profesores.docente.store', 'method' => 'POST'])!!}
            <div class="form-group">
              {!! Form::label('dni:', 'DNI:',['class'=>'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                  {!! Form::text('dni', null, ['class'=>'form-control', 'placeholder'=>'dni'])!!}
                </div>
            </div>
            <div class="form-group">
              {!! Form::label('nombre:', 'Nombres:',['class'=>'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                  {!! Form::text('nombres', null, ['class'=>'form-control', 'placeholder'=>'nombres'])!!}
                </div>
            </div>
            <div class="form-group">
              {!! Form::label('Direccion', 'Dirección:',['class'=>'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                 {!! Form::text('direccion', null, ['class'=>'form-control', 'placeholder'=>'dirección'])!!}
                </div>
            </div>
            <div class ="form-group">
              {!! Form::label('estadocivil', 'Estado Civil:',['class'=>'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                 {!! Form::text('estadocivil', null, ['class'=>'form-control', 'placeholder'=>'estadocivil'])!!}
                </div>
            </div>
            <div class="form-group">
              {!! Form::label('Telefono', 'Teléfono:',['class'=>'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                  {!! Form::text('telefonos', null, ['class'=>'form-control', 'placeholder'=>'teléfonos'])!!}
                </div>
            </div>
            <div class="form-group">
              {!! Form::label('Email:', 'Email:',['class'=>'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                  {!! Form::email('email', null, ['class'=>'form-control', 'placeholder'=>'ejemplo@ejemplo.com'])!!}
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <input type="submit" value="Guardar" class="btn btn-primary">
            </div>
                {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div> 
</div>