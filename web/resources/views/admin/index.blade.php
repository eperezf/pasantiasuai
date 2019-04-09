@extends('layout')

@section('title', 'Graficos')

@section('contenido')

	@if(session()->get('success'))
		<div class="alert alert-success">
			{{ session()->get('success') }}
		</div><br />
		@endif
		<div class="row">
			<h1>Estadisticas Administrativas</h1>
		</div>

		<div class="row">
			<div class="col-md-12">

				<div id="grafico"></div>

			</div>
		</div>


<script>

//FECHA ACTUAL
function fecha(){
	const hoy = new Date();
	let date = hoy.getFullYear()+'-'+(hoy.getMonth()+1)+'-'+hoy.getDate();
	return date
}

window.chart = new Highcharts.chart({
	//EN DONDE UBICARLO
	chart: {
		type: 'bar',
		renderTo: 'grafico',
		height: (9 / 16 * 100) + '%'
	},

	//TITULO
	title: {
		text: 'Porcentaje de postulantes en cada paso '
	},
	//SUBTITULO, FECHA ACTUAl
	subtitle: {
		text: 'Actualizado a la fecha: ' + fecha()
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
		type: 'category'
	},

	//LABEL EJE Y
	yAxis: {
		min: 0,
		max: 100,
		title: {
			text: 'Porcentaje de postulantes',
			align: 'high'
		},
		labels: {
			overflow: 'justify'
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
			name: 'Postulantes Paso 1'
		}, {
			y: 20,
			name: 'Postulantes Paso 2'
		}, {
			y: 40,
			name: 'Postulantes Paso 3',
		}, {
			y: 10,
			name: 'Postulantes Paso 4',
		}],
		showInLegend: false
	}]
});

</script>


@endsection
