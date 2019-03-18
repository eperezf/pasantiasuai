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
		<a class="btn btn-primary" href="/empresas/create" role="button">Agregar (solo admin)</a>
	</div>
	<div class="row">
		<table class="table">
		  <thead>
		    <tr>
		      <th scope="col">ID</th>
		      <th scope="col">Nombre</th>
		      <th scope="col">Rubro</th>
					<th scope="col">Estado</th>
		      <th scope="col">Sitio Web</th>
					<th scope="col">Correo de contacto</th>
					<th scope="col">Acciones</th>
		    </tr>
		  </thead>
		  <tbody>
				@foreach($empresas as $empresa)
		    <tr @if($empresa->status == 0)class="table-dark" @else @endif>
		      <th scope="row">{{$empresa->idEmpresa}}</th>
		      <td>{{$empresa->nombre}}</td>
		      <td>{{$empresa->rubro}}</td>
					<td>@if($empresa->status == 1)Activo @else Inactivo @endif</td>
		      <td><a href="http://{{$empresa->urlWeb}}">{{$empresa->urlWeb}}</a></td>
					<td><a href="mailto:{{$empresa->correoContacto}}">{{$empresa->correoContacto}}</a></td>
					<td>
						<a class="btn btn-warning" href="{{route('empresas.edit', $empresa->idEmpresa)}}" role="button">Editar</a>
						<form style="display: inline-block;" action="{{ route('empresas.destroy', $empresa->idEmpresa)}}" method="post">
              @csrf
              @method('DELETE')
              <button class="btn btn-danger" type="submit">Eliminar</button>
                </form>
					</td>
		    </tr>
				@endforeach
		  </tbody>
		</table>
	</div>
</div>
@endsection
