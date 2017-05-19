$(document).ready(function(){
	
	//verifica se tem o grafico de mais ocorrencias para renderizar o HighCharts
	if( $('#grafico-mais-ocorrencias').length ) {
		
		Highcharts.chart('grafico-mais-ocorrencias', {
			chart: {
				type: 'column'
			},
			title: {
				text: 'Bairros com maior incidência de crimes'
			},
			subtitle: {
				text: 'Clique para ver o detalhamento dos crimes'
			},
			xAxis: {
				type: 'category'
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
				name: 'Total de Crimes',
				colorByPoint: true,
				data: [{
					name: 'Vila Embratel',
					y: 58
				}, {
					name: 'Cidade Olímpica',
					y: 50
				}, {
					name: 'Coroadinho',
					y: 47
				}, {
					name: 'Cidade Operária',
					y: 45
				}, {
					name: 'Olho dagua',
					y: 42
				}, {
					name: 'Turú',
					y: 32
				}, {
					name: 'Bairro de Fátima',
					y: 31
				}, {
					name: 'Centro',
					y: 30
				}, {
					name: 'Maracanã',
					y: 28
				}]
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
		        name: 'Feminino',
		        data: [7, 6, 9, 14, 18, 21, 25, 26, 23, 18, 13, 9]
		    }, {
		        name: 'Masculino',
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
		        text: 'Quantidade de crimes por dia da semana'
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
		    series: [{
		        name: 'Arma de Fogo',
		        data: [49, 71, 106, 129, 144, 176, 135]
	
		    }, {
		        name: 'Arma Branca',
		        data: [83, 78, 98, 93, 106, 84, 105]
	
		    }, {
		        name: 'Espancamento',
		        data: [48, 38, 39, 41, 47, 48, 59, 52]
	
		    }, {
		        name: 'Estrangulamento',
		        data: [42, 33, 34, 39, 52, 75, 57]
		    }, {
		        name: 'Lesão Corporal',
		        data: [53, 31, 42, 10, 100, 33, 43]
		    }, {
		        name: 'CVLI',
		        data: [32, 54, 31, 28, 45, 73, 41]
		    }]
		});
	}
	
	//verifica se tem o grafico horarios por dia para renderizar o HighCharts
	if( $('#grafico-horarios-dia').length ) {
		Highcharts.chart('grafico-horarios-dia', {
		    chart: {
		        type: 'column'
		    },
		    title: {
		        text: 'Quantidade de crimes por horário do dia'
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
		    series: [{
		        name: 'Arma de Fogo',
		        data: [49, 71, 106, 129]
	
		    }, {
		        name: 'Arma Branca',
		        data: [83, 78, 98, 93]
	
		    }, {
		        name: 'Espancamento',
		        data: [48, 38, 39, 41]
	
		    }, {
		        name: 'Estrangulamento',
		        data: [42, 33, 34, 39]
		    }, {
		        name: 'Lesão Corporal',
		        data: [53, 31, 42, 10]
		    }, {
		        name: 'CVLI',
		        data: [32, 54, 31, 28]
		    }]
		});
	}
	
	//verifica se tem o grafico mês para renderizar o HighCharts
	if( $('#grafico-ocorrencia-mes').length ) {
		Highcharts.chart('grafico-ocorrencia-mes', {
		    chart: {
		        type: 'column'
		    },
		    title: {
		        text: 'Quantidade de crimes por mês'
		    },
		    xAxis: {
		        categories: [
                 	'JAN',
		            'FEV',
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
		        crosshair: true
		    },
		    yAxis: {
		        min: 0,
		        title: {
		            text: 'Quantidade de ocorrências'
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
		    series: [{
		        name: 'Arma de Fogo',
		        data: [49, 71, 106, 129, 49, 71, 106, 129, 49, 71, 106, 129]
	
		    }, {
		        name: 'Arma Branca',
		        data: [83, 78, 98, 93, 83, 78, 98, 93, 83, 78, 98, 93]
	
		    }, {
		        name: 'Espancamento',
		        data: [48, 38, 39, 41, 48, 38, 39, 41, 48, 38, 39, 41]
	
		    }, {
		        name: 'Estrangulamento',
		        data: [42, 33, 34, 39, 42, 33, 34, 39, 42, 33, 34, 39]
		    }, {
		        name: 'Lesão Corporal',
		        data: [53, 31, 42, 10, 53, 31, 42, 10, 53, 31, 42, 10]
		    }, {
		        name: 'CVLI',
		        data: [32, 54, 31, 28, 32, 54, 31, 28, 32, 54, 31, 28]
		    }]
		});
	}
	
	//verifica se tem o grafico mês TOTAL para renderizar o HighCharts
	if( $('#grafico-ocorrencia-mes-total').length ) {
		Highcharts.chart('grafico-ocorrencia-mes-total', {
		    chart: {
		        type: 'column'
		    },
		    title: {
		        text: 'Total de Crimes por mês'
		    },
		    xAxis: {
		    	categories: [
                  	'JAN',
 		            'FEV',
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
		            text: 'Total de ocorrências'
		        },
		        stackLabels: {
		            enabled: true,
		            style: {
		                fontWeight: 'bold',
		                color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
		            }
		        }
		    },
		    legend: {
		        backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
		        borderColor: '#CCC',
		        borderWidth: 1,
		        shadow: false
		    },
		    tooltip: {
		        headerFormat: '<b>{point.x}</b><br/>',
		        pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
		    },
		    plotOptions: {
		        column: {
		            stacking: 'normal',
		            dataLabels: {
		                enabled: true,
		                color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
		            }
		        }
		    },
		    series: [{
		        name: 'Arma de Fogo',
		        data: [49, 71, 106, 129, 49, 71, 106, 129, 49, 71, 106, 129]
	
		    }, {
		        name: 'Arma Branca',
		        data: [83, 78, 98, 93, 83, 78, 98, 93, 83, 78, 98, 93]
	
		    }, {
		        name: 'Espancamento',
		        data: [48, 38, 39, 41, 48, 38, 39, 41, 48, 38, 39, 41]
	
		    }, {
		        name: 'Estrangulamento',
		        data: [42, 33, 34, 39, 42, 33, 34, 39, 42, 33, 34, 39]
		    }, {
		        name: 'Lesão Corporal',
		        data: [53, 31, 42, 10, 53, 31, 42, 10, 53, 31, 42, 10]
		    }, {
		        name: 'CVLI',
		        data: [32, 54, 31, 28, 32, 54, 31, 28, 32, 54, 31, 28]
		    }]
		});
	}
	
	//grafico-idade-12-18
	if( $('#grafico-idade-12-18').length ) {
		Highcharts.chart('grafico-idade-12-18', {
		    chart: {
		        type: 'line'
		    },
		    title: {
		        text: 'Índice de Violência no Maranhão por idade'
		    },
		    subtitle: {
		        text: 'Tipos de crimes'
		    },
		    xAxis: {
		        categories: ['Arma de Fogo', 'Arma Branca', 'Espancamento', 'Estrangulamento', 'Lesão Corporal', 'CVLI']
		    },
		    yAxis: {
		        title: {
		            text: 'Quantidade Crimes'
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
		        name: 'Idade - 12 a 18 anos',
		        data: [7, 6, 9, 14, 18, 12]
		    }]
		});
	}
	
	//grafico-idade-19-29
	if( $('#grafico-idade-19-29').length ) {
		Highcharts.chart('grafico-idade-19-29', {
		    chart: {
		        type: 'line'
		    },
		    title: {
		        text: 'Índice de Violência no Maranhão por idade'
		    },
		    subtitle: {
		        text: 'Tipos de crimes'
		    },
		    xAxis: {
		        categories: ['Arma de Fogo', 'Arma Branca', 'Espancamento', 'Estrangulamento', 'Lesão Corporal', 'CVLI']
		    },
		    yAxis: {
		        title: {
		            text: 'Quantidade Crimes'
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
		        name: 'Idade - 19 a 29 anos',
		        data: [12, 14, 10, 9, 30, 25]
		    }]
		});
	}
	
	//grafico-idade-30-40
	if( $('#grafico-idade-30-40').length ) {
		Highcharts.chart('grafico-idade-30-40', {
		    chart: {
		        type: 'line'
		    },
		    title: {
		        text: 'Índice de Violência no Maranhão por idade'
		    },
		    subtitle: {
		        text: 'Tipos de crimes'
		    },
		    xAxis: {
		        categories: ['Arma de Fogo', 'Arma Branca', 'Espancamento', 'Estrangulamento', 'Lesão Corporal', 'CVLI']
		    },
		    yAxis: {
		        title: {
		            text: 'Quantidade Crimes'
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
		        name: 'Idade - 30 a 40 anos',
		        data: [8, 5, 13, 17, 20, 18]
		    }]
		});
	}
	
	//grafico-idade-41-50
	if( $('#grafico-idade-41-50').length ) {
		Highcharts.chart('grafico-idade-41-50', {
		    chart: {
		        type: 'line'
		    },
		    title: {
		        text: 'Índice de Violência no Maranhão por idade'
		    },
		    subtitle: {
		        text: 'Tipos de crimes'
		    },
		    xAxis: {
		        categories: ['Arma de Fogo', 'Arma Branca', 'Espancamento', 'Estrangulamento', 'Lesão Corporal', 'CVLI']
		    },
		    yAxis: {
		        title: {
		            text: 'Quantidade Crimes'
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
		        name: 'Idade - 41 a 50 anos',
		        data: [21, 12, 18, 17, 13, 25]
		    }]
		});
	}
	
	//grafico-mulher-idade
	if( $('#grafico-mulher-idade').length ) {
		Highcharts.chart('grafico-mulher-idade', {
		    chart: {
		        type: 'line'
		    },
		    title: {
		        text: 'Índice de Violência no Maranhão por idade da mulher'
		    },
		    subtitle: {
		        text: 'Tipos de crimes'
		    },
		    xAxis: {
		        categories: ['Arma de Fogo', 'Arma Branca', 'Espancamento', 'Estrangulamento', 'Lesão Corporal', 'CVLI']
		    },
		    yAxis: {
		        title: {
		            text: 'Quantidade Crimes'
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
		        name: 'Idade - 12 a 18 anos',
		        data: [7, 6, 9, 14, 18, 12]
		    }, {
		        name: 'Idade - 19 a 29 anos',
		        data: [12, 14, 10, 9, 30, 25]
		    }, {
		        name: 'Idade - 30 a 40 anos',
		        data: [8, 5, 13, 17, 20, 18]
		    }, {
		        name: 'Idade - 41 a 50 anos',
		        data: [21, 12, 18, 17, 13, 25]
		    }]
		});
	}
	
});
/*
 * Arma de Fogo
 * Arma Branca
 * Espancamento
 * Estrangulamento
 * Lesão Corporal
 * CVLI
 */