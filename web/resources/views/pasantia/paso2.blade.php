@extends('layout')


@section('contenido')
<div class="container-fluid">
	@include('pasantia.pasos', ['statusPaso0'=>$statusPaso0, 'statusPaso1'=>$statusPaso1, 'statusPaso2'=>$statusPaso2, 'statusPaso3'=>$statusPaso3, 'statusPaso4'=>$statusPaso4])
	<div class="row justify-content-md-center mb-1">
		<h2>Paso 2: Registro de datos</h2>
	</div>
	<div class="row justify-content-md-center mb-3">
		<p>Una vez que tu práctica esté aprobada, no podrás volver a editar estos datos.</p>
	</div>
	<div class="row justify-content-md-center mb-5">
		<div class="col-md-6">
			@if(session()->get('danger'))
			<div class="alert alert-danger">
				{{session()->get('danger')}}
			</div>
			@endif
			<form method="post" action="{{ route('inscripcion.2.post') }}">
				@csrf
				<div class="form-group">
					<label for="empresa">Empresa en la que trabajarás</label>
					<select class="form-control" id="empresa" name="empresa" @if($empresaSel->status == 2) disabled @endif>
						@foreach($empresas as $empresa)
						@if ($empresa->status === 1)
						<option value="{{$empresa->idEmpresa}}" @if($empresaSel->idEmpresa == $empresa->idEmpresa)
							selected
							@endif>
							{{$empresa->nombre}}
						</option>
						@endif
						@endforeach
					</select>
					<div class="input-group mb-3 mt-3">
						<div class="input-group-prepend">
							<div class="input-group-text">
								Mi empresa no está en la lista <input type="checkbox" id="otraEmpresa" @if($empresaSel->status == 2) checked @endif name="otraEmpresa" value="1" class="ml-2" onclick="document.getElementById('nombreOtraEmpresa').disabled = !document.getElementById('nombreOtraEmpresa').disabled; document.getElementById('empresa').disabled = !document.getElementById('empresa').disabled;">
							</div>
						</div>
						<input type="text" class="form-control" id="nombreOtraEmpresa" name="nombreOtraEmpresa" placeholder="Nombre de la empresa" @if($empresaSel->status == 2) value="{{$empresaSel->nombre}}" @else disabled @endif >
					</div>
				</div>
				<div class="form-group">
					<label for="ciudad">Ciudad en la que harás la pasantía</label>
					<input class="form-control" id="ciudad" name="ciudad" placeholder="Ciudad" @if($ciudad) value="{{$ciudad}}" @else @endif>
				</div>
				<div class="form-group">
					<label for="pais">País en la que harás la pasantía</label>
					<input class="form-control" id="pais" name="pais" placeholder="País" @if($pais) value="{{$pais}}" @else @endif>
				</div>
				<div class="form-group">
					<label for="fecha">Fecha en la que iniciarás tu pasantía</label>
					<input class="form-control" type="date" name="fecha" id="fecha" @if($fecha) value="{{$fecha}}" @else @endif>
				</div>
				<div class="form-group">
					<label for="horas">Horas semanales de trabajo</label>
					<input type="number" class="form-control" id="horas" name="horas" @if($horas) value="{{$horas}}" @else @endif min="25" max="45">
				</div>
				<div class="form-group">
					<p>Tengo un familiar que trabaja en la empresa o es socio/dueño de esta</p>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="pariente" id="parienteno" value="0" @if($pariente==0) checked @else @endif onclick="
						document.getElementById('relacionCargo').style.display = 'none';
						document.getElementById('relacionCargoSi').checked = false; 
						document.getElementById('tipoPariente').style.display = 'none';">
						<label class="form-check-label" for="parienteno">No</label>
					</div>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="pariente" id="parientesi" value="1" @if($pariente==1) checked @else @endif onclick="document.getElementById('relacionCargo').style.display = 'block';">
						<label class="form-check-label" for="parientesi">Sí</label>
					</div>
				</div>

				<div class="form-group" id="relacionCargo" style="display: none;">
					<p>¿Su pariente tendrá una relación con el cargo que usted desempeñará?</p>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="relacionCargo" id="relacionCargoNo" onclick="document.getElementById('tipoPariente').style.display = 'none';">
						<label class="form-check-label" for="relacionCargoNo">No</label>
					</div>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="relacionCargo" id="relacionCargoSi" onclick="document.getElementById('tipoPariente').style.display = 'block';">
						<label class="form-check-label" for="relacionCargoSi">Sí</label>
					</div>
				</div>

				<div class="form-group" id="tipoPariente" style="display: none;">
					<div class="card text-white bg-warning">
						<div class="card-header">
							<h4 class="text-center">¡Atención!</h4>
						</div>
						<div class="card-body">
							<h6 class="card-title text-center">Su pasantía quedará en espera hasta que sea autorizada por el administrador. Para contactarse con la administración debe enviar un correo a la gestión de pasantías de la Universidad.</h6>
							<p class="card-text text-center">mail:
								<a href="mailto:pasantias.fic@uai.cl" class="text-white">pasantias.fic@uai.cl</a></p>
						</div>
					</div>
					<div class="form-group mt-3">
						<label for="cargoPariente">Describa el cargo de su pariente respecto a usted</label>
						<input type="text" class="form-control" id="cargoPariente" name="cargoPariente" placeholder="Cargo de su pariente">
					</div>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary mt-3">Continuar</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection