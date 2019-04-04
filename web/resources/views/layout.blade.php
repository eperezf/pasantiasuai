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
	<!-- CSS STYLES -->
	<link href='https://fonts.googleapis.com/css?family=Titillium+Web' rel='stylesheet' type='text/css'>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<!-- Font Awesome CSS -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	<!-- Custom CSS -->
	<link rel="stylesheet" href="/css/layout-menu.css">

	<!-- Font Awesome JS -->
	<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
	<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

	<!-- jQuery -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<!-- Popper -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<!-- Bootstrap -->
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<!-- Custom JS-->
	<script src="../js/layout-menu.js"></script>




</head>

<body>

	<div class="wrapper">
		<!-- Sidebar -->
		<nav id="sidebar">
			<div class="sidebar-header">
				<h3>
					<img src="https://upload.wikimedia.org/wikipedia/commons/4/4c/FIC_UAI.jpg" class="img-fluid">
				</h3>
			</div>

			<!-- Elementos Menu Sidebar -->
			<ul class="list-unstyled components">

				<li class="active">
					<a href="#"><i class="fa fa-home"></i> Home</a>
				</li>

				<li>
					<a href="#"><i class="fas fa-paste"></i> Pasantias</a>
				</li>

				<li>
					<a href="#subMenu-Empresas" class="drop-icon-animation" data-toggle="collapse" aria-expanded="false">
						<i class="fas fa-industry"></i> Empresas
						<span class="ml-auto"></span>
					</a>
					<ul class="collapse list-unstyled" id="subMenu-Empresas">
						<li>
							<a href="#">
								Lorem
							</a>
						</li>
						<li>
							<a href="#">
								Ipsum
							</a>
						</li>
						<li>
							<a href="#">
								Perspiciatis
							</a>
						</li>
					</ul>
				</li>

				<li>
					<a href="#"><i class="fas fa-chart-line"></i> Estadisticas </a>
				</li>

				<li>
					<a href="#"><i class="fas fa-balance-scale"></i> Reglamento </a>
				</li>

			</ul>
		</nav>

		<!-- Contenido -->
		<div class="container-fluid">
			<!-- <div class="row"> -->
			<!-- <div class="col-md-12"> -->
			<nav class="navbar navbar-expand-lg navbar-light bg-light">
				<!-- <div class="col-2"> -->
				<!-- BTN COLLAPSE SIDEBAR -->
				<button type="button" id="sidebarCollapse" class="navbar-btn">
					<span></span>
					<span></span>
					<span></span>
				</button>
				<!-- </div>
          <div class="col-2"> -->
				<ul class="navbar-nav">
					<li class="nav-item">
						<span class="navbar-brand"> Bienvenido < Usuario> </span>
					</li>
				</ul>


				<!-- </div> -->

				<!-- <div class="col-8"> -->

				<li class=" nav-item ml-auto dropdown list-unstyled">
					<a href="#" class="drop-icon-animation" data-toggle="dropdown" aria-expanded="false">
						<i class="fa fa-user"></i>
						Mi Perfil
						<span class="profile-arrow ml-auto"></span>
					</a>

					<ul class="dropdown-menu dropdown-menu-right">

						<li>
							<a href="#"><i class="fas fa-user-tie"></i> Mis Pasantias</a>
						</li>

						<li>
							<a href="#"><i class="fas fa-graduation-cap"></i> Mi Profesor</a>
						</li>

						<li>
							<a href="#"><i class="fas fa-wrench"></i> Configuracion</a>
						</li>

						<div class="dropdown-divider"></div>

						<li>
							<a href="#"><i class="fa fa-fw fa-power-off"></i> Cerrar Sesion</a>
						</li>
					</ul>
				</li>
			</nav>

			<!-- CONTENIDO PAGINA -->
			<div id="content">
				<!-- NAV BAR FLOTANTE CONTENIDO -->


				@yield('contenido')

			</div>
		</div>
	</div>

</body>

</html>
