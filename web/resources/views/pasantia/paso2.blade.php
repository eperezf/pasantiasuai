@extends('layout')


@section('contenido')
<div class="container-fluid">
	<div class="row">
		<nav aria-label="breadcrumb">
		  <ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="/inscripcion/0">Paso 0</a></li>
				<li class="breadcrumb-item"><a href="/inscripcion/1">Paso 1</a></li>
				<li class="breadcrumb-item active" aria-current="page">Paso 2</li>
				<li class="breadcrumb-item"><a href="#">Paso 3</a></li>
				<li class="breadcrumb-item"><a href="#">Paso 4</a></li>
		  </ol>
		</nav>
	</div>
	<div class="row justify-content-md-center mb-5">
		<h2>Paso 2: Registro de datos</h2>
	</div>
	<div class="row justify-content-md-center mb-5">
		<div class="col-md-6">
			<form method="post" action="{{ route('inscripcion.2.post') }}">
				@csrf
				<div class="form-group">
			    <label for="empresa">Empresa en la que trabajarás</label>
			    <select class="form-control" id="empresa" name="empresa">
			      <option>Empresa A</option>
			      <option>Empresa B</option>
			      <option>Empresa C</option>
			      <option>Empresa D</option>
			      <option>Empresa E</option>
			    </select>
			  </div>
				<div class="form-group">
			    <label for="ciudad">Ciudad en la que harás la pasantía</label>
			    <input class="form-control" id="ciudad" name="ciudad" placeholder="Ciudad">
			  </div>
				<div class="form-group">
			    <label for="pais">País en la que harás la pasantía</label>
			    <input class="form-control" id="pais" name="pais" placeholder="País" required>
			  </div>
				<div class="form-group">
					<label for="fecha">Fecha en la que iniciarás tu pasantía</label>
					<input class="form-control" type="date" name="fecha" id="fecha" required>
				</div>
				<div class="form-group">
			    <label for="horas">Horas semanales de trabajo</label>
			    <input type="number" class="form-control" id="horas" name="horas" required>
			  </div>
				<p>Tengo un familiar que trabaja en a empresa o es socio/dueño de esta</p>
				<div class="form-check form-check-inline">
				  <input class="form-check-input" type="radio" name="pariente" id="parienteno" value="0" checked>
				  <label class="form-check-label" for="parienteno">No</label>
				</div>
				<div class="form-check form-check-inline">

				  <input class="form-check-input" type="radio" name="pariente" id="parientesi" value="1">
				  <label class="form-check-label" for="parientesi">Sí</label>
				</div>
				</br>
				<button type="submit" class="btn btn-primary mt-3">Continuar</button>
			</form>
		</div>
	</div>
</div>
@endsection
