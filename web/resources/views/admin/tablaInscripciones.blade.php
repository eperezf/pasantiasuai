<table class="table table-hover" id="table" data-toggle="table" data-sortable="true" data-search="true"
			data-locale="es-CL">
			<thead>
				<tr>
					<th scope="col" data-field="rut" data-sortable="true">
						<div class="th-inner">RUT</div>
					</th>
					<th scope="col" data-field="nombreAlumno" data-sortable="true">
						<div class="th-inner">Nombre alumno</div>
					</th>
					<th scope="col" data-field="fechaInicio" data-sortable="true">
						<div class="th-inner">Fecha inicio</div>
					</th>
					<th scope="col" data-field="horasSemanales" data-sortable="true">
						<div class="th-inner">Horas semanales</div>
					</th>
					<th scope="col" data-field="pais" data-sortable="true">
						<div class="th-inner">País</div>
					</th>
					<th scope="col" data-field="rolPariente">
						<div class="th-inner">Familiar</div>
					</th>
					<th scope="col" data-field="status" data-sortable="true">
						<div class="th-inner">Empresa en convenio</div>
					</th>
					<th scope="col" data-field="rubro">
						<div class="th-inner">Rubro</div>
					</th>
				</tr>
			</thead>
			<tbody>
			@foreach($pasantias as $pasantia)
				<tr>

				<!-- inicio loop informacion usuarios -->
				@foreach($usuarios as $usuario)
					@if ($pasantia->idAlumno == $usuario->idUsuario)
						<td>{{$usuario->rut}}</td>
						<td>{{$usuario->nombres}} {{$usuario->apellidoPaterno}} {{$usuario->apellidoMaterno}}</td>
					@else
					@endif
				@endforeach
				<!-- fin loop informacion usuarios -->

				<td>{{$pasantia->fechaInicio}}</td>
				<td>{{$pasantia->horasSemanales}}</td>
				<td>{{$pasantia->pais}}</td>
				@if ($pasantia->parienteEmpresa == 1)
					<td class="table-danger">{{$pasantia->rolPariente}}</td>
				@elseif ($pasantia->parienteEmpresa == 0)
					<td>Sin Pariente</td>
				@else
				@endif


					<!-- inicio loop informacion empresas -->
					@foreach($empresas as $empresa)
						@if ($pasantia->idEmpresa == $empresa->idEmpresa)
							@if ($empresa->status == 1)
								<td class="table-warning">Pendiente</td>
							@elseif ($empresa->status == 0)
								<td>Activo</td>
							@else
							@endif
							<td>{{$empresa->rubro}}</td>
						@else
						@endif
					@endforeach
					<!-- fin loop informacion empresas -->
				</tr>
				@endforeach
			</tbody>
		</table>