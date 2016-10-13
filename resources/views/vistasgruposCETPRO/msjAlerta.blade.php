<div class="modal fade" id="msjalerta">
  <div class="modal-dialog">
    <div class="alert alert-dismissible alert-danger">
    <div class="modal-content">
      <div class="modal-body">
          <div class="modal-header">
          <h4 class="modal-title"><CENTER><B>ACTIVAR GRUPO</B></CENTER> </h4>
      </div>
            <CENTER>
              {!! Form::Open(['route' => ['generalgrupo.accionesGrupoCetpro.edit'], 'method' => 'GET'])!!}
                 {!! Form::hidden('grupo_id', '', ['id' => 'grupo_idata']) !!}
              <input type="submit" value="Aceptar" class="btn btn-success" data-toggle='modal' data-target="#Loading">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
              </CENTER>
              {!! Form::close() !!}
              
        </div>
      </div>
    </div>
  </div> 
</div>