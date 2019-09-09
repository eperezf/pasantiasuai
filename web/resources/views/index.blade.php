@extends('layout')

@section('title', 'Inicio')
@section('contenido')

<h1 class=""> Bienvenido a la plataforma de gestión FIC:</h1>
<div class="container">
	<div class="row">
		<div class="col-12">
			<div class="my-3 p-3">
				@if(Auth::user()->rol >= 4)
				<!-- 
          ***Arreglo de la muerte***
          $datos[i] recibe el primer nivel del arreglo: 'pasantias', 'usuarios' y 'empresas'
          
          array_values($datos[i])[i]) recibe el segundo nivel, dado que solo hay 1 por cada uno de los primeros, siempre  es 0, es un arreglo de tamaño 1
          
          array_values(array_values($datos[i])[i])) adquiere el arreglo que contiene los valores
          
          array_values(array_values($datos[i])[i])[i]) es finalmente el valor 
        -->
				<div class="row">
					<div class="col-sm-6 my-3">
						<div class="card">
							<div class="card-title bg-primary p-3">
								<h5 class="card-title text-white"> Resumen Pasantías <i class="fas fa-paste"></i></h5>
							</div>
							<div class="card-body">
								<p class="card-text">Pasantías en santiago: {{array_values((array_values($datos[0]))[0])[0]}}</p>
								<p class="card-text">Pasantías válidas: {{array_values((array_values($datos[0]))[0])[1]}}</p>
								<p class="card-text">Pasantías totales: {{array_values((array_values($datos[0]))[0])[2]}}</p>
								<div class="text-right">
									<a href="/admin/inscripcionPasantias" class="btn btn-primary">Ver más <i
											class="fas fa-arrow-right"></i></a>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-6 my-3">
						<div class="card">
							<div class="card-title bg-primary p-3">
								<h5 class="card-title text-white"> Resumen Empresas <i class="fas fa-industry"></i></h5>
							</div>
							<div class="card-body">
								<p class="card-text">Empresas totales: {{array_values((array_values($datos[2]))[0])[2]}}</p>
								<p class="card-text">Empresas validas: {{array_values((array_values($datos[2]))[0])[0]}}</p>
								<p class="card-text">Empresas no validas: {{array_values((array_values($datos[2]))[0])[1]}}</p>
								<div class="text-right">
									<a href="/empresas" class="btn btn-primary">Ver más <i class="fas fa-arrow-right"></i></a>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-sm-6 my-3">
						<div class="card">
							<div class="card-title bg-primary p-3">
								<h5 class="card-title text-white"> Resumen Usuarios <i class="fas fa-user-tie"></i></h5>
							</div>
							<div class="card-body">
								<p class="card-text">Numero de pasantes: {{array_values((array_values($datos[1]))[0])[0]}}</p>
								<p class="card-text">Numero de profesores: {{array_values((array_values($datos[1]))[0])[1]}}</p>
								<p class="card-text">Numero de administradores: {{array_values((array_values($datos[1]))[0])[2]}}</p>
								<div class="text-right">
									<a href="#" class="btn btn-primary disabled">Ver más <i class="fas fa-arrow-right"></i></a>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-6 my-3">
						<div class="card">
							<div class="card-title bg-primary p-3">
								<h5 class="card-title text-white"> Estadísticas <i class="fas fa-chart-line"></i></h5>
							</div>
							<div class="card-body">
								<p class="card-text">Resumen de estadísticas pronto disponible</p>
								<p class="card-text">Información disponible dentro de la página de gráficos</p>
								<div class="text-right">
									<a href="/admin/estadisticas" class="btn btn-primary">Ver más <i class="fas fa-arrow-right"></i></a>
								</div>
							</div>
						</div>
					</div>
				</div>

				@else
				<!-- Usuarios normales -->


				<!-- Script permitir popover en la pagina -->
				<script>
					$(function () {
						$('[data-toggle="popover"]').popover()
					})
				</script>
				<!-- botones popover -->
				<!-- terminar informacion paso 4 cuando este listo -->
				<!-- boton popover pasantia -->
				<button type="button" class="btn btn-lg btn-light m-3" data-toggle="popover" data-placement="bottom"
					title="Pasantia" data-content="
        @if ($pasantia == null)
        Aún no ha empezado el proceso de su pasantía.
        @elseif ($pasantia != null && $pasantia->statusPaso0 != 2)
        Aún no ha aceptado el reglamento de pasantías.
        @elseif ($pasantia != null && $pasantia->statusPaso1 != 2 && $pasantia->statusPaso0 == 2)
        Uno o más requerimientos académicos de su pasantía están incompletos.
        @elseif ($pasantia != null && $pasantia->statusPaso2 == 0 && $pasantia->statusPaso1 == 2)
        Aún no ha iniciado el paso 2 de su pasantía.
        @elseif ($pasantia != null && $pasantia->statusPaso2 == 1)
        Faltan uno o más datos del paso 2.
        @elseif ($pasantia != null && $pasantia->statusPaso2 == 3)
        Su pasantía está en espera de validación por familiar en la empresa.
        @elseif ($pasantia != null && $pasantia->statusPaso3 == 0)
        El profesor tutor de su pasantía ha confirmado el mail.
        @elseif ($pasantia != null && $pasantia->statusPaso3 != 0 && $pasantia->statusPaso2 == 2)
        El proceso del profesor tutor de su pasantía aún no ha concluído, vea Mi profesor para más información.
        @elseif ($pasantia != null && $pasantia->statusPaso4 == 0 && $pasantia->statusPaso3 == 4)
        Aún no ha empezado la inscripción de su pasantía.
        @else
        Ha ocurrido un error, favor de intentar nuevamente.
        @endif">
					<i class="fas fa-paste"></i> Mi pasantía
				</button>

				<!-- boton popover profesor -->
				<button type="button" class="btn btn-lg btn-light m-3" data-toggle="popover" data-placement="bottom"
					title="Profesor" data-content="
      @if ($pasantia == null || $pasantia->statusPaso3 == 0)
      Aún no ha seleccionado un profesor tutor de su pasantía.
      @elseif ($pasantia->statusPaso3 == 1)
      La información que ha ingresado del profesor tutor de su pasantía está incompleta.
      @elseif ($pasantia->statusPaso3 == 2)
      No has enviado el mail de confirmación hacia el profesor tutor de su pasantía.
      @elseif ($pasantia->statusPaso3 == 3)
      El profesor tutor de su pasantía aún no ha aceptado el mail de confirmación.
      @elseif ($pasantia->statusPaso3 == 4)
      El profesor tutor de su pasantía ha confirmado el mail.
      @else 
      Ha ocurrido un error, favor de intentar nuevamente.
      @endif">
					<i class="fas fa-user-tie"></i> Mi profesor
				</button>

				<!-- boton popover empresa -->
				<button type="button" class="btn btn-lg btn-light m-3" data-toggle="popover" data-placement="bottom"
					title="Empresa" data-content="
    @if ($empresa == null)
    Aún no has seleccionado una empresa para hacer tu pasantía.
    @elseif ($empresa != null && $empresa->status == 0)
    La empresa {{$empresa->nombre}} en la que realizará su pasantía aún no ha finalizado su proceso de convenio con la Universidad.
    @elseif ($empresa != null && $empresa->status == 1)
    La empresa {{$empresa->nombre}} en la que realizará su pasantía tiene su convenio activado con la universidad
    @else 
    Ha ocurrido un error, favor de intentar nuevamente.
    @endif">
					<i class="fas fa-industry"></i> Mi empresa
				</button>

				@endif
				<!-- endif del if que permite quienes ven (admin / usuarios) -->
			</div>
		</div>
	</div>
</div>
@endsection