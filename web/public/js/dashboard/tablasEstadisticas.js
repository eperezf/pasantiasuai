const tabla_detalleAlumnos = (JSONdatosAlumnos, idTabla, idBodyModal) => {
	//Tabla HTML a desplegar
	let tablaHTMLAlumnos =
		'<table id="' +
		idTabla +
		'" class="table table-striped shadow-lg" data-show-export="true" data-pagination="true" data-click-to-select="true" data-toolbar="#toolbar" data-show-toggle="true" data-show-columns="true" data-sortable="true" data-toggle="table" data-search="true" data-live-search="true">' +
		"<thead>" +
		"<tr>" +
		'<th scope="col">id</th>' +
		'<th scope="col">#</th>' +
		'<th scope="col">Nombre</th>' +
		'<th scope="col">Apellido</th>' +
		'<th scope="col">Email</th>' +
		"</tr>" +
		"</thead>" +
		"<tbody>";
	const datosAlumnos = JSONdatosAlumnos;
	for (let i = 0; i < datosAlumnos.length; i++) {
		let datosAlumno = datosAlumnos[i];
		tablaHTMLAlumnos +=
			"<tr>" +
			"<td></td>" +
			'<th scope="row">' +
			(i + 1) +
			"</th>" +
			"<td>" +
			datosAlumno["nombres"] +
			"</td>" +
			"<td>" +
			datosAlumno["apellidoPaterno"] +
			"</td>" +
			"<td>" +
			datosAlumno["email"] +
			"</td>" +
			"</tr>";
	}
	tablaHTMLAlumnos += "</tbody>" + "</table>";
	//Toolbar HTML para la tabla
	const toolbarAlumnos =
		'<div id="' +
		idTabla +
		'toolbar" class="select">' +
		'<select class="form-control">' +
		'<option value="all">Exportar todo</option>' +
		'<option value="selected">Exportar seleccionado</option>' +
		"</select>" +
		"</div>";

	//ID del BODY del modal
	let modalBodyDetalleAlumnos = document.getElementById(idBodyModal);
	//Primero toolbar, luego tabla
	modalBodyDetalleAlumnos.innerHTML += toolbarAlumnos;
	modalBodyDetalleAlumnos.innerHTML += tablaHTMLAlumnos;
	//JQuery forma de descarga de tabla y cuales columnas
	const $tablaAlumnos = $("#" + idTabla);
	$(function() {
		$("#" + idTabla + "toolbar")
			.find("select")
			.change(function() {
				$tablaAlumnos.bootstrapTable("destroy").bootstrapTable({
					exportDataType: $(this).val(),
					exportTypes: ["csv", "excel", "pdf"],
					columns: [
						{
							field: "state",
							checkbox: true,
							visible: $(this).val() === "selected"
						},
						{
							field: "#",
							title: "#"
						},
						{
							field: "Nombre",
							title: "Nombre"
						},
						{
							field: "Apellido",
							title: "Apellido"
						},
						{
							field: "Email",
							title: "Email"
						}
					]
				});
			})
			.trigger("change");
	});
};
