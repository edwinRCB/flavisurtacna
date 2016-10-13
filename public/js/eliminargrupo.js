
$(document).ready(function(){
    $('.btn-info').click(function(e){
      e.preventDefault();
      var form = $('#form-deletem');
      var url = form.attr('action');
      var data = form.serialize();
      console.log(url);
      $.post(url, data, function(result){
          alert('El grupo fue cerrado correctamente');
          location.reload();
      }).fail(function()
        {
          alert('se produjo un error intentelo denuevo!');
          location.reload();
        }
      );
    })
  });
////////////////////////////////////////////
$(document).ready(function(){
    $('.btn-dangerdd').click(function(e){
      e.preventDefault();
      var row = $(this).parents('tr');
      var id = row.data('id');
      var form = $('#form-delete');
      var url = form.attr('action').replace(':VAR_ID', id);
      console.log(url);
      var data = form.serialize();
      $.post(url, data, function(result){
          alert(result);
          location.reload();
      }).fail(function()
        {
          alert('El grupo no fue cerrado');
        }
      );
    })
  });
//////////////////////////////////////////////////
  $(document).ready(function(){
    $('.btn-warning').click(function(e){
      e.preventDefault();
      var row = $(this).parents('tr');
      var id = row.data('id');
      $('#grupo_idata').val(id);
      console.log($('#grupo_idata').val());
      })
  });
  $(document).ready(function(){
    $('.btn-danger').click(function(e){
      e.preventDefault();
      var row = $(this).parents('tr');
      var id = row.data('id');
      $('#id').val(id);
      console.log($('#id').val());
      })
  });