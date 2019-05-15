@extends('layout')

@section('title', 'Listado de empresas')

@section('contenido')
<div class="container">
	@if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}
    </div><br />
  @endif
	<div class="row">
		<h1>Listado de empresas</h1>
	</div>
	<div class="row">
		<p>
			Aquí puedes ver un listado de las empresas que tienen un convenio vigente con la universidad.
		</p>
	</div>
	<div class="row">
		@if(Auth::user()->rol >= 4)
			<a class="btn btn-primary mb-3" href="/empresas/create" role="button">Agregar (solo admin)</a>
		@endif
	</div>
	<div class="row">
		<div class="table-responsive">
			<table class="table">
			  <thead>
			    <tr>
			      <th scope="col">ID</th>
			      <th scope="col">Nombre</th>
			      <th scope="col">Rubro</th>
						<th scope="col">Estado</th>
			      <th scope="col">Sitio Web</th>
						<th scope="col">Correo de contacto</th>
						@if(Auth::user()->rol >= 4)<th scope="col">Acciones</th>@endif
			    </tr>
			  </thead>
			  <tbody>
					@foreach($empresas as $empresa)
			    <tr @if($empresa->status == 0)class="table-dark" @else @endif>
			      <th scope="row">{{$empresa->idEmpresa}}</th>
			      <td>{{$empresa->nombre}}</td>
			      <td>{{$empresa->rubro}}</td>
						<td>@if($empresa->status == 1)Activo @else Inactivo @endif</td>
			      <td><a href="{{$empresa->urlWeb}}">{{$empresa->urlWeb}}</a></td>
						<td><a href="mailto:{{$empresa->correoContacto}}">{{$empresa->correoContacto}}</a></td>
						@if(Auth::user()->rol >= 4)
						<td>
							<a class="btn btn-warning" href="{{route('empresas.edit', $empresa->idEmpresa)}}" role="button">Editar</a>
							<form style="display: inline-block;" action="{{ route('empresas.destroy', $empresa->idEmpresa)}}" method="post">
	              @csrf
	              @method('DELETE')
	              <button class="btn btn-danger" type="submit">Eliminar</button>
	                </form>
						</td>
						@endif
			    </tr>
					@endforeach
			  </tbody>
			</table>
		</div>
	</div>
</div>
@endsection
