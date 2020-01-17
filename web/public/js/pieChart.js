/*
chart_RenderTo -> id del elemento en donde se mostrara este grafico STRING
title_Text -> titulo del grafico STRING
series_Name -> nombre general de los datos STRING
data_Attributes1 -> [nombre, valorNumerico, valorPorcentaje, NOMBRE MODAL] STRING, INT, FLOAT, STRING
data_Attributes2 -> [nombre, valorNumerico, valorPorcentaje, NOMBRE MODAL] STRING, INT, FLOAT, STRING
*/
const pieChartConstructor = (
	chart_RenderTo,
	title_Text,
	series_Name,
	data_Attributes1,
	data_Attributes2
) => {
	//Grafico de torta genérico
	window.chart = new Highcharts.chart({
		chart: {
			//tipo
			type: "pie",
			//donde ubicar
			renderTo: chart_RenderTo,
			//tamaño
			height: (9 / 16) * 100 + "%",
			plotBackgroundColor: null,
			plotBorderWidth: null,
			plotShadow: false
		},
		title: {
			//titulo
			text: title_Text,
			//estilos
			style: {
				fontSize: "22px"
			}
		},
		//lo que muestra al hover
		tooltip: {
			pointFormat: "{series.name}: <b>{point.percentage:.1f}%</b>"
		},
		//descarga habilitada
		exporting: {
			enabled: true,
			csv: {
				//fecha
				dateFormat: "%A, %b %e, %Y"
			}
		},
		//no usar creditos en el grafico
		credits: {
			enabled: false
		},
		//opciones del grafico
		plotOptions: {
			pie: {
				allowPointSelect: true,
				dataLabels: {
					enabled: true,
					format: "<b>{point.name}</b>: {point.y} ({point.percentage:.1f}%)",
					style: {
						color:
							(Highcharts.theme && Highcharts.theme.contrastTextColor) ||
							"black",
						fontSize: "1em"
					}
				}
			},
			series: {
				cursor: "pointer",
				point: {
					events: {
						click: function(e) {
							//Que hacer al clickear una parte de la torta
							$("#" + this.modal_ID).modal("toggle");
						}
					}
				}
			}
		},
		//todos los datos del grafico
		series: [
			{
				name: series_Name,
				colorByPoint: true,
				data: [
					{
						name: data_Attributes1[0],
						y: data_Attributes1[1],
						value: data_Attributes1[2],
						modal_ID: data_Attributes1[3],
						sliced: true,
						selected: true
					},
					{
						name: data_Attributes2[0],
						y: data_Attributes2[1],
						value: data_Attributes2[2],
						modal_ID: data_Attributes2[3]
					}
				]
			}
		]
	});
};
