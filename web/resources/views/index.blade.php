@extends('layout')

@section('title', 'Inicio')

@section('contenido')
<div class="container">
  <div class="row">
    <div class="col-12">
      <div class="my-3 p-3">
        <!-- Script permitir popover en la pagina -->
        <script>
          $(function () {
            $('[data-toggle="popover"]').popover()
          })
        </script>
        <!-- botones popover -->
        <button type="button" class="btn btn-lg btn-light m-3" data-toggle="popover" data-placement="bottom" title="Pasantia" 
        data-content="Contenido pasantia"> 
        <i class="fa fa-home"></i> Mi Pasantía
        </button>
        <button type="button" class="btn btn-lg btn-light m-3" data-toggle="popover" data-placement="bottom" title="Profesor" 
        data-content="Contenido profesor"> 
        <i class="fas fa-paste"></i> Mi profesor
        </button>
        <button type="button" class="btn btn-lg btn-light m-3" data-toggle="popover" data-placement="bottom" title="Empresa" 
        data-content="Contenido empresa"> 
        <i class="fas fa-industry"></i> Mi Empresa
        </button>
      </div>
    </div>
  </div>
</div>
@endsection
