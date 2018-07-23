<?php


class IndicadoresCvnliController extends Zend_Controller_Action
{

    public $anoInicialFiltros;
    public $anoSelecionado;
    public $isPost = false;    
    
    public function init()
    {
        parent::init();
        
        // libs js
        $this->view->headScript()->appendFile('/assets/js/Highcharts-5.0.7/code/highcharts.js');
        $this->view->headScript()->appendFile('/assets/js/Highcharts-5.0.7/code/highcharts-more.js');
        $this->view->headScript()->appendFile('/assets/js/Highcharts-5.0.7/code/modules/exporting.js');
        $this->view->headScript()->appendFile('/assets/js/chosen_v1.8.7/chosen.jquery.min.js');
        $this->view->headScript()->appendFile('/assets/js/graficos.js');
        $this->view->headLink()->appendStylesheet('/assets/js/chosen_v1.8.7/chosen.min.css');
        
        $filtros = array();
        
        // anos
        $anoInicial = 2015;
        $anoAtual = date('Y') - 1;
        $this->anoInicialFiltros = $anoAtual; // Sempre buscando de um ano pra trás do atual
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
            Application_Model_DadosPlanilhaCvnli::ESTUPRO => 'Estupro',
            Application_Model_DadosPlanilhaCvnli::ROUBO => 'Roubo',
            Application_Model_DadosPlanilhaCvnli::LESAO =>'Lesão',
            Application_Model_DadosPlanilhaCvnli::CVNLI =>'CVNLI'
        );
        $filtros['crimes'] = $arrCrimes;
        
        // Dia de Semana
        $arrDiasSemana = array(
            Application_Model_DadosPlanilhaCvnli::DOMINGO => 'Domingo',
            Application_Model_DadosPlanilhaCvnli::SEGUNDA => 'Segunda',
            Application_Model_DadosPlanilhaCvnli::TERCA   => 'Terça',
            Application_Model_DadosPlanilhaCvnli::QUARTA  => 'Quarta',
            Application_Model_DadosPlanilhaCvnli::QUINTA  => 'Quinta',
            Application_Model_DadosPlanilhaCvnli::SEXTA   => 'Sexta',
            Application_Model_DadosPlanilhaCvnli::SABADO  => 'Sábado'
        );
        $filtros['diasSemana'] = $arrDiasSemana;
        
        // Horários
        $arrHorarios = array(
            Application_Model_DadosPlanilhaCvnli::HORA_0_6    => '0h às 6h',
            Application_Model_DadosPlanilhaCvnli::HORA_6_12   => '6h às 12h',
            Application_Model_DadosPlanilhaCvnli::HORA_12_18  => '12h às 18h',
            Application_Model_DadosPlanilhaCvnli::HORA_18_24  => '18h às 24h'
        );
        $filtros['horarios'] = $arrHorarios;
        
        // Sexo
        $arrSexo = array(
            Application_Model_DadosPlanilhaCvnli::MASCULINO => 'Masculino',
            Application_Model_DadosPlanilhaCvnli::FEMININO  => 'Feminino'
        );
        $filtros['sexo'] = $arrSexo;
        
        // Mês
        $arrMeses = array(
            Application_Model_DadosPlanilhaCvnli::JAN => 'Janeiro',
            Application_Model_DadosPlanilhaCvnli::FEV => 'Fevereiro',
            Application_Model_DadosPlanilhaCvnli::MAR => 'Março',
            Application_Model_DadosPlanilhaCvnli::ABR => 'Abril',
            Application_Model_DadosPlanilhaCvnli::MAI => 'Maio',
            Application_Model_DadosPlanilhaCvnli::JUN => 'Junho',
            Application_Model_DadosPlanilhaCvnli::JUL => 'Julho',
            Application_Model_DadosPlanilhaCvnli::AGO => 'Agosto',
            Application_Model_DadosPlanilhaCvnli::SET => 'Setembro',
            Application_Model_DadosPlanilhaCvnli::OUT => 'Outubro',
            Application_Model_DadosPlanilhaCvnli::NOV => 'Novembro',
            Application_Model_DadosPlanilhaCvnli::DEZ => 'Dezembro'
        );
        $filtros['meses'] = $arrMeses;
        
