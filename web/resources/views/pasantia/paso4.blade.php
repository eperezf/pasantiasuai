@extends('layout')

@section('contenido')
<div class="container-fluid">
	@if(session()->get('error'))
    <div class="alert alert-danger">
      {{ session()->get('error') }}
    </div><br />
  @endif
	<div class="row">
		<nav aria-label="breadcrumb">
		  <ol class="breadcrumb">
		    <li class="breadcrumb-item"><a href="#">Paso 0</a></li>
				<li class="breadcrumb-item"><a href="#">Paso 1</a></li>
				<li class="breadcrumb-item"><a href="#">Paso 2</a></li>
				<li class="breadcrumb-item"><a href="#">Paso 3</a></li>
				<li class="breadcrumb-item active" aria-current="page">Paso 4</li>
		  </ol>
		</nav>
	</div>
	<div class="row justify-content-md-center mb-5">
		<h2>Paso 4: Proyecto</h2>
	</div>
	<div class="row justify-content-md-center mb-5">
		<form method="post" action="{{ route('inscripcion.4.post') }}" class="text-center">
			@csrf
			<div class="form-group">
		    <label for="nombre">Nombre</label>
		    <input class="form-control" id="nombre" name="nombre" placeholder="Nombre del proyecto">
		  </div>
			<div class="form-group">
		    <label for="nombre">Area</label>
		    <input class="form-control" id="area" name="area" placeholder="Area del proyecto">
		  </div>
			<div class="form-group">
		    <label for="problematica">Problemática</label>
		    <textarea class="form-control" id="problematica" name="problematica" rows="3" placeholder="Problemática del proyecto"></textarea>
		  </div>
			<div class="form-group">
		    <label for="vision">Visión</label>
		    <textarea class="form-control" id="vision" name="vision" rows="5" placeholder="Vision del proyecto"></textarea>
		  </div>
			<button type="submit" class="btn btn-primary">Continuar</button>
		</form>
	</div>
</div>
@endsection
