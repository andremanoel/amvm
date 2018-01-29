<?php

class IndicadoresController extends Zend_Controller_Action
{

    public $anoInicialFiltros;
    
    public function init()
    {
        parent::init();
        
        // libs js
        $this->view->headScript()->appendFile('/assets/js/Highcharts-5.0.7/code/highcharts.js');
        $this->view->headScript()->appendFile('/assets/js/Highcharts-5.0.7/code/highcharts-more.js');
        $this->view->headScript()->appendFile('/assets/js/Highcharts-5.0.7/code/modules/exporting.js');
        $this->view->headScript()->appendFile('/assets/js/graficos.js');
        
        $filtros = array();
        
        // anos
        $anoAtual = date('Y');
        $this->anoInicialFiltros = $anoAtual - 1; // Sempre buscando de um ano pra trás do atual
        $anoInicial = 2015;
        $arrInicialAnos = range($anoInicial, $anoAtual);
        $arrAnos = [];
        foreach($arrInicialAnos as $ano) {
            $arrAnos[$ano] = $ano;
        }
        $filtros['anos'] = $arrAnos;
        
        // crimes
        $arrCrimes = array(
            '' => 'Selecione',
            Application_Model_DadosPlanilha::ESTUPRO => 'Estupro',
            Application_Model_DadosPlanilha::ROUBO => 'Roubo',
            Application_Model_DadosPlanilha::LESAO =>'Lesão',
            Application_Model_DadosPlanilha::CVNLI =>'CVNLI'
        );
        $filtros['crimes'] = $arrCrimes;
        
        // Dia de Semana
        $arrDiasSemana = array(
            '' => 'Selecione',
            Application_Model_DadosPlanilha::DOMINGO => 'Domingo',
            Application_Model_DadosPlanilha::SEGUNDA => 'Segunda',
            Application_Model_DadosPlanilha::TERCA   => 'Terça',
            Application_Model_DadosPlanilha::QUARTA  => 'Quarta',
            Application_Model_DadosPlanilha::QUINTA  => 'Quinta',
            Application_Model_DadosPlanilha::SEXTA   => 'Sexta',
            Application_Model_DadosPlanilha::SABADO  => 'Sábado'
        );
        $filtros['diasSemana'] = $arrDiasSemana;
        
        // Horários
        $arrHorarios = array(
            '' => 'Selecione',
            Application_Model_DadosPlanilha::HORA_0_6    => '0h às 6h',
            Application_Model_DadosPlanilha::HORA_6_12   => '6h às 12h',
            Application_Model_DadosPlanilha::HORA_12_18  => '12h às 18h',
            Application_Model_DadosPlanilha::HORA_18_24  => '18h às 24h'
        );
        $filtros['horarios'] = $arrHorarios;
        
        // Sexo
        $arrSexo = array(
            Application_Model_DadosPlanilha::MASCULINO => 'Masculino',
            Application_Model_DadosPlanilha::FEMININO  => 'Feminino'
        );
        $filtros['sexo'] = $arrSexo;
        
        // Mês
        $arrMeses = array(
            '' => 'Selecione',
            Application_Model_DadosPlanilha::JAN => 'Janeiro',
            Application_Model_DadosPlanilha::FEV => 'Fevereiro',
            Application_Model_DadosPlanilha::MAR => 'Março',
            Application_Model_DadosPlanilha::ABR => 'Abril',
            Application_Model_DadosPlanilha::MAI => 'Maio',
            Application_Model_DadosPlanilha::JUN => 'Junho',
            Application_Model_DadosPlanilha::JUL => 'Julho',
            Application_Model_DadosPlanilha::AGO => 'Agosto',
            Application_Model_DadosPlanilha::SET => 'Setembro',
            Application_Model_DadosPlanilha::OUT => 'Outubro',
            Application_Model_DadosPlanilha::NOV => 'Novembro',
            Application_Model_DadosPlanilha::DEZ => 'Dezembro'
        );
        $filtros['meses'] = $arrMeses;
        
        //Idade
        $arrIdade = array(
            '' => 'Selecione',
            Application_Model_DadosPlanilha::ID_12_18 => '12 a 18 anos', 
            Application_Model_DadosPlanilha::ID_19_29 => '19 a 29 anos', 
            Application_Model_DadosPlanilha::ID_30_40 => '30 a 40 anos', 
            Application_Model_DadosPlanilha::ID_51_80 => '51 a 80 anos'
        );
        $filtros['idade'] = $arrIdade;
        
        // Itens Selecionados
        $this->view->filtros = $filtros;
    }

    public function indexAction()
    {}

    public function bairrosAction()
    {
        
        if($this->_request->isPost()) {
            a($this->getAllParams());    
        }
        
        $modelDadosPlanilha = new Application_Model_DadosPlanilha();
        $result = $modelDadosPlanilha->getTotalCrimesPorBairro();
        $arrJson = [];
        foreach($result as $item) {
            $obj = new stdClass();
            $obj->name = $item['nome'];
            $obj->y = (float)$item['cvnli'];
            array_push($arrJson, $obj);
        }
        
        $this->view->jsonData = json_encode($arrJson);
        
        // Filtros Selecionados
        $this->view->anoSelecionado = $this->getParam('ano', $this->anoInicialFiltros);
        $this->view->crimeSelecionado = $this->getParam('crime', Application_Model_DadosPlanilha::CVNLI);
        $this->view->diaSemanaSelecionado = $this->getParam('diaSemana');
        $this->view->horarioSelecionado = $this->getParam('horario');
        $this->view->mesSelecionado = $this->getParam('mes');
        $this->view->idadeSelecionado = $this->getParam('idade');
    }

    public function cvliAction()
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