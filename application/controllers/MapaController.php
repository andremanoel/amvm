<?php

class MapaController extends Zend_Controller_Action
{

    public function init()
    {
        parent::init();
    }

    public function cvnliAction()
    {
        
    }
    
    public function diaSemanaAction()
    {
        // Dia de Semana
        $arrDiasSemana = array(
            Application_Model_DadosPlanilha::DOMINGO => 'Domingo',
            Application_Model_DadosPlanilha::SEGUNDA => 'Segunda',
            Application_Model_DadosPlanilha::TERCA   => 'Terça',
            Application_Model_DadosPlanilha::QUARTA  => 'Quarta',
            Application_Model_DadosPlanilha::QUINTA  => 'Quinta',
            Application_Model_DadosPlanilha::SEXTA   => 'Sexta',
            Application_Model_DadosPlanilha::SABADO  => 'Sábado'
        );
        $this->view->diasSemana = $arrDiasSemana;
        $this->view->diaSemanaSelecionado = $this->getParam('diaSemana', Application_Model_DadosPlanilha::DOMINGO);
    }
    
    public function horarioAction()
    {
        $arrHorarios = array(
            Application_Model_DadosPlanilha::HORA_0_6    => '0h às 6h',
            Application_Model_DadosPlanilha::HORA_6_12   => '6h às 12h',
            Application_Model_DadosPlanilha::HORA_12_18  => '12h às 18h',
            Application_Model_DadosPlanilha::HORA_18_24  => '18h às 24h'
        );
        $this->view->horarios = $arrHorarios;
        $this->view->horarioSelecionado = $this->getParam('horario', Application_Model_DadosPlanilha::HORA_0_6);
    }
    
    
}



