// JQUERY Colapsar menu al clikear boton sidebarCollapse
$(document).ready(function () {
  $('#sidebarCollapse').on('click', function () {
    $('#sidebar').toggleClass('active');
    $(this).toggleClass('active');
  });
});

//FUNCION FECHA
function fecha(){
  const hoy = new Date();
	let fecha = hoy.getFullYear()+'-'+(hoy.getMonth()+1)+'-'+hoy.getDate();
  return fecha;
}
function appendFecha(elementID){
	document.getElementById(elementID).innerHTML += fecha();
}
