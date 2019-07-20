<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title>@yield('title')</title>
	
	<!-- Highcharts -->
	<script src="http://code.highcharts.com/stock/highstock.js"></script>
	<script src="https://code.highcharts.com/modules/exporting.js"></script>
	<script src="https://code.highcharts.com/modules/export-data.js"></script>
	<script src="https://www.highcharts.com/media/com_demo/js/highslide-full.min.js"></script>
	<script src="https://www.highcharts.com/media/com_demo/js/highslide.config.js" charset="utf-8"></script>
	
	<!-- CSS STYLES -->
	<link href='https://fonts.googleapis.com/css?family=Titillium+Web' rel='stylesheet' type='text/css'>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<!-- Font Awesome CSS -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
	<!-- Highcharts CSS -->
	<link rel="stylesheet" type="text/css" href="https://www.highcharts.com/media/com_demo/css/highslide.css" />
	
	<!-- JS -->
	<!-- Font Awesome JS -->
	<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
	<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
	<!-- jQuery JS -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<!-- Bootstrap JS -->
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<!-- Custom JS-->
	<script src="/js/layout-menu.js"></script>
	<!--Bootstrap Tables-->
	<link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.14.2/dist/bootstrap-table.min.css">
	<script src="https://unpkg.com/bootstrap-table@1.14.2/dist/bootstrap-table.min.js"></script>
	
</head>

<body>
	
	<nav class="navbar navbar-expand navbar-dark bg-dark">
		<!-- Logo SVG UAI -->
		<a class="navbar-brand mr-1" href="https://www.uai.cl">
			<img src="../media/images/logouai.svg" alt="Universidad Adolfo Ibáñez">
		</a>
		<!-- Boton Collapse Sidebar -->
		<button class="btn btn-link text-white" type="button" data-toggle="collapse" data-target="#MenuSidebar" aria-expanded="true" aria-controls="MenuSidebar" href="#">
      <i class="fas fa-bars"></i>
		</button>
		<!-- Boton Perfil -->
			<div class="ml-auto">
				<li class="dropdown list-unstyled">
					<button href="#" class="drop-icon-animation btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
						<i class="fa fa-user"></i>
						<span>
							{{Auth::user()->nombres}}
							{{Auth::user()->apellidoPaterno}}
						</span>
					</button>
					<!-- Menu desplegable del perfil -->
					<ul class="dropdown-menu dropdown-menu-right">
						<li class="nav-item">
							<a href="{{route('inscripcion.resumen')}}" class="dropdown-item nav-link"><i class="fas fa-user-tie"></i> Mis Pasantias</a>
						</li>
						<li class="nav-item">
							<a href="#" class="dropdown-item nav-link"><i class="fas fa-graduation-cap"></i> Mi Profesor</a>
						</li>
						<li class="nav-item">
							<a href="/perfil" class="dropdown-item nav-link"><i class="fas fa-wrench"></i> Configuracion</a>
						</li>
						<div class="dropdown-divider"></div>
						<li>
							<a href="{{route('logout')}}" class="dropdown-item nav-link"><i class="fa fa-fw fa-power-off"></i> Cerrar Sesion</a>
						</li>
					</ul>
				</li>
			</div>
	</nav>
	<div class="container-fluid">
		<div class="row flex-xl-nowrap">
			<div class="col-12 col-md-3 col-xl-2 bg-light collapse navbar-collapse show" id="MenuSidebar" style="transition: none">
							<!-- Sidebar -->
			<!--	<img src="../media/images/logo-iuai.png" alt="Responsive image" class="img-fluid">-->
				<!-- Elementos del menu sidebar -->
				<div class="list-group my-3 p-3">
					<a href="/" class="list-group-item list-group-item-action"> 
						<i class="fa fa-home"></i> Inicio
					</a>
					<a href="{{route('inscripcion.resumen')}}" class="list-group-item list-group-item-action">
						<i class="fas fa-paste"></i> Pasantia
					</a>
					<a href="/empresas" class="list-group-item list-group-item-action ">
						<i class="fas fa-industry"></i> Empresas
					</a>
					@if(Auth::user()->rol >= 4)
					<a href="#" class="list-group-item list-group-item-action ">
						<i class="fas fa-chart-line"></i> Estadisticas
					</a>
					@endif
  				<a href="#" class="list-group-item list-group-item-action">
						<i class="fas fa-balance-scale"></i> Reglamento
					</a>
				</div>
			</div>
			<!-- Fin Sidebar -->
			<div class="col-12 col-md-9 col-xl-10 text-center">
				<!-- Contenido del resto de la pagina -->
				<div class="container-fluid py-3">
					<div class="row">
						<div class="col-12">
							@yield('contenido')
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Footer -->
		<div class="row flex-xl-nowrap">
			<div class="col-12 bg-dark">
				<div class="text-center">
          <hr>
					<span class="text-light small">©2019 UNIVERSIDAD ADOLFO IBAÑEZ</span>
					<address style="text-align: center;">
						<span class="text-light small">SANTIAGO : DIAGONAL LAS TORRES 2640 PEÑALOLÉN / PRESIDENTE ERRÁZURIZ 3485 LAS CONDES.</span>
						<br>
						<span class="text-light small">VIÑA DEL MAR : AVDA. PADRE HURTADO 750, VIÑA DEL MAR.</span>
					</address>
          <hr>
				</div>
			</div>
		</div>
		<!-- Fin Footer -->
	</div>
</body>
</html>