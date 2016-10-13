
$(function() {
    $( "#auto" ).autocomplete({
      source: '/listalumnos',
      display: 'value',
      minLength: 2,
      select: function(event, ui) {
      $('#alumno_data').val(ui.item.id);
      console.log($('#alumno_data').val());
    }
    });
  });
