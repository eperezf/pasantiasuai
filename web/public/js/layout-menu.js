$(document).ready(function() {
  document.getElementsByTagName("html")[0].style.visibility = "visible";
});
// JQUERY Colapsar menu al clikear boton sidebarCollapse
$(document).ready(function () {
  $('#sidebarCollapse').on('click', function () {
    $('#sidebar').toggleClass('active');
    $(this).toggleClass('active');
  });
});
