<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title>@yield('title')</title>

	<!-- CSS STYLES -->
	<link href='https://fonts.googleapis.com/css?family=Titillium+Web' rel='stylesheet' type='text/css'>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
	<!-- Font Awesome CSS -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	<!-- Custom CSS -->
	<link rel="stylesheet" href="../css/layout-menu.css">

	<!-- Font Awesome JS -->
	<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
	<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>


</head>

<body>

	<div class="wrapper">
		<!-- Sidebar -->
		<nav id="sidebar">
			<div class="sidebar-header">
				<h3>
					< Logo UAI? >
				</h3>
			</div>

			<!-- Elementos Menu Sidebar -->
			<ul class="list-unstyled components">
				<p> Dashboard Pasantias </p>
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
								< Sub Empresa1 >
							</a>
						</li>
						<li>
							<a href="#">
								< Sub Empresa2 >
							</a>
						</li>
						<li>
							<a href="#">
								< Sub Empresa3 >
							</a>
						</li>
					</ul>
				</li>

				<li>
					<a href="#"><i class="fab fa-apple"></i> Menu 3</a>
				</li>

				<li>
					<a href="#subMenu-4" class="drop-icon-animation" data-toggle="collapse" aria-expanded="false">
						<i class="fab fa-android"></i> Menu Colapsable 4
						<span class="ml-auto"></span>
					</a>
					<ul class="collapse list-unstyled" id="subMenu-4">
						<li>
							<a href="#">
								< Sub Menu1 >
							</a>
						</li>
						<li>
							<a href="#">
								< Sub Menu2 >
							</a>
						</li>
						<li>
							<a href="#">
								< Sub Menu3 >
							</a>
						</li>
					</ul>
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
						<i class="fa fa-user"></i> Mi Perfil
						<span></span>
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

						<li class="divider"></li>

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




	<!-- FOOTER -->


	<!-- SCRIPTS -->
	<!-- jQuery -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<!-- Popper -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
	<!-- Bootstrap -->
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
	<!-- Custom JS-->
	<script src="../js/layout-menu.js"></script>

</body>

</html>
