$(document).ready(function() {
$('.acciones-entrada-eliminar').click(function(e) {
  e.preventDefault();
  var ok = confirm("seguro?");
  if (ok) { window.location = $(this).attr('href'); };
});
});
