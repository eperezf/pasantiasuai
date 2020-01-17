<div class="container-fluid m-2">
	<div class="row">

		<div class="col-md-12">
			<div id="empresasEnConvenio"></div>
		</div>

	</div>
</div>




<!-- Modal Empresas Validas -->
<div class="modal fade" id="Modal_EmpresasValidas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="bodyModal_EmpresasValidas">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Empresas NO Validas -->
<div class="modal fade" id="Modal_EmpresasNoValidas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="bodyModal_EmpresasNoValidas">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>



<script>
	const tabla_empresasEnConvenio = (JSONdatosEmpresas, idTabla, idBodyModal) => {
	//Tabla HTML a desplegar
	let tablaHTMLEmpresas =
		'<table id="'+idTabla+'" class="table table-striped shadow-lg" data-show-export="true" data-pagination="true" data-click-to-select="true" data-toolbar="#toolbar" data-show-toggle="true" data-show-columns="true" data-sortable="true" data-toggle="table" data-search="true" data-live-search="true">' +
		'<thead>' +
		'<tr>' +
		'<th scope="col">id</th>'+
		'<th scope="col" data-field="#" data-sortable="true"><div class="th-inner">#</div></th>' +
		'<th scope="col" data-field="Nombre" data-sortable="true"><div class="th-inner">Nombre</div></th>' +
		'<th scope="col" data-field="URL" data-sortable="true"><div class="th-inner">URL</div></th>' +
		'</tr>' +
		'</thead>'+
		'<tbody>';
	const datosEmpresas = JSONdatosEmpresas;
	for (let i = 0; i < datosEmpresas.length; i++) {
		let datosEmpresa = datosEmpresas[i];
		tablaHTMLEmpresas += '<tr>' +
			'<td></td>' +
			'<th scope="row">'+ (i + 1) +'</th>' +
			'<td>'+ datosEmpresa['nombre'] +'</td>' +
			'<td>'+ datosEmpresa['urlWeb'] +'</td>' +
			'</tr>';
	}
	tablaHTMLEmpresas +='</tbody>' + '</table>';
	//Toolbar HTML para la tabla
	const toolbarEmpresas =
		'<div id="'+idTabla+'toolbar" class="select">'+
			'<select class="form-control">'+
				'<option value="all">Exportar todo</option>'+
				'<option value="selected">Exportar seleccionado</option>'+
			'</select>'+
		'</div>';

	//ID del BODY del modal
	let modalBodyEmpresas = document.getElementById(idBodyModal);
	//Primero toolbar, luego tabla
	modalBodyEmpresas.innerHTML += toolbarEmpresas;
	modalBodyEmpresas.innerHTML += tablaHTMLEmpresas;
	//JQuery forma de descarga de tabla y cuales columnas
	const $tablaEmpresas = $('#'+idTabla);
	$(function() {
		$('#'+idTabla+'toolbar').find('select').change(function () {
			$tablaEmpresas.bootstrapTable('destroy').bootstrapTable({
				exportDataType: $(this).val(),
				exportTypes: ['csv', 'excel', 'pdf'],
				columns: [
					{
						field: 'state',
						checkbox: true,
						visible: $(this).val() === 'selected'
					},  {
						field: '#',
						title: '#'
					}, {
						field: 'Nombre',
						title: 'Nombre'
					}, {
						field: 'URL',
						title: 'URL'
					}
				]
			})
		}).trigger('change');
	});
}
//Empresas validas
tabla_empresasEnConvenio(@json($estadisticasEmpresas['empresasValidadas']), 'g_empresasConvenio_Validas', 'bodyModal_EmpresasValidas');
//Empresas no validas
tabla_empresasEnConvenio(@json($estadisticasEmpresas['empresasNoValidadas']), 'g_empresasConvenio_Novalidas', 'bodyModal_EmpresasNoValidas');

//Pie chart de empresas
pieChartConstructor('empresasEnConvenio', 'Convenios de empresas', 'Empresas',
	//data_Attributes1
	['Empresas con convenio',
	@json($estadisticasEmpresas['empresasValidadasCount']),
	@json($estadisticasEmpresas['empresasPorcentajeValidadas']),
	'Modal_EmpresasValidas'],
	//data_Attributes2
	['Empresas sin convenio',
	@json($estadisticasEmpresas['empresasNoValidadasCount']),
	@json($estadisticasEmpresas['empresasPorcentajeNoValidadas']),
	'Modal_EmpresasNoValidas']);
</script>