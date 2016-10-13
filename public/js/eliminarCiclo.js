$(document).ready(function(){
    $('.btn-danger').click(function(e){
      e.preventDefault();
      var row = $(this).parents('div');
      var id = row.data('id');
      var form = $('#form-delete');
      var url = form.attr('action').replace(':VAR_ID', id);
      var data = form.serialize();
      $.post(url, data, function(result){
          alert(result);
      }).fail(function()
        {
          alert('El registro no fue eliminado');
        }
      );
    })
  });
$(document).ready(function(){
    $('.btn-deletecurso').click(function(e){
      e.preventDefault();
      var row = $(this).parents('tr');
      var div = $(this).parents('td');
      var id = row.data('id');
      var id_div = div.data('id');
      var clave = id+","+id_div;
      var form = $('#form-Eliminar');
      var url = form.attr('action').replace(':VAR_ID', clave);
      var data = form.serialize();
      
      $.post(url, data, function(result){
          alert(result);
          row.fadeOut();
      }).fail(function()
        {
          alert('El registro no fue eliminado');
          row.show();
        }
      );
    })
  });