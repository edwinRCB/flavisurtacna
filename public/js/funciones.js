 // se guarda curso asignado al ciclo
  $(document).ready(function(){
    $('#btn-agregarCurso').click(function(e){
      e.preventDefault();
      var form = $('#curso-semestre');
      var url = form.attr('action');
      var data = form.serialize();
      $.post(url, data, function(result){
      alert(result);
      }).fail(function(){
        alert('Error: intentelo nuevamente');
      })
    })
  });
  // se guarda ciclo creado
    $(document).ready(function(){
    $('#btn-guardarCiclo').click(function(e){
      e.preventDefault();
      var form = $('#form-guardar');
      var url = form.attr('action');
      var data = form.serialize();
     $.post(url, data, function(result){
        alert('Registrado correctamente');
      }).fail(function(){
        alert('Error: intentelo nuevamente');
      })
    })
  });
$(document).ready(function(){
  $('#verDatos').click(function(e){
      e.preventDefault();
      var form = $('#nuevo-grupo');
      var url = form.attr('action');
      var data = form.serialize();
      alert(url);
    })
  });
///select dependiente de grupos una ves que selecciona la carrera carga los ciclos asginados a esa carrera
$(document).ready(function(){
  $('#carrera').change(function(e){
      e.preventDefault();
      var url = ('/ciclos');
      var data = $('#carrera').val();
      $.get(url, { idcarrera: data}, function(result){
        $('#ciclo_id').empty('');
        $('#ciclo_id').append("<option value='' disabled selected style='display:none;'>Seleccione Unidad </option>");
        $.each(result, function (index, value) {
          $('#ciclo_id').append("<option value='" + index + "'>" + value + "</option>");
        });
      }).fail(function()
      {
        alert('error');
      })
  })
});
//selecciona carrera para que carguen los grupos que se han creado previamente
$(document).ready(function(){
  $('#carreramatricula').change(function(e){
      e.preventDefault();
      var url = ('/grupos');
      var data = $('#carreramatricula').val();
      $.get(url, { idcarrera: data}, function(result){
        $('#grupo_id').empty('');
        $('#grupo_id').append("<option value='' disabled selected style='display:none;'>Seleccione grupo </option>");
        $.each(result, function (index, value) {
          $('#grupo_id').append("<option value='" + index + "'>" + value + "</option>");
        });
      }).fail(function()
      {
        alert('error');
      })
  })
});
//seleccionamos grupo y se cargaran los cursos
$(document).ready(function(){
  $('#grupo_id').change(function(e){
      e.preventDefault();
      var url = ('/grupocursos');
      var data = $('#grupo_id').val();
      $.get(url, { idgrupo: data}, function(result){
        console.log(result);
        $.each(result, function (index, value) {
          $("#ttbody").remove(); 
          $('#cursos tr:last').after("<tr data-id="+ value.id +"d><td>"+ value.id +"</td><td>"+ value.nombre +"</td><td>"+ value.creditos +"</td><td><a href='#' id='btn-delete'><span class= 'glyphicon glyphicon-remove red'></span></a></td></tr>");
        });
      }).fail(function()
      {
        alert('error');
      })
  })
});
//prueba del boton delete
$(document).ready(function(){
    $('#btn-delete').click(function(e){
      e.preventDefault();
      var row = $(this).parents('tr');
      var id = row.data('id');
      alert(id);
    })
  });

 // se actualiza la asignacion de curso hacia docente vista editar grupo
    $(document).ready(function(){
    $('#btn-updatedetallegrupo').click(function(e){
      e.preventDefault();
      var form = $('#form-updadetallegrupo');
      var url = form.attr('action');
      var data = form.serialize();
      $.post(url, data, function(result){
        alert(result);
      }).fail(function(){
        alert('Error: intentelo nuevamente');
      })
    })
  });
  $(document).ready(function(){
    $('.btn-update').click(function(e){
      e.preventDefault();
      var row = $(this).parents('tr');
      var curso_celda = $(this).parents('td');
      var id = row.data('id');
      var curso = curso_celda.data('id');
      $('#detalle_data').val(id);
      $('#nombre_curso').val(curso);
    })
  });
  ///////////////////////////////Notas Instituto//////////////////////////////////////////////////
  $(document).ready(function(){
    $('.btn-updateNotas').click(function(e){
      e.preventDefault();
      var row = $(this).parents('tr');
      var alumno_celda = $(this).parents('td');
      var id = row.data('id');
      var alumno = alumno_celda.data('id');
      $('#detalle_data').val(id);
      console.log($('#detalle_data').val());
      $('#nombre_alumno').val(alumno);
    })
      $(".desmarcadoInstituto").click(function(){
                // recorremos todos los valores...
      //$(".desmarcado td").each(function(index){
          //console.log($(this).find('td').eq(1).html());
          $('#pr_unidad').val($(this).find('td').eq(3).html())
          $('#sg_unidad').val($(this).find('td').eq(4).html())
          $('#tr_unidad').val($(this).find('td').eq(5).html())
          //$('#promedio').val($(this).find('td').eq(6).html())

      //});
    });
      // aztualiza notas de listaalumnosnotas.blade.php y actualiza la pagina
    $(document).ready(function(){
    $('#btn-updateRegistro').click(function(e){
      e.preventDefault();
      var form = $('#form-update');
      var url = form.attr('action');
      var data = form.serialize();
      $.post(url, data, function(result){
        alert(result);
        location.reload();
        //$("#content").load("listaAlumnosNotas.blade.php");
      }).fail(function(){
        alert('Error: intentelo nuevamente');
      })
    })

  });
  });
 ///////////////////CETPRO///////////
  $(document).ready(function(){
    $('.btn-updateNotasCETPRO').click(function(e){
      e.preventDefault();
      var row = $(this).parents('tr');
      var alumno_celda = $(this).parents('td');
      var id = row.data('id');
      var alumno = alumno_celda.data('id');
      $('#detalle_data').val(id);
      console.log($('#detalle_data').val());
      $('#nombre_alumno').val(alumno);
    })
      $(".desmarcado").click(function(){
          $('#promedio').val($(this).find('td').eq(3).html())

      //});
    });
  });
