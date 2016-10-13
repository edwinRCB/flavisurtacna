///select dependiente una ves que selecciona la carrera carga los ciclos asginados a esa carrera
$(document).ready(function(){
  $('#carrera').change(function(e){
      e.preventDefault();
      var url = ('/modulos');
      var data = $('#carrera').val();
      $.get(url, { idcarrera: data}, function(result){
        $('#modulo_id').empty('');
        $('#modulo_id').append("<option value='' disabled selected style='display:none;'>Seleccione Unidad </option>");
        $.each(result, function (index, value) {
          $('#modulo_id').append("<option value='" + index + "'>" + value + "</option>");
        });
      }).fail(function()
      {
        alert('error');
      })
  })
});
//select selecciona un modulo o ciclo para que cargue los grupos creados con ese ciclo
$(document).ready(function(){
  $('#modulo_id').change(function(e){
      e.preventDefault();
      var url = ('/gruposcetpro');
      var data = $('#modulo_id').val();
      $.get(url, { idmodulo: data}, function(result){
        console.log(result);
        $('#grupo_id').empty('');
        $('#grupo_id').append("<option value='' disabled selected style='display:none;'>Seleccione grupo </option>");
        $.each(result, function (index, value) {
          $('#grupo_id').append("<option value='" + value.id + "'>" + value.nombre_unidad+" | "+ value.Horario +" | inicio:"+ value.inicio + "</option>");
        });
      }).fail(function()
      {
        alert('error');
      })
  })
});
//select seleccionamos grupo y se cargaran los cursos
$(document).ready(function(){
  $('#grupo_id').change(function(e){
      e.preventDefault();
      var url = ('/grupocursos');
      var data = $('#grupo_id').val();
      $.get(url, { idgrupo: data}, function(result){
        console.log(result);
            var table = document.getElementById("cursos");
            if (table.rows.length > 1) {
                for (var i = table.rows.length - 1; i >= 0; i--) {
                  if(i>0)
                  {
                     table.deleteRow (i); 
                  }               
                 };
            }
        $.each(result, function (index, value) {
          $('#cursos tr:last').after("<tr data-id="+ value.id +"d><td>"+ value.id +"</td><td>"+ value.nombre +"</td><td>"+ value.creditos +"</td><td><a href='#' id='btn-delete'><span class= 'glyphicon glyphicon-remove red'></span></a></td></tr>");
        });
      }).fail(function()
      {
        alert('error');
      })
  })
});
////////////////metodo para verificar si el alumno ya tiene una matricula en CETPRO Y SI ES LA MISMA CARRERA///
$(document).ready(function(){
  $('#verificar').click(function(e){
      e.preventDefault();
      var url = ('/verificarAlumno');
      var data = $('#alumno_data').val();
      $.get(url, { idalumno: data}, function(result){
        if (result == 0) {
           alertify.success("NO REGISTRA NINGUNA MATRICULA");
        }else
        {
          alertify.set({ delay: 15000 });
          $.each(result, function (index, value)
          {
            alertify.error("Matriculado en: "+value.carreras.nombre);
          })
        }

        //alertify.success(result);
      }).fail(function()
      {
        alert('error');
      })
  })
});

