  var grow;
  var p1;
  var p2;
  var p3;
  var curso;
  var galumno;
 $(document).ready(function(){
    $('.btn-updateNotas').click(function(e){
      e.preventDefault();
      var row = $(this).parents('tr');
      var alumno_celda = $(this).parents('td');
      var id = row.data('id');
      var alumno = alumno_celda.data('id');
      galumno = alumno;
      $('#detalle_data').val(id);
      $('#nombre_alumno').val(alumno);
    })
      $(".desmarcadoInstituto").click(function(){
        var $tr = $(this).closest('tr');
        grow = $tr.index();
          curso = $(this).find('td').eq(2).html()
            p1 = $(this).find('td').eq(3).html()
            p2 = $(this).find('td').eq(4).html()
            p3 = $(this).find('td').eq(5).html()
          $('#pr_unidad').val($(this).find('td').eq(3).html())
          $('#sg_unidad').val($(this).find('td').eq(4).html())
          $('#tr_unidad').val($(this).find('td').eq(5).html())
    });
      // aztualiza notas de listaalumnosnotas.blade.php y actualiza la pagina
    $('#btn-updateRegistro').click(function(e){
      e.preventDefault();
      var form = $('#form-update');
      var url = form.attr('action');
      var data = form.serialize();
      console.log(url);
      $.post(url, data, function(result){
        alertify.set({ delay: 10000 });
        alertify.success(result);
       // document.getElementById("mytable").rows[row+1].cells[3].innerHTML = $('#promedio').val();
        var pr = (parseInt($('#pr_unidad').val()) + parseInt($('#sg_unidad').val()) + parseInt($('#tr_unidad').val()))/3;
        pr = Math.round(pr);
        document.getElementById("mytable").rows[grow+1].cells[3].innerHTML = $('#pr_unidad').val();
        document.getElementById("mytable").rows[grow+1].cells[4].innerHTML = $('#sg_unidad').val();
        document.getElementById("mytable").rows[grow+1].cells[5].innerHTML = $('#tr_unidad').val();
        document.getElementById("mytable").rows[grow+1].cells[6].innerHTML = pr;
      }).fail(function(){
        alertify.set({ delay: 15000 });
        alertify.error('Error: No se pudo actualizar la nota de: '+ galumno); 
      })
    })
    $(function(){
        theme : 'blue',
         $("#mytable").tablesorter();
    });
});
//////////////////////NUEVA FUNCION REGISTRAR NOTAS
 $(document).ready(function(){
    $(".n1").blur(function(){
        var id = $(this).attr("id") ;
        var value = $(this).text();
        var row = $(this).parents('tr');
        var id = row.data('id');
        var url = ('/GuardarNotas');
        $.get(url ,{ detallematricula_id: id, nota:value, nronota:'n1'}, function(data){
          if(curso != 'Operación de Maquinaria Pesada')
          {
            if(data!= "")
            {
              p1 = value;
              var prfinal = Math.round((parseInt(p1)+parseInt(p2)+parseInt(p3))/3);
              document.getElementById("mytable").rows[grow+1].cells[6].innerHTML = prfinal;
              alertify.success(data);
            } 
          } else
          {
            if(data!="")
            {
              p1 = value;
              var prfinal = Math.round((parseInt(p1)+parseInt(p2))/2);
              document.getElementById("mytable").rows[grow+1].cells[6].innerHTML = prfinal;
              alertify.success(data);
            }
          }
        }).fail(function()
        {
          alertify.error("Error al intentar registrar notas."); 
        }
      );
    });
        $(".n2").blur(function(){
        var id = $(this).attr("id") ;
        var value = $(this).text();
        var row = $(this).parents('tr');
        var id = row.data('id');
        var url = ('/GuardarNotas');
        $.get(url ,{ detallematricula_id: id, nota:value, nronota:'n2'}, function(data){
          if(curso != 'Operación de Maquinaria Pesada')
          {
            if(data!= "")
            {
              p2 = value;
              var prfinal = Math.round((parseInt(p1)+parseInt(p2)+parseInt(p3))/3);
              document.getElementById("mytable").rows[grow+1].cells[6].innerHTML = prfinal;
              alertify.success(data);
            } 
          }else
          {
            if(data!= "")
            {
              p2 = value;
              var prfinal = Math.round((parseInt(p1)+parseInt(p2))/2);
              document.getElementById("mytable").rows[grow+1].cells[6].innerHTML = prfinal;
              alertify.success(data);
            } 
          }
        }).fail(function()
        {
          alertify.error("Error al intentar registrar notas."); 
        }
      );
    });
    $(".n3").blur(function(){
        var id = $(this).attr("id") ;
        var value = $(this).text();
        var row = $(this).parents('tr');
        var id = row.data('id');
        var url = ('/GuardarNotas');
        $.get(url ,{ detallematricula_id: id, nota:value, nronota:'n3'}, function(data){
          if(data!= "")
          {
            p3 = value;
            var prfinal = Math.round((parseInt(p1)+parseInt(p2)+parseInt(p3))/3);
            document.getElementById("mytable").rows[grow+1].cells[6].innerHTML = prfinal;
            alertify.success(data);
          } 
        }).fail(function()
        {
          alertify.error("Error al intentar registrar notas."); 
        }
      );
    });
   /* $(".enter").keypress(function(e)
    {
      if(e.which==13)
      {
        //$("td[contenteditable=true]").blur()
        $('.enter').setAttribute("contenteditable", false);
      }
    })*/

});
