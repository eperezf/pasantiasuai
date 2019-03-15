<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <title>@yield('title')</title>
  <!-- Scripts -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="../js/bootstrap.min.js"></script>

  <!-- Styles -->
  <!-- Bootstrap Core CSS -->
  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom CSS -->
  <link href="../css/layout-nav.css" rel="stylesheet">
  <!-- Icon Fonts -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
  <!-- Fonts -->
  <link href='https://fonts.googleapis.com/css?family=Titillium+Web' rel='stylesheet' type='text/css'>
</head>

<body>
  <div id="wrapper">
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php">Pasantias</a>
      </div>
      <!-- Top Menu Items -->
      <ul class="nav navbar-right top-nav">

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> Mi Perfil <b class="caret"></b></a>
          <ul class="dropdown-menu">

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
      </ul>


      <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
      <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
          <li class="active">
            <a href="#"><i class="fa fa-home"></i> Inicio</a>
          </li>

          <li>
            <a href="#" ><i class="fas fa-industry"></i> Empresas</a>
          </li>

          <li>
            <a href="#" ><i class="fab fa-android"></i> Misc</a>
          </li>

        </ul>
      </div>
      <!-- /.navbar-collapse -->
    </nav>
    <div id="page-wrapper">
      <div class="container-fluid">

        @yield('contenido')

      </div>
    </div
  </div>
</body>
</html>
