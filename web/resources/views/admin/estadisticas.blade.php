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
				<div id="defensas"></div>
			</div>
			<div class="col-md-6">
				<div id="empresas"></div>
			</div>
		</div>


<script>
//Fecha en forma SIF (self invoking function)
(function() {
	const hoy = new Date().getFullYear() + '-' + (new Date().getMonth()+1) + '-' + new Date().getDate();
	document.getElementById('estadisticas').innerHTML += hoy;
})();

const detalleDatosAlumnos = (JSONdatosAlumnos) => {
	//Tabla HTML a desplegar
	let tablaHTML =
		'<table class="table table-striped">' +
		'<thead>' +
		'<tr>' +
		'<th scope="col">#</th>' +
		'<th scope="col">Nombre</th>' +
		'<th scope="col">Apellido</th>' +
		'<th scope="col">Carrera</th>' +
		'</tr>' +
		'</thead>';
	const datosAlumnos = JSONdatosAlumnos;

	for (let i = 0; i < datosAlumnos.length; i++){
		let datosAlumno = datosAlumnos[i];
		tablaHTML += '<tr>' +
			'<th scope="row">'+ (i + 1) +'</th>' +
			'<td>'+ datosAlumno['ciudad'] +'</td>' +
			'<td>'+ datosAlumno['pais'] +'</td>' +
			'<td>'+ datosAlumno['idAlumno'] +'</td>' +
			'</tr>';
	}
	tablaHTML += '<tbody>' +
		'</tbody>' +
		'</table>';
	return tablaHTML;
}


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
						hs.htmlExpand(null, {
							pageOrigin: {
								x: e.pageX || e.clientX,
								y: e.pageY || e.clientY
							},
							//Mostrar contenido
							headingText: this.series.data[this.x].name,
							maincontentText: this.detalleDatos
						});
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
			format: '{point.porcentajePostulantes} %'
		}],
		//Datos
		data: [{
			y: @json($estadisticasPasantias['pasantiasPaso1Count']),
			porcentajePostulantes: @json($estadisticasPasantias['pasantiasPaso1Count']) / @json($estadisticasPasantias['pasantiasTotal']) * 100,
			name: 'Requisitos académicos',
			detalleDatos: detalleDatosAlumnos(@json($estadisticasPasantias['pasantiasPaso1']))
		}, {
			y: @json($estadisticasPasantias['pasantiasPaso2Count']),
			porcentajePostulantes: @json($estadisticasPasantias['pasantiasPaso2Count']) / @json($estadisticasPasantias['pasantiasTotal']) * 100,
			name: 'Inscripción pasantía',
			detalleDatos: detalleDatosAlumnos(@json($estadisticasPasantias['pasantiasPaso2']))
		}, {
			y: @json($estadisticasPasantias['pasantiasPaso3Count']),
			porcentajePostulantes: @json($estadisticasPasantias['pasantiasPaso3Count']) / @json($estadisticasPasantias['pasantiasTotal']) * 100,
			name: 'Inscripción supervisor',
			detalleDatos: detalleDatosAlumnos(@json($estadisticasPasantias['pasantiasPaso3']))
		}, {
			y: @json($estadisticasPasantias['pasantiasPaso4Count']),
			porcentajePostulantes: @json($estadisticasPasantias['pasantiasPaso4Count']) / @json($estadisticasPasantias['pasantiasTotal']) * 100,
			name: 'Inscripción proyecto',
			detalleDatos: detalleDatosAlumnos(@json($estadisticasPasantias['pasantiasPaso4']))
		}],
		showInLegend: false
	}]
});

