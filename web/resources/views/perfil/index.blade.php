@extends('layout')

@section('title', 'Informacion Usuario')

@section('contenido')
<div class="container">
	@if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}
    </div><br />
  @endif
  <link rel="stylesheet" href="../css/profile.css">


  <div class="container container-profile">
  <form>
    <div class="row">
      <div class="col-md-4">
        <div class="profile-img">
          <img src="https://x1.xingassets.com/assets/frontend_minified/img/users/nobody_m.original.jpg" alt="" />
          <div class="file btn btn-lg btn-primary">
            Cambiar Foto
            <input type="file" name="file" />
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="profile-head">
          <h5>
            {{ $perfil->nombres }}
            {{ $perfil->apellidoPaterno }}
            {{ $perfil->apellidoMaterno }}
          </h5>
          <h6>
            {{ $perfil->idCarrera }}
          </h6>
          <p class="profile-rut">RUT : <span>
              {{ $perfil->rut }}
            </span></p>
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="home-tab" data-toggle="tab" href="#datos" role="tab" aria-controls="datos" aria-selected="true">Mis Datos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="profile-tab" data-toggle="tab" href="#status" role="tab" aria-controls="status" aria-selected="false">Mi Status</a>
            </li>
          </ul>
        </div>
      </div>

    </div>
    <div class="row">
      <div class="col-md-4">
        <div class="list-group">
          <a href="#" class="list-group-item list-group-item-action">Editar perfil</a>
          <a href="{{route('inscripcion.resumen')}}" class="list-group-item list-group-item-action">Mi pasantía</a>
        	<a href="#" class="list-group-item list-group-item-action">Mi profesor</a>
        </div>
      </div>




        <!-- INICIO PERFIL -->
      <div class="col-md-8">
        <div class="tab-content profile-tab" id="myTabContent">
          <div class="tab-pane fade show active" id="datos" role="tabpanel" aria-labelledby="home-tab">
            <div class="row">
              <div class="col-md-6">
                <label>Nombre</label>
              </div>
              <div class="col-md-6">
                <p>
                  {{ $perfil->nombres }}
                </p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <label>Apellidos</label>
              </div>
              <div class="col-md-6">
                <p>
                  {{ $perfil->apellidoPaterno }}
                  {{ $perfil->apellidoMaterno }}
                </p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <label>Email</label>
              </div>
              <div class="col-md-6">
                <p>
                  {{ $perfil->email }}
                </p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <label>Carrera</label>
              </div>
              <div class="col-md-6">
                <p>
                  {{ $perfil->idCarrera }}
                </p>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="status" role="tabpanel" aria-labelledby="profile-tab">
            <div class="row">
              <div class="col-md-6">
                <label>Rol</label>
              </div>
              <div class="col-md-6">
                <p>
                  {{ $perfil->rol }}
                </p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <label>Status Pregrado</label>
              </div>
              <div class="col-md-6">
                <p>
                  {{ $perfil->statusPregrado }}
                </p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <label>Status Omega</label>
              </div>
              <div class="col-md-6">
                <p>
                  {{ $perfil->statusOmega }}
                </p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <label>Status Webcursos</label>
              </div>
              <div class="col-md-6">
                <p>
                  {{ $perfil->statusWebcursos }}
                </p>
              </div>
            </div>


          </div>
        </div>
      </div>
      <!-- FIN PERFIL -->

    </div>
  </form>
</div>
@endsection
