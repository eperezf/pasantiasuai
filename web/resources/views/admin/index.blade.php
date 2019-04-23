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

//FECHA ACTUAL
appendFecha('estadisticas');
/////////////
// // TODO: REFACTORIZAR EL CODIGO EN ARCHIVO JS APARTE DE HIGHCHARTS Y LLAMAR SOLO FUNCIONES EN ESTE LUGAR
////////////

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
		height: (9 / 16 * 75) + '%'
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
				fontSize: '1.25em',
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

	//COLORES Y LABEL DE CADA COLUMNA
	plotOptions: {
		series: {
			colorByPoint: true,
			cursor: 'pointer',
			dataLabels: {
				enabled: true,
				inside: true
			},
			point: {
				events: {
					click: function (e) {
						hs.htmlExpand(null, {
							pageOrigin: {
								x: e.pageX || e.clientX,
								y: e.pageY || e.clientY
							},
							headingText: this.series.data[this.x].name,
							maincontentText: 'Fecha: ' + fecha() + ':<br /> ' +
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
							'<td>Alberto</td>' +
							'<td>Johnson</td>' +
							'<td>Ingeniería Civil</td>' +
							'</tr>' +
							'<tr>' +
							'<th scope="row">2</th>' +
							'<td>Juana</td>' +
							'<td>Thornton</td>' +
							'<td>Ingeniería Comercial</td>' +
							'</tr>' +
							'<tr>' +
							'<th scope="row">3</th>' +
							'<td>Lucia</td>' +
							'<td>Fuentes</td>' +
							'<td>Ingeniería Civil</td>' +
							'</tr>' +
							'<tr>' +
							'<th scope="row">4</th>' +
							'<td>Pedro</td>' +
							'<td>Smith</td>' +
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
                format: '<b>{point.name}</b>: {point.percentage:.1f} %',
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
										maincontentText: 'Fecha: ' + fecha() + ':<br /> ' +
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
            sliced: true,
            selected: true
        }, {
            name: 'Pasantías terminadas sin defensa disponible',
            y: 19.14
        }, {
            name: 'Pasantías no terminadas',
            y: 44.88
        }]
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
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %',
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
										maincontentText: 'Fecha: ' + fecha() + ':<br /> ' +
										// TABLA FIJA -- DUMMY
										'<table class="table table-striped">' +
										'<thead>' +
										'<tr>' +
										'<th scope="col">#</th>' +
										'<th scope="col">Nombre</th>' +
										'<th scope="col">Sitio Web</th>' +
										'<th scope="col">Rubro</th>' +
										'</tr>' +
										'</thead>' +
										'<tbody>' +
										'<tr>' +
										'<th scope="row">1</th>' +
										'<td>Neztle</td>' +
										'<td>www.neztle.cl</td>' +
										'<td>Ingeniería Civil</td>' +
										'</tr>' +
										'<tr>' +
										'<th scope="row">2</th>' +
										'<td>Falabela</td>' +
										'<td>www.falabela.cl</td>' +
										'<td>Ingeniería Comercial</td>' +
										'</tr>' +
										'<tr>' +
										'<th scope="row">3</th>' +
										'<td>Ryplei</td>' +
										'<td>www.ryplei.cl</td>' +
										'<td>Ingeniería Civil</td>' +
										'</tr>' +
										'<tr>' +
										'<th scope="row">4</th>' +
										'<td>Junbo</td>' +
										'<td>www.junbo.cl</td>' +
										'<td>Derecho</td>' +
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