//Grafico de estado de pasantisa y defensas de los alumnos
window.chart = new Highcharts.chart({
	//EN DONDE UBICARLO
	chart: {
		type: 'pie',
		renderTo: 'defensas',
		height: (9 / 16 * 100) + '%',
		plotBackgroundColor: null,
		plotBorderWidth: null,
		plotShadow: false
	},
	//TITULO
	title: {
		text: 'Estado de pasantías y defensas ',
		style: {
			fontSize: '22px'
		}
	},
	//TOOLTIP
	tooltip: {
		pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
	},
	//BOTONES DE DESCARGA
	exporting: {
		enabled: true,
		csv: {
			dateFormat:'%A, %b %e, %Y'
		}
	},
	//SACAR CREDITOS
	credits: {
		enabled: false
	},
	//COLORES Y LABEL DE CADA PARTE
  plotOptions: {
    pie: {
      allowPointSelect: true,
      dataLabels: {
        enabled: true,
        format: '<b>{point.name}</b>: {point.cantidadPasantias}',
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
						hs.htmlExpand(null, {
							pageOrigin: {
								x: e.pageX || e.clientX,
								y: e.pageY || e.clientY
							},
							headingText: this.series.data[this.x].name,
							maincontentText:
							// TABLA FIJA -- DUMMY
							'<table class="table table-striped">' +
							'<thead>' +
							'<tr>' +
							'<th scope="col">#</th>' +
							'<th scope="col">Nombre</th>' +
							'<th scope="col">Apellido</th>' +
							'<th scope="col">Carrera</th>' +
							'</tr>' +
							'</thead>' +
							'<tbody>' +
							'<tr>' +
							'<th scope="row">1</th>' +
							'<td>Jaime</td>' +
							'<td>Maxwell</td>' +
							'<td>Derecho</td>' +
							'</tr>' +
							'<tr>' +
							'<th scope="row">2</th>' +
							'<td>Juana</td>' +
							'<td>Thomson</td>' +
							'<td>Ingeniería Comercial</td>' +
							'</tr>' +
							'<tr>' +
							'<th scope="row">3</th>' +
							'<td>Alberta</td>' +
							'<td>Einstein</td>' +
							'<td>Diseño</td>' +
							'</tr>' +
							'<tr>' +
							'<th scope="row">4</th>' +
							'<td>Elizabeth</td>' +
							'<td>Mary</td>' +
							'<td>Psicología</td>' +
							'</tr>' +
							'</tbody>' +
							'</table>'
						});
					}
				}
			}
    }
  },
	//DATA
  series: [{
    name: 'Pasantías',
    colorByPoint: true,
    data: [{
      name: 'Pasantías terminadas con defensa disponible',
      y: 35.98,
			cantidadPasantias: 350,
      sliced: true,
      selected: true
  	}, {
    	name: 'Pasantías terminadas sin defensa disponible',
    	y: 19.14,
			cantidadPasantias: 190
  	}, {
    	name: 'Pasantías no terminadas',
      y: 44.88,
			cantidadPasantias: 440
    }]
  }]
});

//Grafico de empresas en convenio, proceso y sin convenio
window.chart = new Highcharts.chart({
	//EN DONDE UBICARLO
	chart: {
		type: 'pie',
		renderTo: 'empresas',
		height: (9 / 16 * 100) + '%',
		plotBackgroundColor: null,
		plotBorderWidth: null,
		plotShadow: false,
	},
	//TITULO
	title: {
		text: 'Proceso de convenio de empresas para pasantías ',
		style: {
			fontSize: '22px'
		}
	},
	//TOOLTIP
	tooltip: {
			pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
	},
	//BOTONES DE DESCARGA
	exporting: {
		enabled: true,
		csv: {
			dateFormat:'%A, %b %e, %Y'
		}
	},
	//SACAR CREDITOS
	credits: {
		enabled: false
	},
	//LABEL EJE X
	xAxis: {
		type: 'category',
		labels: {
			style: {
				fontSize: '14px',
				fontWeight: 'bold'
			}
		}
	},
	//LABEL EJE Y
	yAxis: {
		min: 0,
		max: 100,
		title: {
      text: 'Porcentaje de postulantes',
			style: {
				fontSize: '14px',
				fontWeight: 'bold'
			}
		},
		labels: {
			style: {
				fontSize: '14px'
			}
		}
	},
	//COLORES Y LABEL DE CADA PARTE
  plotOptions: {
    pie: {
      allowPointSelect: true,
      dataLabels: {
        enabled: true,
        format: '<b>{point.name}</b>: {point.cantidadEmpresas} ',
        style: {
          color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black',
					fontSize: '1em'
        },
      }
    },
		series: {
			cursor: 'pointer',
			point: {
				events: {
					click: function (e) {
						hs.htmlExpand(null, {
							pageOrigin: {
								x: e.pageX || e.clientX,
								y: e.pageY || e.clientY
							},
							headingText: this.series.data[this.x].name,
							maincontentText: this.detalleDatos
						});
					}
				}
			}
		}
	},
	//DATA
  series: [{
    name: 'Empresas',
    colorByPoint: true,
    data: [{
      name: 'Empresas con convenio',
			cantidadEmpresas: @json($estadisticasEmpresas['empresasValidadasCount']),
      y: @json($estadisticasEmpresas['empresasValidadasCount']) / @json($estadisticasEmpresas['empresasTotal']) * 100,
      sliced: true,
			selected: true,
			detalleDatos: JSON.stringify(@json($estadisticasEmpresas['empresasValidadas']))
    }, {
      name: 'Empresas en proceso',
			cantidadEmpresas: @json($estadisticasEmpresas['empresasEnProcesoCount']),
			y: @json($estadisticasEmpresas['empresasEnProcesoCount']) / @json($estadisticasEmpresas['empresasTotal']) * 100,
			detalleDatos: JSON.stringify(@json($estadisticasEmpresas['empresasEnProceso']))
    }, {
      name: 'Empresas sin convenio',
			cantidadEmpresas: @json($estadisticasEmpresas['empresasNoValidadasCount']),
			y: @json($estadisticasEmpresas['empresasNoValidadasCount']) / @json($estadisticasEmpresas['empresasTotal']) * 100,
			detalleDatos: JSON.stringify(@json($estadisticasEmpresas['empresasNoValidadas']))
    }]
  }]
});
</script>
@endsection
