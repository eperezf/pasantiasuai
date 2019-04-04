@extends('layout')

@section('title', 'Graficos')

@section('contenido')

	@if(session()->get('success'))
		<div class="alert alert-success">
			{{ session()->get('success') }}
		</div><br />
		@endif
		<div class="row">
			<h1>Gráfico de número de estudiantes en cada paso</h1>
		</div>

		<div class="row">
			<div class="col-md-12">

				<div id="grafico"></div>

			</div>
		</div>


<script>
//SCRIPT CREA GRAFICO Y DATA RANDOM, FECHAS INCAMBIABLES
// CREA GRAFICO
$(function () {
	//FECHA RANDOM
	function randomDate(start, end) {
		//FECHA INCAMBIABLE
		return new Date(start.getTime() + Math.random() * (end.getTime() - start.getTime()))
	}
	//DATA RANDOM
	function randomData(){
		var arr = [];
		//DATOS DESDE FECHA INICIAL A FECHA FINAL
		for (var i = 0; i < 100; i++) {
			var date=randomDate(new Date(2004, 0, 9), new Date());
			console.log(date);
			var randNum=Math.round(Math.random() * 100);

			arr.push([date.getTime(), randNum]);
		}
		arr.sort(function (a,b) {
			if (a[0] < b[0]) return -1;
			if (a[0]> b[0]) return 1;
			return 0;
		})

		return arr;
	}

	window.chart = new Highcharts.StockChart({
		//EN DONDE UBICARLO
		chart: {
			renderTo: 'grafico',
			height: (9 / 16 * 100) + '%'
		},
		title: {
			text: 'Fecha y Número de estudiantes en cada paso'
		},
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
		tooltip:{
			shared: true,
			xDateFormat: '%A, %b %e, %Y'
		},
		//LABEL EJE X
		xAxis: {
			title: {
				text: 'Fecha'
			}
		},
		//LABEL EJE Y
		yAxis: {
			title: {
				text: 'Cantidad de postulantes'
			}
		},
		//LINEAS Y DATOS RESPECTIVOS
		series: [{
			name: 'Postulantes Paso 1',
			data: randomData()
		},
		{
			name: 'Postulantes Paso 2',
			data: randomData()
		},
		{
			name: 'Postulantes Paso 3',
			data: randomData()
		},
		{
			name: 'Postulantes Paso 4',
			data: randomData()
		}],

		//BOTONES
		rangeSelector: {
			buttons: [{
				type: 'month',
				count: 1,
				text: '1M',
			}, {
				type: 'month',
				count: 3,
				text: '3M'
			}, {
				type: 'month',
				count: 6,
				text: '6M'
			},  {
				type: 'year',
				count: 1,
				text: '1A'
			},
			{
				type: 'ytd',
				text: 'YTD'
			}, {
				type: 'all',
				text: 'Todo'
			}]
		},

	});
});
</script>


@endsection
