<div class="modal fade" id="crearAlumno">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-body">
        <div class="form-horizontal"> 
          {!! Form::Open(['route' => 'alu.alumnos.store', 'method' => 'POST'])!!}
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
              {!! Form::label('Telefono', 'Teléfono:',['class'=>'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                  {!! Form::text('telefono', null, ['class'=>'form-control', 'placeholder'=>'teléfonos'])!!}
                </div>
            </div>
                <div class="form-group">
                  {!! Form::label(':', 'Fecha Nacimiento:',['class'=>'col-lg-2 control-label']) !!}
                    <div class="col-lg-8">
                          <div class='input-group date' id="inicio">
                              <input type='text' class="form-control" name="fec_nacimiento"/>
                              <span class="input-group-addon">
                                  <span class="glyphicon glyphicon-calendar"></span>
                              </span>
                          </div>
                    </div>
                </div>
                                <div class="form-group">
                  {!! Form::label(':', 'Sexo:',['class'=>'col-lg-2 control-label']) !!}
                <div class="col-xs-4">
                <select class="form-control" name="sexo">
                    <option >Seleccione</option>
                    <option value="H">Hombre</option>
                    <option value="M">Mujer</option>
                </select>
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
              <input type="submit" value="Guardar" class="btn btn-primary" data-toggle='modal' data-target="#Loading" >
            </div>
                {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div> 
</div>