        //Idade
        $arrIdade = array(
            Application_Model_DadosPlanilhaCvnli::ID_12_18 => '12 a 18 anos', 
            Application_Model_DadosPlanilhaCvnli::ID_19_29 => '19 a 29 anos', 
            Application_Model_DadosPlanilhaCvnli::ID_30_40 => '30 a 40 anos', 
            Application_Model_DadosPlanilhaCvnli::ID_51_80 => '51 a 80 anos'
        );
        $filtros['idade'] = $arrIdade;
        
        // Bairros
        $modelBairro = new Application_Model_Bairro();
        $filtros['bairros'] = $modelBairro->getBairros(); 
        
        // Itens Selecionados
        $this->view->filtros = $filtros;
        
        if ($this->_request->isPost()) {
            $this->isPost = true;
        }
        $this->view->isPost = $this->isPost;
    }

    public function indexAction()
    {}

    public function bairrosAction()
    {
        $filtros = $this->getAllParams();
        
        if (!isset($filtros['ano'])) {
            $filtros['ano'] = date('Y') - 1;
        }
        
        if (!isset($filtros['crime'])) {
            $filtros['crime'] = Application_Model_DadosPlanilhaCvnli::CVNLI;
        }
        
        $modelDadosPlanilha = new Application_Model_DadosPlanilhaCvnli();
        $result = $modelDadosPlanilha->getTotalCrimesPorBairro($filtros);
        $arrJson =  [];
        $arrPizza = [];
        if (!empty($result)) {
            // Json Barra
            foreach($result as $item) {
                $obj = new stdClass();
                $obj->name = $item['nome'];
                $obj->y = (float)$item[$filtros['crime']];
                array_push($arrJson, $obj);
            }
            
            // Json Linha
            foreach($result as $item) {
                $obj = new stdClass();
                $obj->name = $item['nome'];
                $obj->y = (float)$item[$filtros['crime']];
                array_push($arrPizza, $obj);
            }
            
            $this->view->jsonData = json_encode($arrJson);
            $this->view->jsonPizza = json_encode($arrPizza);
        } else {
            $this->view->jsonData = null;
            $this->view->jsonPizza = null;
        }
        
        // Filtros Selecionados
        $this->view->anoSelecionado = $this->getParam('ano', $this->anoInicialFiltros);
        $this->view->crimeSelecionado = $this->getParam('crime', Application_Model_DadosPlanilhaCvnli::CVNLI);
        $this->view->bairrosSelecionados = $this->getParam('bairro');
        
        $this->view->tituloGrafico = 'Incidência por Bairro';
        $this->view->tituloY = 'Incidência de crimes';
        $this->view->tituloSeries = 'Incidência de Crimes';
    }

    public function diasSemanaAction()
    {
        $filtros = $this->getAllParams();
        $modelDadosPlanilha = new Application_Model_DadosPlanilhaCvnli();
        $result = $modelDadosPlanilha->getTotalDiaSemana($filtros);
        $arrJson = [];
        
        if (!empty($result)) {
            foreach($result as $item) {
                $obj = new stdClass();
                // Nome do bairro
                $obj->name = $item['nome'];
                // Valores por dia da semana 
                $domingo = 0;
                if (isset($item[Application_Model_DadosPlanilhaCvnli::DOMINGO]))
                    $domingo   = (float) $item[Application_Model_DadosPlanilhaCvnli::DOMINGO];
                
                $segunda = 0;
                if (isset($item[Application_Model_DadosPlanilhaCvnli::SEGUNDA])) 
                    $segunda   = (float) $item[Application_Model_DadosPlanilhaCvnli::SEGUNDA];
                
                $terca = 0;
                if (isset($item[Application_Model_DadosPlanilhaCvnli::TERCA]))
                    $terca     = (float) $item[Application_Model_DadosPlanilhaCvnli::TERCA];
                
                $quarta = 0;
                if (isset($item[Application_Model_DadosPlanilhaCvnli::QUARTA]))
                    $quarta    = (float) $item[Application_Model_DadosPlanilhaCvnli::QUARTA];
                
                $quinta = 0;
                if (isset($item[Application_Model_DadosPlanilhaCvnli::QUINTA]))
                    $quinta    = (float) $item[Application_Model_DadosPlanilhaCvnli::QUINTA];
                
                $sexta = 0;
                if (isset($item[Application_Model_DadosPlanilhaCvnli::SEXTA]))
                    $sexta     = (float) $item[Application_Model_DadosPlanilhaCvnli::SEXTA];
                
                $sabado = 0;
                if (isset($item[Application_Model_DadosPlanilhaCvnli::SABADO]))
                    $sabado    = (float) $item[Application_Model_DadosPlanilhaCvnli::SABADO];
                
                $obj->data = [$domingo, $segunda, $terca, $quarta, $quinta, $sexta, $sabado];
                array_push($arrJson, $obj);
            }
            $this->view->jsonData = json_encode($arrJson);
        } else {
            $this->view->jsonData = null;
        }
        
        //dados view
        $this->view->anoSelecionado = $this->getParam('ano', $this->anoInicialFiltros);
        $this->view->bairrosSelecionados = $this->getParam('bairro');
        $this->view->diasSelecionados = $this->getParam('diaSemana');
        
        $this->view->tituloGrafico = 'Incidência por dia da semana';
        $this->view->tituloY = 'Incidência';
        $this->view->tituloSeries = 'Incidência por dia da semana';
        
    }

    public function horariosDiaAction()
    {
        $filtros = $this->getAllParams();
        
        //Por padrão busca Ano atual
        if (empty($filtros['ano'])) {
            $filtros['ano'] = date('Y') - 1;
            
        }
        
        $modelDadosPlanilha = new Application_Model_DadosPlanilhaCvnli();
        $result = $modelDadosPlanilha->getTotalPorHorario($filtros);
        $arrJson = [];
        
        if (!empty($result)) {
            $arrPizza = [];
            foreach($result as $item) {
                $obj = new stdClass();
                // Nome do bairro
                $obj->name = $item['nome'];
                // Valores por dia da semana 
                $hora06 = $hora612 = $hora1218 = $hora1824 = 0;
                if(isset($item[Application_Model_DadosPlanilhaCvnli::HORA_0_6]))
                    $hora06    = (float) $item[Application_Model_DadosPlanilhaCvnli::HORA_0_6];
                
                if(isset($item[Application_Model_DadosPlanilhaCvnli::HORA_6_12]))
                    $hora612   = (float) $item[Application_Model_DadosPlanilhaCvnli::HORA_6_12];
                
                if(isset($item[Application_Model_DadosPlanilhaCvnli::HORA_12_18]))
                    $hora1218  = (float) $item[Application_Model_DadosPlanilhaCvnli::HORA_12_18];
                
                if(isset($item[Application_Model_DadosPlanilhaCvnli::HORA_18_24]))
                    $hora1824  = (float) $item[Application_Model_DadosPlanilhaCvnli::HORA_18_24];
                
                
                $obj->data = [
                    $hora06, 
                    $hora612, 
                    $hora1218, 
                    $hora1824
                ];
                array_push($arrJson, $obj);
            }
            
            $this->view->jsonPizza = json_encode($arrPizza);
            $this->view->jsonData = json_encode($arrJson);
        } else {
            $this->view->jsonData = null;
            $this->view->jsonPizza = null;
        }
        
        //dados view
        $this->view->anoSelecionado      = $this->getParam('ano', $this->anoInicialFiltros);
        $this->view->bairrosSelecionados = $this->getParam('bairro');
        $this->view->horarioSelecionado  = $this->getParam('horario');
        
        $this->view->tituloGrafico = 'Incidência por horário do dia';
        $this->view->tituloY = 'Incidência de crimes';
        $this->view->tituloSeries = 'Incidência';
    }

    public function ocorrenciasPorMesAction()
    {
        $filtros = $this->getAllParams();
        
        //Por padrão busca Ano atual
        if (empty($filtros['ano'])) {
            $filtros['ano'] = date('Y') - 1;
        }
        
        $modelDadosPlanilha = new Application_Model_DadosPlanilhaCvnli();
        $result = $modelDadosPlanilha->getTotalPorMes($filtros);
        $arrJson = [];
        
        if (!empty($result)) {
            foreach($result as $item) {
                $obj = new stdClass();
                // Nome do bairro
                $obj->name = $item['nome'];
                // Valores por dia da semana 
                $janeiro   = (float) $item[Application_Model_DadosPlanilhaCvnli::JAN];
                $fev       = (float) $item[Application_Model_DadosPlanilhaCvnli::FEV];
                $marco     = (float) $item[Application_Model_DadosPlanilhaCvnli::MAR];
                $abril     = (float) $item[Application_Model_DadosPlanilhaCvnli::ABR];
                $maio      = (float) $item[Application_Model_DadosPlanilhaCvnli::MAI];
                $junho     = (float) $item[Application_Model_DadosPlanilhaCvnli::JUN];
                $julho     = (float) $item[Application_Model_DadosPlanilhaCvnli::JUL];
                $agosto    = (float) $item[Application_Model_DadosPlanilhaCvnli::AGO];
                $setembro  = (float) $item[Application_Model_DadosPlanilhaCvnli::SET];
                $outubro   = (float) $item[Application_Model_DadosPlanilhaCvnli::OUT];
                $novembro  = (float) $item[Application_Model_DadosPlanilhaCvnli::NOV];
                $dezembro  = (float) $item[Application_Model_DadosPlanilhaCvnli::DEZ];
                $obj->data = [
                    $janeiro,
                    $fev,
                    $marco,
                    $abril,
                    $maio,
                    $junho,
                    $julho,
                    $agosto,
                    $setembro,
                    $outubro,
                    $novembro,
                    $dezembro
                ];
                array_push($arrJson, $obj);
            }
            $this->view->jsonData = json_encode($arrJson);
        } else {
            $this->view->jsonData = null;
        }
        
        //dados view
        $this->view->anoSelecionado      = $this->getParam('ano', $this->anoInicialFiltros);
        $this->view->bairrosSelecionados = $this->getParam('bairro');
        $this->view->mesSelecionado  = $this->getParam('mes');
    }

    public function ocorrenciasIdadeAction()
    {
        $filtros = $this->getAllParams();
        
        //Por padrão busca Ano atual
        if (empty($filtros['ano'])) {
            $filtros['ano'] = date('Y') - 1;
        }
        
        $modelDadosPlanilha = new Application_Model_DadosPlanilhaCvnli();
        $result = $modelDadosPlanilha->getTotalPorIdade($filtros);
        $arrJson = [];
        
        if (!empty($result)) {
            foreach($result as $item) {
                $obj = new stdClass();
                // Nome do bairro
                $obj->name = $item['nome'];
                // Valores por dia da semana
                $idade12_18  = (float) $item[Application_Model_DadosPlanilhaCvnli::ID_12_18];
                $idade19_29  = (float) $item[Application_Model_DadosPlanilhaCvnli::ID_19_29];
                $idade30_40  = (float) $item[Application_Model_DadosPlanilhaCvnli::ID_30_40];
                $idade41_50  = (float) $item[Application_Model_DadosPlanilhaCvnli::ID_41_50];
                $idade51_80  = (float) $item[Application_Model_DadosPlanilhaCvnli::ID_51_80];
                $obj->data = [
                    $idade12_18,
                    $idade19_29,
                    $idade30_40,
                    $idade41_50,
                    $idade51_80
                ];
                array_push($arrJson, $obj);
            }
            $this->view->jsonData = json_encode($arrJson);
        } else {
            $this->view->jsonData = null;
        }
        
        //dados view
        $this->view->anoSelecionado      = $this->getParam('ano', $this->anoInicialFiltros);
        $this->view->bairrosSelecionados = $this->getParam('bairro');
        $this->view->idadeSelecionada    = $this->getParam('idade');
    }
}