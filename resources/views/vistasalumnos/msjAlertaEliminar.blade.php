<div class="modal fade" id="msjalertaeliminar">
  <div class="modal-dialog">
    <div class="alert alert-dismissible alert-danger">
    <div class="modal-content">
      <div class="modal-body">
          <div class="modal-header">
          <h4 class="modal-title"><CENTER><B>DESEA ELIMINAR EL REGISTRO</B></CENTER> </h4>
      </div>
            <CENTER>
              {!! Form::Open(['route' => ['alu.alumnos.destroy'], 'method' => 'DELETE', 'id'=>'form-delete'])!!}
                 {!! Form::hidden('id', '', ['id' => 'id']) !!}
              <input type="submit" value="Aceptar" data-toggle='modal' data-target="#Loading"class="btn btn-info">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </CENTER>
              {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div> 
</div>