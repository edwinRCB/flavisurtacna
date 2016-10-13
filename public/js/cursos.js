
$(document).ready(function(){
  $('#semestres').change(function(e){
      e.preventDefault();
      var url = ('/getCursos');
      var data = $('#semestres').val();
      $.get(url, { idsemestre: data}, function(result){
        console.log(result);
        $('#curso_id').empty('');
        $('#curso_id').append("<option value='' disabled selected style='display:none;'>Seleccione Curso </option>");
        $.each(result, function (index, value) {
        $('#curso_id').append("<option value='" + value.id + "'>" + value.nombre + "</option>");
        });
      }).fail(function()
      {
        alert('error');
      })
  })
});