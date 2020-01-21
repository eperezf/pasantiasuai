<div class="container-fluid m-2">
	<div class="row">

		<div class="col-md-6">
			<div id="proyectosValidados"></div>
		</div>

		<div class="col-md-6">
			<div id="proyectosInscritos"></div>
		</div>
		<div class="col-md-6">
			<div id="inscripcionesTerminadas"></div>
		</div>

	</div>
</div>



<!-- Modal Proyectos Aprobados -->
<div class="modal fade" id="Modal_proyectosAprobados" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="bodyModal_proyectosAprobados">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Proyectos No Aprobados-->
<div class="modal fade" id="Modal_proyectosNoAprobados" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="bodyModal_proyectosNoAprobados">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Proyectos Inscritos-->
<div class="modal fade" id="Modal_proyectosInscritos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="bodyModal_proyectosInscritos">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Proyectos No Inscritos-->
<div class="modal fade" id="Modal_proyectosNoInscritos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="bodyModal_proyectosNoInscritos">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<script>
//Proyectos Aprobados
tabla_detalleAlumnos(@json($estadisticasProyectos['alumnosProyectosAprobados']), 'g_proyectosAprobados', 'bodyModal_proyectosAprobados');
//Proyectos NO Aprobados
tabla_detalleAlumnos(@json($estadisticasProyectos['alumnosProyectosAprobados']), 'g_proyectosNoAprobados', 'bodyModal_proyectosNoAprobados');

//Proyectos Inscritos
tabla_detalleAlumnos(@json($estadisticasProyectos['alumnosProyectosInscritos']), 'g_proyectosInscritos', 'bodyModal_proyectosInscritos');
//Proyectos NO inscritos
tabla_detalleAlumnos(@json($estadisticasProyectos['alumnosProyectosNOInscritos']), 'g_proyectosNoInscritos', 'bodyModal_proyectosNoInscritos');


//Pie chart de proyectos validados vs no validados
pieChartConstructor('proyectosValidados', 'Estado de los proyectos', 'Proyectos',
	//data_Attributes1
	['Proyectos validados',
	@json($estadisticasProyectos['proyectosAprobadosCount']),
	@json($estadisticasProyectos['proyectosAprobadosPorcentaje']),
	'Modal_proyectosAprobados'],
	//data_Attributes2
	['Proyectos no validados',
	@json($estadisticasProyectos['proyectosNoAprobadosCount']),
	@json($estadisticasProyectos['proyectosNoAprobadosPorcentaje']),
	'Modal_proyectosNoAprobados']);

//Pie chart de proyectos inscritos vs no inscritos
pieChartConstructor('proyectosInscritos', 'Inscripciones de proyectos', 'Inscripciones',
	//data_Attributes1
	['Proyectos inscritos',
	@json($estadisticasProyectos['proyectosInscritosCount']),
	@json($estadisticasProyectos['proyectosInscritosPorcentaje']),
	'Modal_proyectosInscritos'],
	//data_Attributes2
	['Proyectos no inscritos',
	@json($estadisticasProyectos['proyectosNOInscritosCount']),
	@json($estadisticasProyectos['proyectosNoInscritosPorcentaje']),
	'Modal_proyectosNoInscritos']);
</script>