//Registrar Notas Antiguas
    $(document).ready(function(){
    $('#btn-updateRegistro').click(function(e){
      e.preventDefault();    
      var form = $('#form-update');
      var url = form.attr('action');
      var data = form.serialize();
      $.post(url, data, function(result){
        if(result==1)
        {
          alertify.error('El alumno ya esta matriculado... '); 
        }
        else
        {
          $('#examenoral').val("");
          $('#trabajoinvestigacion').val("");
          $('#conductapuntual').val("");
          $('#presentacioncuaderno').val("");
          $('#examenpractico').val("");
          $('#examenfinal').val("");
          alertify.set({ delay: 10000 });
          alertify.success(result);
        }

      }).fail(function(){
        alertify.set({ delay: 15000 });
        alertify.error('Error: No se pudo actualizar la nota de: '); 
      })
    })

  });