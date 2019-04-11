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
			<div class="col-md-12">
				<div id="defensas"></div>
			</div>
			<div class="col-md-12">
				<div id="empresas"></div>
			</div>
		</div>


<script>

//FECHA ACTUAL
fecha('estadisticas');

/*
/
/
/
/
/
/
/
*/
// GRAFICO 1 //
//GRAFICO POSTULANTES VS NUMERO DE PASO
window.chart = new Highcharts.chart({
	//EN DONDE UBICARLO
	chart: {
		type: 'bar',
		renderTo: 'pasos',
		height: (9 / 16 * 100) + '%'
	},

	//TITULO
	title: {
		text: 'Porcentaje de postulantes en cada paso ',
		style: {
			fontSize: '22px'
		}
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

	//COLORES Y LABEL DE CADA COLUMNA
	plotOptions: {
		series: {
			colorByPoint: true,
			dataLabels: {
				enabled: true,
				inside: true
			}
		}
	},

	//DATA
	series: [{
		name: 'Postulantes',
		dataLabels: [{
			align: 'right',
			format: '{y} %'
		}],
		data: [{
			y: 30,
			name: 'Postulantes paso 1'
		}, {
			y: 20,
			name: 'Postulantes paso 2'
		}, {
			y: 40,
			name: 'Postulantes paso 3',
		}, {
			y: 10,
			name: 'Postulantes paso 4',
		}],
		showInLegend: false
	}]
});

/*
/
/
/
/
/
/
/
*/
// GRAFICO 2 //
//GRAFICO PASANTIAS TERMINADAS/NO TERMINADAS QUE PUEDEN/NO PUEDEN DAR DEFENSAS
window.chart = new Highcharts.chart({
	//EN DONDE UBICARLO
	chart: {
		type: 'column',
		renderTo: 'defensas',
		height: (9 / 16 * 100) + '%'
	},

	//TITULO
	title: {
		text: 'Estado de pasantías y disponibilidad de defensa',
		style: {
			fontSize: '22px'
		}
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
		categories: ['Pasantías terminadas', 'Pasantías no terminadas'],
		labels: {
			style: {
				fontSize: '14px',
				fontWeight: 'bold'
			}
		}
	},

	//LABEL EJE Y
	yAxis: {
		allowDecimals: false,
		min: 0,
		max: 100,
		title: {
			text: 'Porcentaje de pasantías',
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

	//COLORES Y LABEL DE CADA COLUMNA
	plotOptions: {
		series: {
			dataLabels: {
				enabled: true,
				inside: true
			}
		},
		column: {
			stacking: 'normal'
		}
	},

	//DATA
	// series: [{
	//       name: 'Terminada sin defensa',
	//       data: [35,0],
	//       stack: 'Terminadas'
	//   }, {
	//       name: 'Terminada con defensa',
	//       data: [65,0],
	//       stack: 'Terminadas'
	//   }, {
	//       name: 'No terminada sin defensa',
	//       data: [0,49],
	//       stack: 'No Terminadas'
	//   }, {
	//       name: 'No terminada con defensa',
	//       data: [0,51],
	//       stack: 'No Terminadas'
	//   }]

	series: [{
		name: 'Terminado sin defensa disponible',
		legendIndex: 1,
		dataLabels: [{
			format: '{y} %'
		}],
		// TERMINADO Y DEFENSA NO DISPONIBLE
		data: [{
			y: 23,
			name: 'Pasantías terminadas',
		}]
	},
	{
		name: 'No terminado sin defensa disponible',
		legendIndex: 3,
		dataLabels: [{
			format: '{y} %'
		}],
		// NO TERMINADO Y DEFENSA NO DISPONIBLE
		data: [{
			y: null,
			name: 'Pasantías no terminadas',
		}, {
			y: 81,
			name: 'Pasantías no terminadas',
		}]
	},
	{
		name: 'Terminado con defensa disponible',
		legendIndex: 2,
		dataLabels: [{
			format: '{y} %'
		}],
		// TERMINADO Y DEFENSA DISPONIBLE
		data: [{
			y: 77,
			name: 'Pasantías terminadas',
		}]

	},
	{
		name: 'No terminado con defensa disponible',
		legendIndex: 4,
		dataLabels: [{
			format: '{y} %'
		}],
		// NO TERMINADO Y DEFENSA DISPONIBLE
		data: [{
			y: null,
			name: 'Pasantías no terminadas',
		}, {
			y: 19,
			name: 'Pasantías no terminadas',
		}]
	}],

	// LEYENDAS A LA DERECHA SUPERIOR
	legend: {
        align: 'right',
        verticalAlign: 'top',
        layout: 'vertical',
        x: 0,
        y: 100
    },
});


/*
/
/
/
/
/
/
/
*/
// GRAFICO 3 //
//GRAFICO EMPRESAS EN CONVENIO, EN PROCESO, SIN CONVENIO
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
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                style: {
                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
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
            y: 53.41,
            sliced: true,
            selected: true
        }, {
            name: 'Empresas en proceso',
            y: 28.84
        }, {
            name: 'Empresas sin convenio',
            y: 17.75
        }]
    }]
});



</script>


@endsection
