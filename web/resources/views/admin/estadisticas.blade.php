@extends('layout')

@section('title', 'Graficos')

@section('contenido')

	@if(session()->get('success'))
		<div class="alert alert-success">
			{{ session()->get('success') }}
		</div><br />
		@endif
		<div class="row">
			<div class="col-md-12">
				<h1 id="estadisticas" class="text-center">Estadísticas administrativas actualizadas a la fecha: </h1>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<div id="pasos"></div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div id="proyectosValidados"></div>
			</div>
			<div class="col-md-6">
				<div id="empresasEnConvenio"></div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div id="inscripcionesTerminadas"></div>
			</div>
			<div class="col-md-6">
				<div id="validacionSupervisor"></div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div id="proyectosInscritos"></div>
			</div>
			<div class="col-md-6">
				<div id=""></div>
			</div>
		</div>

<!-- Modal Empresas Validas -->
<div class="modal fade" id="Modal_EmpresasValidas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="bodyModal_EmpresasValidas">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Empresas NO Validas -->
<div class="modal fade" id="Modal_EmpresasNoValidas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="bodyModal_EmpresasNoValidas">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Paso 1 -->
<div class="modal fade" id="Modal_pasantiaPaso1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="bodyModal_pasantiaPaso1">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Paso 2 -->
<div class="modal fade" id="Modal_pasantiaPaso2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="bodyModal_pasantiaPaso2">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Paso 3 -->
<div class="modal fade" id="Modal_pasantiaPaso3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="bodyModal_pasantiaPaso3">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Paso 4 -->
<div class="modal fade" id="Modal_pasantiaPaso4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="bodyModal_pasantiaPaso4">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Proyectos Aprobados -->
<div class="modal fade" id="Modal_proyectosAprobados" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="bodyModal_proyectosAprobados">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Proyectos No Aprobados-->
<div class="modal fade" id="Modal_proyectosNoAprobados" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="bodyModal_proyectosNoAprobados">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Proyectos Inscritos-->
<div class="modal fade" id="Modal_proyectosInscritos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="bodyModal_proyectosInscritos">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Proyectos No Inscritos-->
<div class="modal fade" id="Modal_proyectosNoInscritos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="bodyModal_proyectosNoInscritos">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Inscripciones Terminadas-->
<div class="modal fade" id="Modal_inscripcionesTerminadas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="bodyModal_inscripcionesTerminadas">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Inscripciones No Terminadas--->
<div class="modal fade" id="Modal_inscripcionesNoTerminadas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="bodyModal_inscripcionesNoTerminadas">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Pasantias Validadas Supervisor--->
<div class="modal fade" id="Modal_PasantiasValidadasSupervisor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="bodyModal_PasantiasValidadasSupervisor">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Pasantias No Validadas Supervisor--->
<div class="modal fade" id="Modal_NoPasantiasValidadasSupervisor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="bodyModal_NoPasantiasValidadasSupervisor">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<script>
//Fecha en forma SIF (self invoking function)
(function() {
	const hoy = new Date().getFullYear() + '-' + (new Date().getMonth()+1) + '-' + new Date().getDate();
	document.getElementById('estadisticas').innerHTML += hoy;
})();

