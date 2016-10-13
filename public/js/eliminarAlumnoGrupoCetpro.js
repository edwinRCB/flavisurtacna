var row;
$(document).ready(function(){
    $('.btn-info').click(function(e){
      e.preventDefault();
      var form = $('#form-delete');
      var url = form.attr('action');
      var data = form.serialize();
      row.fadeOut();
      $.post(url, data, function(result){
          $('#Loading').modal('hide');
          $('#msjEliminarAlumnoGrupo').modal('hide');
          alertify.success(result);
          location.reload();
          //$('#notification').miniNotification();

      }).fail(function()
        {
          alertify.error("Error al intentar eliminar registro."); 
                    $('#Loading').modal('hide');
          $('#msjEliminarAlumnoGrupo').modal('hide');
          //location.reload();
        }
      );
    })
  });
  $(document).ready(function(){
    $('.btn-danger').click(function(e){
      e.preventDefault();
      row = $(this).parents('tr');
      var id = row.data('id');
      $('#id').val(id);
      console.log($('#id').val());
      })
  });


