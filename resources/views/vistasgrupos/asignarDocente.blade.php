<div class="modal fade" id="asignarDocente">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">Asignar Docente a Curso</h4>
      </div>
      <div class="modal-body">
        <div class="form-horizontal"> 
          {!! Form::Open(['route' => ['generalgrupo.detallegrupo.update'], 'method' => 'PUT', 'id'=>'form-updadetallegrupo'])!!}
            <div class="form-group">
              {!! Form::label('Cursos', 'Curso:',['class'=>'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                {!! Form::text('nombre_curso', null, ['class'=>'form-control', 'id'=>'nombre_curso', 'disabled'=>''])!!}
              </div>
            </div>
            <!-- -->
            {!! Form::hidden('detallegrupo_id', '', ['id' => 'detalle_data']) !!}
            <div class="form-group">
              {!! Form::label('Docentes', 'Docentes:',['class'=>'col-lg-2 control-label']) !!}
              <div class="col-lg-10">
                {!! Form::select('users[]', $users, 'Seleccione', ['class' => 'form-control','name'=>'user_id', 'id'=>'docentes']) !!}
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">cerrar</button>
              <a href="#" id="btn-updatedetallegrupo" data-dismiss="modal" class="btn btn-primary" type="button" >Guardar <span class="glyphicon glyphicon-floppy-saved"></span></a>
              
            </div>
            {!! Form::close() !!}
               
        </div>
      </div>
    </div>
  </div> 
</div> 
