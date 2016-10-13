  $(document).ready(function(){
    $('.btn-primary').click(function(e){
      e.preventDefault();
      var row = $(this).parents('tr');
      var curso_celda = $(this).parents('td');
      var id = row.data('id');
      var curso = curso_celda.data('id');
      alert(id);
    })
  });