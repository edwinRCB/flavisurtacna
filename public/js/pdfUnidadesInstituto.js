
var dataid;
$(document).ready(function(){
    $('.btn-warning').click(function(e){
      var row = $(this).parents('tr');
      var id = row.data('id');
      dataid = id;  
      alert(dataid);    
    });
    $('.btn-primary').click(function(e){
      alert(dataid);   
    });
});