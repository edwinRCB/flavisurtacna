  // actualiza notas de listaalumnosnotas.blade.php y actualiza la pagina
  var row;
  var galumno;
    $(document).ready(function(){
    $('#btn-updateRegistro').click(function(e){
      e.preventDefault();
      var form = $('#form-update');
      var url = form.attr('action');
      var data = form.serialize();
      $.post(url, data, function(result){
        alertify.set({ delay: 10000 });
        alertify.success(result);
        document.getElementById("mytable").rows[row+1].cells[3].innerHTML = $('#promedio').val();
      }).fail(function(){
        alertify.set({ delay: 15000 });
        alertify.error('Error: No se pudo actualizar la nota de: '+ galumno); 
      })
    })

  });
 ///////////////////CETPRO///////////
  $(document).ready(function(){
    $('.btn-CETPRO').click(function(e){
      e.preventDefault();
      var row = $(this).parents('tr');
      var alumno_celda = $(this).parents('td');
      var id = row.data('id');
      var alumno = alumno_celda.data('id');
      galumno = alumno;
      $('#detalle_data').val(id);
      $('#nombre_alumno').val(alumno);

    })
  });
  $(".desmarcado").click(function(){
    var $tr = $(this).closest('tr');
    row = $tr.index();
   $('#promedio').val($(this).find('td').eq(3).html())

  });
  $(document).ready(function(){
    $(function(){
        theme : 'blue',
         $("#mytable").tablesorter();
    });
  });
  ////Nuevo metodo de registro de notas

   $(document).ready(function(){
    $(".promedio").blur(function(){
        var value = $(this).text();
        var row = $(this).parents('tr');
        var id = row.data('id');
        var url = ('/GuardarNotasCETPRO');
        $.get(url ,{ detallematricula_id: id, nota:value, nronota:'promedio'}, function(data){
            if(data!= "")
            {
              alertify.success(data);
            } 
        }).fail(function()
        {
          alertify.error("Error al intentar registrar notas."); 
        }
      );
    });
});
   //////////////////////////////
$('td').on('focus', function() {
  var cell = this;
  // select all text in contenteditable
  // see http://stackoverflow.com/a/6150060/145346
  var range, selection;
  if (document.body.createTextRange) {
    range = document.body.createTextRange();
    range.moveToElementText(cell);
    range.select();
  } else if (window.getSelection) {
    selection = window.getSelection();
    range = document.createRange();
    range.selectNodeContents(cell);
    selection.removeAllRanges();
    selection.addRange(range);
  }
});
   /////////////////////////////
$(document).ready(function(){
    $(".nota1").blur(function(){
        var $tr = $(this).closest('tr');
        grow = $tr.index();
        var value = $(this).text();
        var row = $(this).parents('tr');
        var id = row.data('id');
        var url = ('/GuardarNotasCETPRO');
        $.get(url ,{ detallematricula_id: id, nota:value, nronota:'nota1'}, function(data){
            if(data!= "")
            {
              document.getElementById("mytable").rows[grow+1].cells[8].innerHTML = data.promedio;
              alertify.success(data.msj);
            } 
        }).fail(function()
        {
          alertify.error("Error al intentar registrar notas."); 
        }
      );
    });
});
$(document).ready(function(){
    $(".nota2").blur(function(){
       var $tr = $(this).closest('tr');
        grow = $tr.index();
        var value = $(this).text();
        var row = $(this).parents('tr');
        var id = row.data('id');
        var url = ('/GuardarNotasCETPRO');
        $.get(url ,{ detallematricula_id: id, nota:value, nronota:'nota2'}, function(data){
            if(data!= "")
            {
              document.getElementById("mytable").rows[grow+1].cells[8].innerHTML = data.promedio;
              alertify.success(data.msj);
            } 
        }).fail(function()
        {
          alertify.error("Error al intentar registrar notas."); 
        }
      );
    });
});
$(document).ready(function(){
    $(".nota3").blur(function(){
        var $tr = $(this).closest('tr');
        grow = $tr.index();
        var value = $(this).text();
        var row = $(this).parents('tr');
        var id = row.data('id');
        var url = ('/GuardarNotasCETPRO');
        $.get(url ,{ detallematricula_id: id, nota:value, nronota:'nota3'}, function(data){
            if(data!= "")
            {
              document.getElementById("mytable").rows[grow+1].cells[8].innerHTML = data.promedio;
              alertify.success(data.msj);
            } 
        }).fail(function()
        {
          alertify.error("Error al intentar registrar notas."); 
        }
      );
    });
});
$(document).ready(function(){
    $(".nota4").blur(function(){
        var $tr = $(this).closest('tr');
        grow = $tr.index();
        var value = $(this).text();
        var row = $(this).parents('tr');
        var id = row.data('id');
        var url = ('/GuardarNotasCETPRO');
        $.get(url ,{ detallematricula_id: id, nota:value, nronota:'nota4'}, function(data){
            if(data!= "")
            {
              document.getElementById("mytable").rows[grow+1].cells[8].innerHTML = data.promedio;
              alertify.success(data.msj);
            } 
        }).fail(function()
        {
          alertify.error("Error al intentar registrar notas."); 
        }
      );
    });
});
$(document).ready(function(){
    $(".nota5").blur(function(){
        var $tr = $(this).closest('tr');
        grow = $tr.index();
        var value = $(this).text();
        var row = $(this).parents('tr');
        var id = row.data('id');
        var url = ('/GuardarNotasCETPRO');
        $.get(url ,{ detallematricula_id: id, nota:value, nronota:'nota5'}, function(data){
            if(data!= "")
            {
              document.getElementById("mytable").rows[grow+1].cells[8].innerHTML = data.promedio;
              alertify.success(data.msj);
            } 
        }).fail(function()
        {
          alertify.error("Error al intentar registrar notas."); 
        }
      );
    });
});
$(document).ready(function(){
    $(".nota6").blur(function(){
        var $tr = $(this).closest('tr');
        grow = $tr.index();
        var value = $(this).text();
        var row = $(this).parents('tr');
        var id = row.data('id');
        var url = ('/GuardarNotasCETPRO');
        $.get(url ,{ detallematricula_id: id, nota:value, nronota:'nota6'}, function(data){
            if(data!= "")
            {
              document.getElementById("mytable").rows[grow+1].cells[8].innerHTML = data.promedio;
              alertify.success(data.msj);
            } 
        }).fail(function()
        {
          alertify.error("Error al intentar registrar notas."); 
        }
      );
    });
});