//Funcion para obtener todo el html a mostrar cuando se clickea el grafico de empresas
const tabla_empresasEnConvenio = (JSONdatosEmpresas, idTabla, idBodyModal) => {
	//Tabla HTML a desplegar
	let tablaHTMLEmpresas =
		'<table id="'+idTabla+'" class="table table-striped shadow-lg" data-show-export="true" data-pagination="true" data-click-to-select="true" data-toolbar="#toolbar" data-show-toggle="true" data-show-columns="true" data-sortable="true" data-toggle="table" data-search="true" data-live-search="true">' +
		'<thead>' +
		'<tr>' +
		'<th scope="col">id</th>'+
		'<th scope="col" data-field="#" data-sortable="true"><div class="th-inner">#</div></th>' +
		'<th scope="col" data-field="Nombre" data-sortable="true"><div class="th-inner">Nombre</div></th>' +
		'<th scope="col" data-field="URL" data-sortable="true"><div class="th-inner">URL</div></th>' +
		'</tr>' +
		'</thead>'+
		'<tbody>';
	const datosEmpresas = JSONdatosEmpresas;
	for (let i = 0; i < datosEmpresas.length; i++) {
		let datosEmpresa = datosEmpresas[i];
		tablaHTMLEmpresas += '<tr>' +
			'<td></td>' +
			'<th scope="row">'+ (i + 1) +'</th>' +
			'<td>'+ datosEmpresa['nombre'] +'</td>' +
			'<td>'+ datosEmpresa['urlWeb'] +'</td>' +
			'</tr>';
	}
	tablaHTMLEmpresas +='</tbody>' + '</table>';
	//Toolbar HTML para la tabla
	const toolbarEmpresas =
		'<div id="'+idTabla+'toolbar" class="select">'+
			'<select class="form-control">'+
				'<option value="all">Exportar todo</option>'+
				'<option value="selected">Exportar seleccionado</option>'+
			'</select>'+
		'</div>';

	//ID del BODY del modal
	let modalBodyEmpresas = document.getElementById(idBodyModal);
	//Primero toolbar, luego tabla
	modalBodyEmpresas.innerHTML += toolbarEmpresas;
	modalBodyEmpresas.innerHTML += tablaHTMLEmpresas;
	//JQuery forma de descarga de tabla y cuales columnas
	const $tablaEmpresas = $('#'+idTabla);
	$(function() {
		$('#'+idTabla+'toolbar').find('select').change(function () {
			$tablaEmpresas.bootstrapTable('destroy').bootstrapTable({
				exportDataType: $(this).val(),
				exportTypes: ['csv', 'excel', 'pdf'],
				columns: [
					{
						field: 'state',
						checkbox: true,
						visible: $(this).val() === 'selected'
					},  {
						field: '#',
						title: '#'
					}, {
						field: 'Nombre',
						title: 'Nombre'
					}, {
						field: 'URL',
						title: 'URL'
					}
				]
			})
		}).trigger('change');
	});
}
//Empresas validas
tabla_empresasEnConvenio(@json($estadisticasEmpresas['empresasValidadas']), 'g_empresasConvenio_Validas', 'bodyModal_EmpresasValidas');
//Empresas no validas
tabla_empresasEnConvenio(@json($estadisticasEmpresas['empresasNoValidadas']), 'g_empresasConvenio_Novalidas', 'bodyModal_EmpresasNoValidas');


const tabla_detalleAlumnos = (JSONdatosAlumnos, idTabla, idBodyModal) => {
	//Tabla HTML a desplegar
	let tablaHTMLAlumnos =
	'<table id="'+idTabla+'" class="table table-striped shadow-lg" data-show-export="true" data-pagination="true" data-click-to-select="true" data-toolbar="#toolbar" data-show-toggle="true" data-show-columns="true" data-sortable="true" data-toggle="table" data-search="true" data-live-search="true">' +
		'<thead>' +
		'<tr>' +
		'<th scope="col">id</th>'+
		'<th scope="col">#</th>' +
		'<th scope="col">Nombre</th>' +
		'<th scope="col">Apellido</th>' +
		'<th scope="col">Email</th>' +
		'</tr>' +
		'</thead>'+
		'<tbody>';
	const datosAlumnos = JSONdatosAlumnos;
	for (let i = 0; i < datosAlumnos.length; i++){
		let datosAlumno = datosAlumnos[i];
		tablaHTMLAlumnos += '<tr>' +
			'<td></td>' +
			'<th scope="row">'+ (i + 1) +'</th>' +
			'<td>'+ datosAlumno['nombres'] +'</td>' +
			'<td>'+ datosAlumno['apellidoPaterno'] +'</td>' +
			'<td>'+ datosAlumno['email'] +'</td>' +
			'</tr>';
	}
	tablaHTMLAlumnos +='</tbody>' + '</table>';
	//Toolbar HTML para la tabla
	const toolbarAlumnos =
		'<div id="'+idTabla+'toolbar" class="select">'+
			'<select class="form-control">'+
				'<option value="all">Exportar todo</option>'+
				'<option value="selected">Exportar seleccionado</option>'+
			'</select>'+
		'</div>';

	//ID del BODY del modal
	let modalBodyDetalleAlumnos = document.getElementById(idBodyModal);
	//Primero toolbar, luego tabla
	modalBodyDetalleAlumnos.innerHTML += toolbarAlumnos;
	modalBodyDetalleAlumnos.innerHTML += tablaHTMLAlumnos;
	//JQuery forma de descarga de tabla y cuales columnas
	const $tablaAlumnos = $('#'+idTabla);
	$(function() {
		$('#'+idTabla+'toolbar').find('select').change(function () {
			$tablaAlumnos.bootstrapTable('destroy').bootstrapTable({
				exportDataType: $(this).val(),
				exportTypes: ['csv', 'excel', 'pdf'],
				columns: [
					{
						field: 'state',
						checkbox: true,
						visible: $(this).val() === 'selected'
					},  {
						field: '#',
						title: '#'
					}, {
						field: 'Nombre',
						title: 'Nombre'
					}, {
						field: 'Apellido',
						title: 'Apellido'
					}, {
						field: 'Email',
						title: 'Email'
					}
				]
			})
		}).trigger('change');
	});
}

