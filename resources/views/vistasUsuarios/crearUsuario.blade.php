<div class="modal fade" id="crearUsuario">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">Nuevo Usuario</h4>
      </div>
      <div class="modal-body">
        <div class="form-horizontal"> 
          {!! Form::Open(['route' => 'admin.usuarios.store', 'method' => 'POST'])!!}
            <div class="form-group">
              {!! Form::label('nombre:', 'Nombres:',['class'=>'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                  {!! Form::text('name', null, ['class'=>'form-control', 'placeholder'=>'nombres'])!!}
                </div>
            </div>
            <div class="form-group">
              {!! Form::label('email:', 'email:',['class'=>'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                  {!! Form::text('email', null, ['class'=>'form-control', 'placeholder'=>'ejemplo@email.com'])!!}
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
                    {!! Form::label('descripcion:', 'Tipo:',['class'=>'col-lg-2 control-label']) !!}
                      <div class="col-lg-10">
                        <select class="form-control" name='tipo'>
                          <option >Seleccione</option>
                          <option value="administrador">administrador</option>
                          <option value="docente">doncente</option>
                          <option value="secretaria">secretaria</option>
                        </select>
                      </div>
                  </div>
            <div class="form-group">
              {!! Form::label('passw:', 'Contraseña:',['class'=>'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                  {!! Form::password('password', ['class'=>'form-control', 'placeholder'=>'***********'])!!}
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