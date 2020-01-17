@extends('layout')

@section('title', 'Graficos')

@section('contenido')
<script src="{{ URL::asset('/js/pieChart.js') }}"></script>
<script src="{{ URL::asset('/js/dashboard/tablasEstadisticas.js') }}"></script>

	@if(session()->get('success'))
		<div class="alert alert-success">
			{{ session()->get('success') }}
		</div><br />
		@endif
		<div class="row">
			<div class="col-12">
				<div class="card shadow m-5">
					<div class="card-header">
						Dashboard
					</div>
					<div class="card-body">
						<ul class="nav nav-tabs mb-5 ">
							<li class="nav-item">
								<a class="nav-link active" id="pasantias-tab" data-toggle="tab" href="#pasantias" role="tab">Pasantias</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="proyectos-tab" data-toggle="tab" href="#proyectos" role="tab">Proyectos</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="empresas-tab" data-toggle="tab" href="#empresas" role="tab">Empresas</a>
							</li>
						</ul>

						<!-- CONTENIDO DE PANELES -->
						<div class="tab-content" id="contenidoPaneles">
						<!-- PASANTIAS -->
							<div class="tab-pane fade show active" id="pasantias" role="tabpanel" aria-labelledby="pasantias-tab">
								@include('admin.dashboard.estadisticasPasantias')
							</div>


						<!-- PROYECTOS -->
							<div class="tab-pane fade" id="proyectos" role="tabpanel" aria-labelledby="proyectos-tab">
								@include('admin.dashboard.estadisticasProyectos')
							</div>

						<!-- EMPRESAS -->
							<div class="tab-pane fade" id="empresas" role="tabpanel" aria-labelledby="empresas-tab">
								@include('admin.dashboard.estadisticasEmpresas')
							</div>

					</div>
				</div>
			</div>
		</div>
	</div>
@endsection