//Estadisticas Paso 1
tabla_detalleAlumnos(@json($estadisticasPasantias['alumnosPasantiaPaso1']), 'g_pasantiaPaso1', 'bodyModal_pasantiaPaso1');
//Estadisticas Paso 2
tabla_detalleAlumnos(@json($estadisticasPasantias['alumnosPasantiaPaso2']), 'g_pasantiaPaso2', 'bodyModal_pasantiaPaso2');
//Estadisticas Paso 3
tabla_detalleAlumnos(@json($estadisticasPasantias['alumnosPasantiaPaso3']), 'g_pasantiaPaso3', 'bodyModal_pasantiaPaso3');
//Estadisticas Paso 4
tabla_detalleAlumnos(@json($estadisticasPasantias['alumnosPasantiaPaso4']), 'g_pasantiaPaso4', 'bodyModal_pasantiaPaso4');

//Proyectos Aprobados
tabla_detalleAlumnos(@json($estadisticasProyectos['alumnosProyectosAprobados']), 'g_proyectosAprobados', 'bodyModal_proyectosAprobados');
//Proyectos NO Aprobados
tabla_detalleAlumnos(@json($estadisticasProyectos['alumnosProyectosAprobados']), 'g_proyectosNoAprobados', 'bodyModal_proyectosNoAprobados');

//Proyectos Inscritos
tabla_detalleAlumnos(@json($estadisticasProyectos['alumnosProyectosInscritos']), 'g_proyectosInscritos', 'bodyModal_proyectosInscritos');
//Proyectos NO inscritos
tabla_detalleAlumnos(@json($estadisticasProyectos['alumnosProyectosNOInscritos']), 'g_proyectosNoInscritos', 'bodyModal_proyectosNoInscritos');

//Inscripciones Terminadas
tabla_detalleAlumnos(@json($estadisticasInscripciones['alumnosInscripcionesTerminadas']), 'g_inscripcionesTerminadas', 'bodyModal_inscripcionesTerminadas');
//Inscripciones NO terminadas
tabla_detalleAlumnos(@json($estadisticasInscripciones['alumnosInscripcionesNoTerminadas']), 'g_inscripcionesNoTerminadas', 'bodyModal_inscripcionesNoTerminadas');

//Validadas Supervisor
tabla_detalleAlumnos(@json($estadisticasSupervisores['alumnosPasantiasValidadasSupervisor']), 'g_PasantiasValidadasSupervisor', 'bodyModal_PasantiasValidadasSupervisor');
//NO Validadas Supervisor
tabla_detalleAlumnos(@json($estadisticasSupervisores['alumnosNoPasantiasValidadasSupervisor']), 'g_NoPasantiasValidadasSupervisor', 'bodyModal_NoPasantiasValidadasSupervisor');

