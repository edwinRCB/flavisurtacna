
$(document).ready(function(){
    $('.btn-danger').click(function(e){
      e.preventDefault();
      var row = $(this).parents('tr');
      var id = row.data('id');
      var form = $('#form-delete');
      var url = form.attr('action').replace(':VAR_ID', id);
      var data = form.serialize();
      
      $.post(url, data, function(result){
        row.fadeOut();
          alert(result);
      }).fail(function()
        {
          alert('El registro no fue eliminado');
          row.show();
        }
      );
    })
  });