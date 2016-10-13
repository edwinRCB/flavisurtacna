$(document).ready(function(){
  $('#carrera_id').change(function(e){
      e.preventDefault();
      var url = ('/modulos');
      var data = $('#carrera_id').val();
      $.get(url, { idcarrera: data}, function(result){
        $('#modulo_id').empty('');
        $('#modulo_id').append("<option value='' disabled selected style='display:none;'>Seleccione Modulo </option>");
        $.each(result, function (index, value) {
          $('#modulo_id').append("<option value='" + index + "'>" + value + "</option>");
        });
      }).fail(function()
      {
        alert('error');
      })
  })
});