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

//FUNCION FECHA
function fecha(elementID){
	const hoy = new Date();
	let date = hoy.getFullYear()+'-'+(hoy.getMonth()+1)+'-'+hoy.getDate();
	document.getElementById(elementID).innerHTML += date;
}
