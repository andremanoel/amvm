$(document).ready(function(){
	
	if( $('#grafico-mais-ocorrencias').length && dataGrafico != '') {
		
		Highcharts.chart('grafico-mais-ocorrencias', {
			chart: {
				type: 'column'
			},
			xAxis: {
				type: 'category'
			},
			title: {
		        text: 'Total por Bairro'
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
	
});