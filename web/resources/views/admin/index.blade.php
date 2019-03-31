@extends('layout')

@section('title', 'Graficos')

@section('contenido')
<div class="container">
	@if(session()->get('success'))
		<div class="alert alert-success">
			{{ session()->get('success') }}
		</div><br />
		@endif
		<div class="row">
			<h1>Elija su gráfica preferida para mostrar los datos</h1>
		</div>

		<div class="row">
			<div class="col-xs-12">
				<button type="button" id="barBtn" class="btn btn-primary">Graficar</button>

			</div>
		</div>
		<div class="row">
			<div class="col-md-12">

				<div id="grafico"></div>


			</div>
		</div>
</div>


<script>
	document.getElementById("barBtn").addEventListener("click", function() {
		var barChart = Highcharts.chart('grafico', {
			chart: {
				type: 'bar'
			},
			credits: {
      enabled: false
  		},
			title: {
				text: 'Cantidad de alumnos en cada paso en el proceso de inscripcion de pasantia'
			},
			xAxis: {
				title: {
					text: 'Mes'
				},
				categories: ['Marzo', 'Abril', 'Mayo', 'Junio', 'Julio']
			},
			yAxis: {
				title: {
					text: 'Cantidad de postulantes'
				}
			},

			series: [{
					name: 'Paso 1',
					data: [70, 40, 30, 20, 2]
				}, {
					name: 'Paso 2',
					data: [15, 30, 25, 20, 3]
				},
				{
					name: 'Paso 3',
					data: [10, 15, 20, 20, 5]
				},
				{
					name: 'Paso 4',
					data: [5, 15, 25, 40, 90]
				}
			]
		});
	});
</script>


@endsection
