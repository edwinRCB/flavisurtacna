<div class="modal fade" id="agregarCurso">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">Agregar CursoII</h4>
      </div>
      <div class="modal-body">
        <div class="form-horizontal"> 
          {!! Form::Open(['route' => 'planestudio.cursosemestre.store', 'method' => 'POST', 'id'=>'curso-semestre'])!!}
            <div class="form-group">
              {!! Form::label('ciclos', 'Ciclo:',['class'=>'col-lg-2 control-label']) !!}
              <div class="col-lg-10">
                <select name="semestre_id" class="form-control">
                  @foreach($carreras->semestres as $semestreselect)
                    <option value='{{$semestreselect->id}}'>{{$semestreselect->ciclo}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group">
              {!! Form::label('cursos', 'Curso:',['class'=>'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                <select name="curso_id" class="form-control">
                  @foreach($cursos4 as $curso2)
                    <option value='{{$curso2->id}}'>{{$curso2->nombre}}</option>
                  @endforeach
                </select>
                
                </div>
            </div>
            
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">cerrar</button>
              <a href="#" id="btn-agregarCurso" class="btn btn-primary" type="button" data-dismiss="modal" >Guardar <span class="glyphicon glyphicon-floppy-saved"></span></a>
              
            </div>
                {!! Form::close() !!}
               
        </div>
      </div>
    </div>
  </div> 
</div> 
