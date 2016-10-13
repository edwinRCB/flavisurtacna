
var f = new Date(); document.write(f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear());
$(function () {
  $('#inicio').datetimepicker({
  	defaultDate: f,
        format: 'YYYY/MM/DD'
  });
});
$(function () {
  $('#fin').datetimepicker({
        format: 'YYYY/MM/DD'
  });
});
$(function () {
  $('#fin2').datetimepicker({
        format: 'YYYY/MM/DD'
  });
});