//Grafico pasos de cada alumno
window.chart = new Highcharts.chart({
	chart: {
		//forma
		type: 'bar',
		//ubicacion
		renderTo: 'pasos',
		//tamaño
		height: (9 / 16 * 75) + '%'
	},
	title: {
		//texto titulo
		text: 'Porcentaje de postulantes en cada paso ',
		//estilos del titulo
		style: {
			fontSize: '22px'
		}
	},
	//Habilitar botones de descarga
	exporting: {
		enabled: true,
		csv: {
			dateFormat:'%A, %b %e, %Y'
		}
	},
	//Eliminar creditos del grafico
	credits: {
		enabled: false
	},
	//Todo sobre el eje X
	xAxis: {
		type: 'category',
		labels: {
			style: {
				fontSize: '1.25em',
				fontWeight: 'bold'
			}
		}
	},
	//Todo sobre el eje Y
	yAxis: {
		title: {
      text: 'Porcentaje de postulantes',
			style: {
				fontSize: '1.25em',
				fontWeight: 'bold'
			}
		},
		labels: {
			style: {
				fontSize: '1em'
			}
		}
	},
	//Columnas del grafico
	plotOptions: {
		series: {
			colorByPoint: true,
			cursor: 'pointer',
			dataLabels: {
				enabled: true,
				inside: true,
			},
			point: {
				events: {
					//Que hacer al clickear una barra
					click: function (e) {
						$('#'+this.modal_ID).modal('toggle');
					}
				}
			}
		}
	},
	//Datos del grafico
	series: [{
		name: 'Postulantes',
		dataLabels: [{
			//Lo que se debe ver en el grafico
			align: 'right',
			format: '{y} '
		},{
			align: 'center',
			format: '{point.porcentajePostulantes:.2f} %'
		}],
		//Datos
		data: [{
			y: @json($estadisticasPasantias['pasantiasPaso1Count']),
			porcentajePostulantes: @json($estadisticasPasantias['pasantiasPaso1Count']) / @json($estadisticasPasantias['pasantiasTotal']) * 100,
			name: 'Requisitos académicos',
			modal_ID: 'Modal_pasantiaPaso1'
		}, {
			y: @json($estadisticasPasantias['pasantiasPaso2Count']),
			porcentajePostulantes: @json($estadisticasPasantias['pasantiasPaso2Count']) / @json($estadisticasPasantias['pasantiasTotal']) * 100,
			name: 'Inscripción pasantía',
			modal_ID: 'Modal_pasantiaPaso2'
		}, {
			y: @json($estadisticasPasantias['pasantiasPaso3Count']),
			porcentajePostulantes: @json($estadisticasPasantias['pasantiasPaso3Count']) / @json($estadisticasPasantias['pasantiasTotal']) * 100,
			name: 'Inscripción supervisor',
			modal_ID: 'Modal_pasantiaPaso3'
		}, {
			y: @json($estadisticasPasantias['pasantiasPaso4Count']),
			porcentajePostulantes: @json($estadisticasPasantias['pasantiasPaso4Count']) / @json($estadisticasPasantias['pasantiasTotal']) * 100,
			name: 'Inscripción proyecto',
			modal_ID: 'Modal_pasantiaPaso4'
		}],
		showInLegend: false
	}]
});

/*
chart_RenderTo -> id del elemento en donde se mostrara este grafico STRING
title_Text -> titulo del grafico STRING
series_Name -> nombre general de los datos STRING
data_Attributes1 -> [nombre, valorNumerico, valorPorcentaje, NOMBRE MODAL] STRING, INT, FLOAT, STRING
data_Attributes2 -> [nombre, valorNumerico, valorPorcentaje, NOMBRE MODAL] STRING, INT, FLOAT, STRING
*/
const pieChartConstructor = (chart_RenderTo, title_Text, series_Name, data_Attributes1, data_Attributes2) => {
	//Grafico de torta genérico
	window.chart = new Highcharts.chart({
		chart: {
			//tipo
			type: 'pie',
			//donde ubicar
			renderTo: chart_RenderTo,
			//tamaño
			height: (9 / 16 * 100) + '%',
			plotBackgroundColor: null,
			plotBorderWidth: null,
			plotShadow: false
		},
		title: {
			//titulo
			text: title_Text,
			//estilos
			style: {
				fontSize: '22px'
			}
		},
		//lo que muestra al hover
		tooltip: {
			pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
		},
		//descarga habilitada
		exporting: {
			enabled: true,
			csv: {
				//fecha
				dateFormat:'%A, %b %e, %Y'
			}
		},
		//no usar creditos en el grafico
		credits: {
			enabled: false
		},
		//opciones del grafico
		plotOptions: {
			pie: {
				allowPointSelect: true,
				dataLabels: {
					enabled: true,
					format: '<b>{point.name}</b>: {point.y} ({point.percentage:.1f}%)',
					style: {
						color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black',
						fontSize: '1em'
					}
				}
			},
			series: {
				cursor: 'pointer',
				point: {
					events: {
						click: function (e) {
							//Que hacer al clickear una parte de la torta
							$('#'+this.modal_ID).modal('toggle');
						}
					}
				}
			}
		},
		//todos los datos del grafico
		series: [{
			name: series_Name,
			colorByPoint: true,
			data: [{
				name: data_Attributes1[0],
				y: data_Attributes1[1],
				value: data_Attributes1[2],
				modal_ID: data_Attributes1[3],
				sliced: true,
				selected: true
			}, {
				name: data_Attributes2[0],
				y: data_Attributes2[1],
				value: data_Attributes2[2],
				modal_ID: data_Attributes2[3]
			}]
		}]
	});
}

