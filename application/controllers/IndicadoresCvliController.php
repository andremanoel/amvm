<?php

class IndicadoresCvliController extends Zend_Controller_Action
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
        $anoAtual = date('Y') - 1;
        $this->anoInicialFiltros = $anoAtual; // Sempre buscando de um ano pra trás do atual
        $anoInicial = 2014;
        $arrInicialAnos = range($anoInicial, $anoAtual);
        $arrAnos = [];
        foreach($arrInicialAnos as $ano) {
            $arrAnos[$ano] = $ano;
        }
        $filtros['anos'] = $arrAnos;
        
        // crimes
        /**
         * const ARMA_FOGO = 'arma_de_fogo';
    const ARMA_BRANCA = 'arma_branca';
    const OUTROS_MEIOS = 'outros_meios';
    const HOMICIDIO_DOLOSO = 'homicidio_doloso';
    const LATROCINIO = 'latrocinio';
    const LESAO_CORPORAL_SEGUIDA_MORTE = 'lesao_corporal_seguido_morte';
    const CVNLI = 'cvnli';
         * @var array $arrCrimes
         */
        $arrCrimes = array(
            '' => 'Selecione',
            Application_Model_DadosPlanilhaCvli::ARMA_FOGO => 'Arma de Fogo',
            Application_Model_DadosPlanilhaCvli::ARMA_BRANCA => 'Arma Branca',
            Application_Model_DadosPlanilhaCvli::OUTROS_MEIOS =>'Outros Meios',
            Application_Model_DadosPlanilhaCvli::HOMICIDIO_DOLOSO =>'Homicídio Doloso',
            Application_Model_DadosPlanilhaCvli::LATROCINIO =>'Latrocínio',
            Application_Model_DadosPlanilhaCvli::LESAO_CORPORAL_SEGUIDA_MORTE =>'Lesão Corporal Seguida da Morte',
            Application_Model_DadosPlanilhaCvli::CVNLI =>'CVNLI'
        );
        $filtros['crimes'] = $arrCrimes;
        
        // Dia de Semana
        $arrDiasSemana = array(
            Application_Model_DadosPlanilhaCvli::DOMINGO => 'Domingo',
            Application_Model_DadosPlanilhaCvli::SEGUNDA => 'Segunda',
            Application_Model_DadosPlanilhaCvli::TERCA   => 'Terça',
            Application_Model_DadosPlanilhaCvli::QUARTA  => 'Quarta',
            Application_Model_DadosPlanilhaCvli::QUINTA  => 'Quinta',
            Application_Model_DadosPlanilhaCvli::SEXTA   => 'Sexta',
            Application_Model_DadosPlanilhaCvli::SABADO  => 'Sábado'
        );
        $filtros['diasSemana'] = $arrDiasSemana;
        
        // Horários
        $arrHorarios = array(
            Application_Model_DadosPlanilhaCvli::HORA_0_6    => '0h às 6h',
            Application_Model_DadosPlanilhaCvli::HORA_6_12   => '6h às 12h',
            Application_Model_DadosPlanilhaCvli::HORA_12_18  => '12h às 18h',
            Application_Model_DadosPlanilhaCvli::HORA_18_24  => '18h às 24h'
        );
        $filtros['horarios'] = $arrHorarios;
        
        // Mês
        $arrMeses = array(
            Application_Model_DadosPlanilhaCvli::JAN => 'Janeiro',
            Application_Model_DadosPlanilhaCvli::FEV => 'Fevereiro',
            Application_Model_DadosPlanilhaCvli::MAR => 'Março',
            Application_Model_DadosPlanilhaCvli::ABR => 'Abril',
            Application_Model_DadosPlanilhaCvli::MAI => 'Maio',
            Application_Model_DadosPlanilhaCvli::JUN => 'Junho',
            Application_Model_DadosPlanilhaCvli::JUL => 'Julho',
            Application_Model_DadosPlanilhaCvli::AGO => 'Agosto',
            Application_Model_DadosPlanilhaCvli::SET => 'Setembro',
            Application_Model_DadosPlanilhaCvli::OUT => 'Outubro',
            Application_Model_DadosPlanilhaCvli::NOV => 'Novembro',
            Application_Model_DadosPlanilhaCvli::DEZ => 'Dezembro'
        );
        $filtros['meses'] = $arrMeses;
        
        //Idade
        $arrIdade = array(
            Application_Model_DadosPlanilhaCvli::ID_12_18 => '12 a 18 anos', 
            Application_Model_DadosPlanilhaCvli::ID_19_29 => '19 a 29 anos', 
            Application_Model_DadosPlanilhaCvli::ID_30_40 => '30 a 40 anos', 
            Application_Model_DadosPlanilhaCvli::ID_51_80 => '51 a 80 anos'
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
            $filtros['crime'] = Application_Model_DadosPlanilhaCvli::CVNLI;
        }
        
        
        $modelDadosPlanilha = new Application_Model_DadosPlanilhaCvli();
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
        $this->view->crimeSelecionado = $this->getParam('crime', Application_Model_DadosPlanilhaCvli::CVNLI);
        $this->view->bairrosSelecionados = $this->getParam('bairro');
        
        $this->view->tituloGrafico = 'Total por Bairro';
        $this->view->tituloY = 'Incidência';
        $this->view->tituloSeries = 'Incidência';
        
        // **********************************************
        // Gráfico de LINHA / AREA - Agrupa por Bairro
        // **********************************************
        $arrCategorias = [];
        foreach ($result as $item) {
            array_push($arrCategorias, $item['nome']);
        }
        $this->view->arrJsonCategorias = json_encode($arrCategorias);
        
        // **********************************************
        // Consulta os dados para Grafico de LINHA / AREA
        // **********************************************
        $arrCrimesLinha = $modelDadosPlanilha->getTotalCrimesPorBairroGraficosMaiores($this->view->filtros, $filtros);
        $arrArmaFogo = [];
        $arrArmaBranca = [];
        $arrOutrosMeios = [];
        $arrHomicidioDoloso = [];
        $arrLatrocinio = [];
        $arrLesaoCorporal = [];
        $arrCvli = [];
        // Agrupa dados por Crime e Bairro
        foreach ($arrCrimesLinha as $crimes) {
            array_push($arrArmaFogo, (int)$crimes['arma_de_fogo']);
            array_push($arrArmaBranca, (int)$crimes['arma_branca']);
            array_push($arrOutrosMeios, (int)$crimes['outros_meios']);
            array_push($arrHomicidioDoloso, (int)$crimes['homicidio_doloso']);
            array_push($arrLatrocinio, (int)$crimes['latrocinio']);
            array_push($arrLesaoCorporal, (int)$crimes['lesao_corporal_seguido_morte']);
            array_push($arrCvli, (int)$crimes['cvli']);
        }
        
        $this->view->arrJsonArmaFogo = json_encode($arrArmaFogo);
        $this->view->arrJsonArmaBranca = json_encode($arrArmaBranca);
        $this->view->arrJsonOutrosMeios = json_encode($arrOutrosMeios);
        $this->view->arrJsonHomicidioDoloso = json_encode($arrHomicidioDoloso);
        $this->view->arrJsonLatrocinio = json_encode($arrLatrocinio);
        $this->view->arrJsonLesaoCorporal = json_encode($arrLesaoCorporal);
        $this->view->arrJsonCvli = json_encode($arrCvli);
        
    }

    public function diasSemanaAction()
    {
        $filtros = $this->getAllParams();
        $modelDadosPlanilha = new Application_Model_DadosPlanilhaCvli();
        $result = $modelDadosPlanilha->getTotalDiaSemana($filtros);
        $arrJson = [];
        $arrCategorias = [];
        
        if (!empty($result)) {
            foreach($result as $item) {
                $obj = new stdClass();
                // Nome do bairro
                $obj->name = $item['nome'];
                // Valores por dia da semana 
                $domingo = 0;
                if (isset($item[Application_Model_DadosPlanilhaCvli::DOMINGO]))
                    $domingo   = (float) $item[Application_Model_DadosPlanilhaCvli::DOMINGO];
                
                $segunda = 0;
                if (isset($item[Application_Model_DadosPlanilhaCvli::SEGUNDA])) 
                    $segunda   = (float) $item[Application_Model_DadosPlanilhaCvli::SEGUNDA];
                
                $terca = 0;
                if (isset($item[Application_Model_DadosPlanilhaCvli::TERCA]))
                    $terca     = (float) $item[Application_Model_DadosPlanilhaCvli::TERCA];
                
                $quarta = 0;
                if (isset($item[Application_Model_DadosPlanilhaCvli::QUARTA]))
                    $quarta    = (float) $item[Application_Model_DadosPlanilhaCvli::QUARTA];
                
                $quinta = 0;
                if (isset($item[Application_Model_DadosPlanilhaCvli::QUINTA]))
                    $quinta    = (float) $item[Application_Model_DadosPlanilhaCvli::QUINTA];
                
                $sexta = 0;
                if (isset($item[Application_Model_DadosPlanilhaCvli::SEXTA]))
                    $sexta     = (float) $item[Application_Model_DadosPlanilhaCvli::SEXTA];
                
                $sabado = 0;
                if (isset($item[Application_Model_DadosPlanilhaCvli::SABADO]))
                    $sabado    = (float) $item[Application_Model_DadosPlanilhaCvli::SABADO];
                
                $obj->data = [$domingo, $segunda, $terca, $quarta, $quinta, $sexta, $sabado];
                array_push($arrJson, $obj);
                
                array_push($arrCategorias, $item['nome']);
            }
            $this->view->jsonData = json_encode($arrJson);
        } else {
            $this->view->jsonData = null;
        }
        
        //dados view
        $this->view->anoSelecionado = $this->getParam('ano', $this->anoInicialFiltros);
        $this->view->bairrosSelecionados = $this->getParam('bairro');
        $this->view->diasSelecionados = $this->getParam('diaSemana');
        
        $this->view->tituloGrafico = 'Total por dia da semana';
        $this->view->tituloY = 'Incidência';
        $this->view->tituloSeries = 'Incidência por dia da semana';
        
        
        // **********************************************
        // Gráfico de LINHA / AREA - Agrupa por Bairro
        // **********************************************
        // $this->view->arrJsonCategorias = json_encode($arrCategorias);
        
        // **********************************************
        // Consulta os dados para Grafico de LINHA / AREA TODO: FINALIZAR
        // **********************************************
//         $arrCrimesLinha = $modelDadosPlanilha->getTotalDiaSemanaTodosOsDias($this->view->filtros, $filtros);
//         $arrArmaFogo = [];
//         $arrArmaBranca = [];
//         $arrOutrosMeios = [];
//         $arrHomicidioDoloso = [];
//         $arrLatrocinio = [];
//         $arrLesaoCorporal = [];
//         $arrCvli = [];
//         // Agrupa dados por Crime e Bairro
//         foreach ($arrCrimesLinha as $crimes) {
//             array_push($arrArmaFogo, (int)$crimes['arma_de_fogo']);
//             array_push($arrArmaBranca, (int)$crimes['arma_branca']);
//             array_push($arrOutrosMeios, (int)$crimes['outros_meios']);
//             array_push($arrHomicidioDoloso, (int)$crimes['homicidio_doloso']);
//             array_push($arrLatrocinio, (int)$crimes['latrocinio']);
//             array_push($arrLesaoCorporal, (int)$crimes['lesao_corporal_seguido_morte']);
//             array_push($arrCvli, (int)$crimes['cvli']);
//         }
        
//         $this->view->arrJsonArmaFogo = json_encode($arrArmaFogo);
//         $this->view->arrJsonArmaBranca = json_encode($arrArmaBranca);
//         $this->view->arrJsonOutrosMeios = json_encode($arrOutrosMeios);
//         $this->view->arrJsonHomicidioDoloso = json_encode($arrHomicidioDoloso);
//         $this->view->arrJsonLatrocinio = json_encode($arrLatrocinio);
//         $this->view->arrJsonLesaoCorporal = json_encode($arrLesaoCorporal);
//         $this->view->arrJsonCvli = json_encode($arrCvli);
        
        
    }

    public function horariosDiaAction()
    {
        $filtros = $this->getAllParams();
        
        //Por padrão busca Ano atual
        if (empty($filtros['ano'])) {
            $filtros['ano'] = date('Y') - 1;
            
        }
        
        $modelDadosPlanilha = new Application_Model_DadosPlanilhaCvli();
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
                if(isset($item[Application_Model_DadosPlanilhaCvli::HORA_0_6]))
                    $hora06    = (float) $item[Application_Model_DadosPlanilhaCvli::HORA_0_6];
                
                if(isset($item[Application_Model_DadosPlanilhaCvli::HORA_6_12]))
                    $hora612   = (float) $item[Application_Model_DadosPlanilhaCvli::HORA_6_12];
                
                if(isset($item[Application_Model_DadosPlanilhaCvli::HORA_12_18]))
                    $hora1218  = (float) $item[Application_Model_DadosPlanilhaCvli::HORA_12_18];
                
                if(isset($item[Application_Model_DadosPlanilhaCvli::HORA_18_24]))
                    $hora1824  = (float) $item[Application_Model_DadosPlanilhaCvli::HORA_18_24];
                
                
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
        $this->view->tituloY = 'Incidência';
        $this->view->tituloSeries = 'Incidência';
    }

    public function ocorrenciasPorMesAction()
    {
        $filtros = $this->getAllParams();
        
        //Por padrão busca Ano atual
        if (empty($filtros['ano'])) {
            $filtros['ano'] = date('Y') - 1;
        }
        
        $modelDadosPlanilha = new Application_Model_DadosPlanilhaCvli();
        $result = $modelDadosPlanilha->getTotalPorMes($filtros);
        $arrJson = [];
        
        if (!empty($result)) {
            foreach($result as $item) {
                $obj = new stdClass();
                // Nome do bairro
                $obj->name = $item['nome'];
                // Valores por dia da semana 
                $janeiro   = (float) $item[Application_Model_DadosPlanilhaCvli::JAN];
                $fev       = (float) $item[Application_Model_DadosPlanilhaCvli::FEV];
                $marco     = (float) $item[Application_Model_DadosPlanilhaCvli::MAR];
                $abril     = (float) $item[Application_Model_DadosPlanilhaCvli::ABR];
                $maio      = (float) $item[Application_Model_DadosPlanilhaCvli::MAI];
                $junho     = (float) $item[Application_Model_DadosPlanilhaCvli::JUN];
                $julho     = (float) $item[Application_Model_DadosPlanilhaCvli::JUL];
                $agosto    = (float) $item[Application_Model_DadosPlanilhaCvli::AGO];
                $setembro  = (float) $item[Application_Model_DadosPlanilhaCvli::SET];
                $outubro   = (float) $item[Application_Model_DadosPlanilhaCvli::OUT];
                $novembro  = (float) $item[Application_Model_DadosPlanilhaCvli::NOV];
                $dezembro  = (float) $item[Application_Model_DadosPlanilhaCvli::DEZ];
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
        
        $modelDadosPlanilha = new Application_Model_DadosPlanilhaCvli();
        $result = $modelDadosPlanilha->getTotalPorIdade($filtros);
        $arrJson = [];
        
        if (!empty($result)) {
            foreach($result as $item) {
                $obj = new stdClass();
                // Nome do bairro
                $obj->name = $item['nome'];
                // Valores por dia da semana
                $idade12_18  = (float) $item[Application_Model_DadosPlanilhaCvli::ID_12_18];
                $idade19_29  = (float) $item[Application_Model_DadosPlanilhaCvli::ID_19_29];
                $idade30_40  = (float) $item[Application_Model_DadosPlanilhaCvli::ID_30_40];
                $idade41_50  = (float) $item[Application_Model_DadosPlanilhaCvli::ID_41_50];
                $idade51_80  = (float) $item[Application_Model_DadosPlanilhaCvli::ID_51_80];
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