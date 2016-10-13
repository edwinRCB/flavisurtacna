var carrera;
var modulo;
$(document).ready(function(){
  $('.btn-info').click(function(e){
      e.preventDefault();
      var url = ('/NotasReportesCETPRO');
      var data = $('#alumno_data').val();
      $.get(url, { idalumno: data, idcarrera: carrera, idmodulo: modulo}, function(result){
            var table = document.getElementById("cursos");
            if (table.rows.length > 1) {
                for (var i = table.rows.length - 1; i >= 0; i--) {
                  if(i>0)
                  {
                     table.deleteRow (i); 
                  }               
                 };
            }
        if(result=="")
          {alertify.log("No contiene registros en la Maquina Seleccionada.");}
        $.each(result, function (index, value) {
          $('#cursos tr:last').after("<tr data-id="+ value.id +"d><td>"+ value.id +"</td><td>"+ value.cursos.nombre +"</td><td>"+ value.grupos.ciclos.ciclo +"</td><td>"+ value.promedio +"</td><td>"+value.grupos.inicio+"/"+value.grupos.fin+"</td></tr>");
        });
      }).fail(function()
      {
        alert('error');
      })
  })
    $('#carrera').change(function(e){
      e.preventDefault();
      carrera = $('#carrera').val();
  })
  $('#modulo_id').change(function(e){
      e.preventDefault();
      modulo = $('#modulo_id').val();
  })
});