//Pie chart de empresas
pieChartConstructor('empresasEnConvenio', 'Convenios de empresas', 'Empresas',
	//data_Attributes1
	['Empresas con convenio',
	@json($estadisticasEmpresas['empresasValidadasCount']),
	@json($estadisticasEmpresas['empresasPorcentajeValidadas']),
	detalleDatosEmpresas(@json($estadisticasEmpresas['empresasValidadas']))],
	//data_Attributes2
	['Empresas sin convenio',
	@json($estadisticasEmpresas['empresasNoValidadasCount']),
	@json($estadisticasEmpresas['empresasPorcentajeNoValidadas']),
	detalleDatosEmpresas(@json($estadisticasEmpresas['empresasNoValidadas']))]);

//Pie chart de proyectos validados vs no validados
pieChartConstructor('proyectosValidados', 'Estado de los proyectos', 'Proyectos',
	//data_Attributes1
	['Proyectos validados',
	@json($estadisticasProyectos['proyectosAprobadosCount']),
	@json($estadisticasProyectos['proyectosAprobadosPorcentaje']),
	detalleDatosAlumnos(@json($estadisticasProyectos['alumnosProyectosAprobados']))],
	//data_Attributes2
	['Proyectos no validados',
	@json($estadisticasProyectos['proyectosNoAprobadosCount']),
	@json($estadisticasProyectos['proyectosNoAprobadosPorcentaje']),
	detalleDatosAlumnos(@json($estadisticasProyectos['alumnosProyectosNoAprobados']))]);

//Pie chart de proyectos inscritos vs no inscritos
pieChartConstructor('proyectosInscritos', 'Inscripciones de proyectos', 'Inscripciones',
	//data_Attributes1
	['Proyectos inscritos',
	@json($estadisticasProyectos['proyectosInscritosCount']),
	@json($estadisticasProyectos['proyectosInscritosPorcentaje']),
	detalleDatosAlumnos(@json($estadisticasProyectos['alumnosProyectosInscritos']))],
	//data_Attributes2
	['Proyectos no inscritos',
	@json($estadisticasProyectos['proyectosNOInscritosCount']),
	@json($estadisticasProyectos['proyectosNoInscritosPorcentaje']),
	detalleDatosAlumnos(@json($estadisticasProyectos['alumnosProyectosNOInscritos']))]);

//Pie chart de inscripciones terminadas
pieChartConstructor('inscripcionesTerminadas', 'Estado de las pasantías', 'Pasantías',
	//data_Attributes1
	['Pasantías terminadas',
	@json($estadisticasInscripciones['inscripcionesTerminadasCount']),
	@json($estadisticasInscripciones['inscripcionesTerminadasPorcentaje']),
	detalleDatosAlumnos(@json($estadisticasInscripciones['alumnosInscripcionesTerminadas']))],
	//data_Attributes2
	['Pasantías no terminadas',
	@json($estadisticasInscripciones['inscripcionesNoTerminadasCount']),
	@json($estadisticasInscripciones['inscripcionesNoTerminadasPorcentaje']),
	detalleDatosAlumnos(@json($estadisticasInscripciones['alumnosInscripcionesNoTerminadas']))]);

//Pie chart de validaciones de supervisor
pieChartConstructor('validacionSupervisor', 'Pasantías validadas por supervisor', 'Pasantía',
	//data_Attributes1
	['Pasantías no validadas por supervisor',
	@json($estadisticasSupervisores['pasantiasNoValidadasSupervisorCount']),
	@json($estadisticasSupervisores['pasantiasNoValidadasSupervisorPorcentaje']),
	detalleDatosAlumnos(@json($estadisticasSupervisores['alumnosNoPasantiasValidadasSupervisor']))],
	//data_Attributes2
	['Pasantías validadas por supervisor',
	@json($estadisticasSupervisores['pasantiasValidadasSupervisorCount']),
	@json($estadisticasSupervisores['pasantiasValidadasSupervisorPorcentaje']),
	detalleDatosAlumnos(@json($estadisticasSupervisores['alumnosPasantiasValidadasSupervisor']))]);
	</script>
@endsection
