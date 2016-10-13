///select dependiente una ves que selecciona la carrera carga los ciclos asginados a esa carrera
$(document).ready(function(){
  $('#carrera').change(function(e){
      e.preventDefault();
      var url = ('/ciclos');
      var data = $('#carrera').val();
      $.get(url, { idcarrera: data}, function(result){
        $('#ciclo_id').empty('');
        $('#ciclo_id').append("<option value='' disabled selected style='display:none;'>Seleccione Unidad </option>");
        $.each(result, function (index, value) {
          $('#ciclo_id').append("<option value='" + index + "'>" + value + "</option>");
        });
      }).fail(function()
      {
        alert('error');
      })
  })
});
//select selecciona un modulo o ciclo para que cargue los grupos creados con ese ciclo
$(document).ready(function(){
  $('#ciclo_id').change(function(e){
      e.preventDefault();
      var url = ('/grupos');
      var data = $('#ciclo_id').val();
      $.get(url, { idciclo: data}, function(result){
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
        $.each(result, function (index, value) {
          $("#ttbody").remove(); 
          $('#cursos tr:last').after("<tr data-id="+ value.id +"d><td>"+ value.id +"</td><td>"+ value.nombre +"</td><td>"+ value.creditos +"</td><td><a href='#' id='btn-delete'><span class= 'glyphicon glyphicon-remove red'></span></a></td></tr>");
        });
      }).fail(function()
      {
        alert('error');
      })
  })
});