<?php

class IndicadoresController extends Zend_Controller_Action
{

    public function init()
    {
        parent::init();
        
        // libs js
        $this->view->headScript()->appendFile('/assets/js/Highcharts-5.0.7/code/highcharts.js');
        $this->view->headScript()->appendFile('/assets/js/Highcharts-5.0.7/code/highcharts-more.js');
        $this->view->headScript()->appendFile('/assets/js/graficos.js');
        
        $filtros = array();
        
        // anos
        $arrAnos = array(
            '' => 'Selecione',
            '2015' => '2015',
            '2016' => '2016',
            '2017' => '2017'
        );
        $filtros['anos'] = $arrAnos;
        
        // crimes
        $arrCrimes = array(
            '' => 'Selecione',
            "Arma de Fogo",
            "Arma Branca",
            "Ação contudente",
            "Estrangulamento",
            "Outros Meios",
            "CVLI"
        );
        $filtros['crimes'] = $arrCrimes;
        
        // Dia de Semana
        $arrDiasSemana = array(
            '' => 'Selecione',
            "DOM",
            "SEG",
            "TER",
            "QUA",
            "QUI",
            "SEX",
            "SAB"
        );
        $filtros['diasSemana'] = $arrDiasSemana;
        
        // Horários
        $arrHorarios = array(
            '' => 'Selecione',
            "0h às 6h",
            "6h às 12h",
            "12h às 18h",
            "18h às 24h"
        );
        $filtros['horarios'] = $arrHorarios;
        
        // Sexo
        $arrSexo = array(
            'M',
            'TODOS'
        );
        $filtros['sexo'] = $arrSexo;
        
        // Mês
        $arrMeses = array(
            '' => 'Selecione',
            'Janeiro',
            'Fevereiro',
            'Março',
            'Abril',
            'Maio',
            'Junho',
            'Julho',
            'Agosto',
            'Setembro',
            'Outubro',
            'Novembro',
            'Dezembro'
        );
        $filtros['meses'] = $arrMeses;
        
        //Idade
        $arrIdade = array( '' => 'Selecione','12 a 18 anos', '19 a 29 anos', '30 a 40 anos', '51 a 80 anos');
        $filtros['idade'] = $arrIdade;
        
        $this->view->arrFiltros = $filtros;
    }

    public function indexAction()
    {}

    public function bairrosMaisPerigososAction()
    {
        // TODO: Buscar dados
    }

    public function tiposCrimeAction()
    {
        // TODO: Buscar dados
    }

    public function diasSemanaAction()
    {
        // TODO: Buscar dados
    }

    public function horariosDiaAction()
    {
        // TODO: Buscar dados
    }

    public function ocorrenciasPorMesAction()
    {
        // TODO: Buscar dados
    }

    public function ocorrencias1218Action()
    {
        // TODO: Buscar dados
    }

    public function ocorrencias1929Action()
    {
        // TODO: Buscar dados
    }

    public function ocorrencias3040Action()
    {
        // TODO: Buscar dados
    }

    public function ocorrencias4150Action()
    {
        // TODO: Buscar dados
    }

    public function ocorrenciasIdadeAction()
    {
        // TODO: Buscar dados
    }
}