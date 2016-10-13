$(document).ready(function(){
    $('.asistencia').click(function(e){
        var check;
        if($(this).is(':checked'))
        {
            check = 1;
        }
        else
        {
            check = 0;
        }
        var row = $(this).parents('tr');
        var id = row.data('id');
        var url = ('/asistenciaStore');
        $.get(url, {detalle_id: id, checked: check}, function(result){
            alertify.success(result);
        })
    });
});