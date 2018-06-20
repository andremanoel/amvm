$(document).ready(function(){
	
	$(".chosen-select").chosen({no_results_text: "Nenhum registro encontrado!"});
	
	if( $('#grafico-mais-ocorrencias').length && dataGrafico != '') {
		
		Highcharts.chart('grafico-mais-ocorrencias', {
			chart: {
				type: 'column'
			},
			xAxis: {
				type: 'category'
			},
			title: {
		        text: tituloGrafico
		    },
			yAxis: {
				title: {
					text: 'Total de crimes'
				}
			
			},
			legend: {
				enabled: false
			},
			plotOptions: {
				series: {
					borderWidth: 0,
					dataLabels: {
						enabled: true,
						format: '{point.y}'
					}
				}
			},
			tooltip: {
				headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
				pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b><br/>'
			},
			series: [{
				name: 'Total',
				colorByPoint: true,
				data: dataGrafico
			}]
		});
	}
	
	//verifica se tem o grafico de mais ocorrencias para renderizar o HighCharts
	if( $('#grafico-tipos-crime').length ) {
		Highcharts.chart('grafico-tipos-crime', {
		    chart: {
		        type: 'column'
		    },
		    title: {
		        text: 'Índice de Violência no Maranhão - CVLI'
		    },
		    subtitle: {
		        text: 'Mensal'
		    },
		    xAxis: {
		        categories: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez']
		    },
		    yAxis: {
		        title: {
		            text: 'Quantidade'
		        }
		    },
		    plotOptions: {
		        line: {
		            dataLabels: {
		                enabled: true
		            },
		            enableMouseTracking: false
		        }
		    },
		    series: [{
		        name: 'Total de Crimes',
		        data: [20, 10, 6, 10, 12, 13, 30, 19, 15, 10, 12, 3]
		    }]
		});
	}
	
	//verifica se tem o grafico de mais ocorrencias para renderizar o HighCharts
	if( $('#grafico-quantidade-dias-semana').length ) {
		Highcharts.chart('grafico-quantidade-dias-semana', {
		    chart: {
		        type: 'column'
		    },
		    title: {
		        text: 'Total por dia da semana'
		    },
		    xAxis: {
		        categories: [
                 	'Domingo',
		            'Segunda',
		            'Terça',
		            'Quarta',
		            'Quinta',
		            'Sexta',
		            'Sábado'
		        ],
		        crosshair: true
		    },
		    yAxis: {
		        min: 0,
		        title: {
		            text: 'Quantidade'
		        }
		    },
		    tooltip: {
		        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
		        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
		            '<td style="padding:0"><b>{point.y}</b></td></tr>',
		        footerFormat: '</table>',
		        shared: true,
		        useHTML: true
		    },
		    plotOptions: {
		        column: {
		            pointPadding: 0.2,
		            borderWidth: 0
		        }
		    },
		    series: dataGrafico
		});
	}
	
	//verifica se tem o grafico horarios por dia para renderizar o HighCharts
	if( $('#grafico-horarios-dia').length ) {
		Highcharts.chart('grafico-horarios-dia', {
		    chart: {
		        type: 'column'
		    },
		    title: {
		        text: 'Quantidade de ocorrências por horário do dia'
		    },
		    xAxis: {
		        categories: [
                 	'0h às 6h',
		            '6h às 12h',
		            '12h às 18h',
		            '18h às 24h',
		        ],
		        crosshair: true
		    },
		    yAxis: {
		        min: 0,
		        title: {
		            text: 'Quantidade'
		        }
		    },
		    tooltip: {
		        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
		        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
		            '<td style="padding:0"><b>{point.y}</b></td></tr>',
		        footerFormat: '</table>',
		        shared: true,
		        useHTML: true
		    },
		    plotOptions: {
		        column: {
		            pointPadding: 0.2,
		            borderWidth: 0
		        }
		    },
		    series: dataGrafico
		});
	}
	
	//verifica se tem o grafico mês TOTAL para renderizar o HighCharts
	if( $('#grafico-ocorrencia-mes').length ) {
		Highcharts.chart('grafico-ocorrencia-mes', {
		    chart: {
		        type: 'column'
		    },
		    title: {
		        text: 'Total de Ocorrências por mês'
		    },
		    xAxis: {
		    	categories: [
                  	'JAN',
 		            'FEV',
 		            'MAR',
 		            'ABR',
 		            'MAI',
 		            'JUN',
 		            'JUL',
 		            'AGO',
 		            'SET',
 		            'OUT',
 		            'NOV',
 		            'DEZ'
 		        ],
		    },
		    yAxis: {
		        min: 0,
		        title: {
		            text: 'Quantidade'
		        }
		    },
		    tooltip: {
		        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
		        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
		            '<td style="padding:0"><b>{point.y}</b></td></tr>',
		        footerFormat: '</table>',
		        shared: true,
		        useHTML: true
		    },
		    plotOptions: {
		        column: {
		            pointPadding: 0.2,
		            borderWidth: 0
		        }
		    },
		    series: dataGrafico
		});
	}
	
	
	//grafico-mulher-idade
	if( $('#grafico-mulher-idade').length ) {
		Highcharts.chart('grafico-mulher-idade', {
		    chart: {
		        type: 'column'
		    },
		    title: {
		        text: 'Ocorrências por Idade'
		    },
		    xAxis: {
		        categories: [
                     '12 a 18', 
                     '19 a 29', 
                     '30 a 40', 
                     '41 a 50', 
                     '51 a 80' 
                 ]
		    },
		    yAxis: {
		        min: 0,
		        title: {
		            text: 'Quantidade'
		        }
		    },
		    tooltip: {
		        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
		        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
		            '<td style="padding:0"><b>{point.y}</b></td></tr>',
		        footerFormat: '</table>',
		        shared: true,
		        useHTML: true
		    },
		    plotOptions: {
		        column: {
		            pointPadding: 0.2,
		            borderWidth: 0
		        }
		    },
		    series: dataGrafico
		});
	}
	
	// GRAFICO DE LINHA SIMPLES
	if( $('#grafico1linha').length) {
		Highcharts.chart('grafico1linha', {
		    title: {
		        text: tituloGrafico
		    },
		    yAxis: {
		        title: {
		            text: tituloY
		        }
		    },
		    legend: {
		        layout: 'vertical',
		        align: 'right',
		        verticalAlign: 'middle'
		    },
	
		    plotOptions: {
		        series: {
		            label: {
		                connectorAllowed: false
		            },
		            pointStart: 2010
		        }
		    },
	
		    series: dataGraficoLinha,
	
		    responsive: {
		        rules: [{
		            condition: {
		                maxWidth: 500
		            },
		            chartOptions: {
		                legend: {
		                    layout: 'horizontal',
		                    align: 'center',
		                    verticalAlign: 'bottom'
		                }
		            }
		        }]
		    }
	
		});
	}
	
	// GRAFICO DE AREA SIMPLES
	if( $('#graficoareasimples').length) {
		Highcharts.chart('graficoareasimples', {
		    chart: {
		        type: 'area'
		    },
		    title: {
		        text: 'US and USSR nuclear stockpiles'
		    },
		    subtitle: {
		        text: 'Sources: <a href="https://thebulletin.org/2006/july/global-nuclear-stockpiles-1945-2006">' +
		            'thebulletin.org</a> &amp; <a href="https://www.armscontrol.org/factsheets/Nuclearweaponswhohaswhat">' +
		            'armscontrol.org</a>'
		    },
		    xAxis: {
		        allowDecimals: false,
		        labels: {
		            formatter: function () {
		                return this.value; // clean, unformatted number for year
		            }
		        }
		    },
		    yAxis: {
		        title: {
		            text: 'Nuclear weapon states'
		        },
		        labels: {
		            formatter: function () {
		                return this.value / 1000 + 'k';
		            }
		        }
		    },
		    tooltip: {
		        pointFormat: '{series.name} had stockpiled <b>{point.y:,.0f}</b><br/>warheads in {point.x}'
		    },
		    plotOptions: {
		        area: {
		            pointStart: 1940,
		            marker: {
		                enabled: false,
		                symbol: 'circle',
		                radius: 2,
		                states: {
		                    hover: {
		                        enabled: true
		                    }
		                }
		            }
		        }
		    },
		    series: [{
		        name: 'USA',
		        data: [
		            null, null, null, null, null, 6, 11, 32, 110, 235,
		            369, 640, 1005, 1436, 2063, 3057, 4618, 6444, 9822, 15468,
		            20434, 24126, 27387, 29459, 31056, 31982, 32040, 31233, 29224, 27342,
		            26662, 26956, 27912, 28999, 28965, 27826, 25579, 25722, 24826, 24605,
		            24304, 23464, 23708, 24099, 24357, 24237, 24401, 24344, 23586, 22380,
		            21004, 17287, 14747, 13076, 12555, 12144, 11009, 10950, 10871, 10824,
		            10577, 10527, 10475, 10421, 10358, 10295, 10104, 9914, 9620, 9326,
		            5113, 5113, 4954, 4804, 4761, 4717, 4368, 4018
		        ]
		    }, {
		        name: 'USSR/Russia',
		        data: [null, null, null, null, null, null, null, null, null, null,
		            5, 25, 50, 120, 150, 200, 426, 660, 869, 1060,
		            1605, 2471, 3322, 4238, 5221, 6129, 7089, 8339, 9399, 10538,
		            11643, 13092, 14478, 15915, 17385, 19055, 21205, 23044, 25393, 27935,
		            30062, 32049, 33952, 35804, 37431, 39197, 45000, 43000, 41000, 39000,
		            37000, 35000, 33000, 31000, 29000, 27000, 25000, 24000, 23000, 22000,
		            21000, 20000, 19000, 18000, 18000, 17000, 16000, 15537, 14162, 12787,
		            12600, 11400, 5500, 4512, 4502, 4502, 4500, 4500
		        ]
		    }]
		});
	}
	
	// GRAFICO PIZZA SIMPLES

	// Build the chart
	if( $('#graficopizzasimples').length) {
		Highcharts.chart('graficopizzasimples', {
		    chart: {
		        plotBackgroundColor: null,
		        plotBorderWidth: null,
		        plotShadow: false,
		        type: 'pie'
		    },
		    title: {
		        text: tituloGrafico
		    },
		    tooltip: {
		        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
		    },
		    plotOptions: {
		        pie: {
		            allowPointSelect: true,
		            cursor: 'pointer',
		            dataLabels: {
		                enabled: false
		            },
		            showInLegend: true
		        }
		    },
		    
		    series: [{
		        name: tituloSeries,
		        //colorByPoint: true,
		        data: dataGraficoPizza
		    }]
		});
	}
	
});