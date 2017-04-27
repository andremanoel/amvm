<?php

class IndicadoresController extends Zend_Controller_Action
{
    public function init()
    {
        parent::init();
        
        //libs js
        $this->view->headScript()->appendFile('/assets/js/Highcharts-5.0.7/code/highcharts.js');
        $this->view->headScript()->appendFile('/assets/js/Highcharts-5.0.7/code/highcharts-more.js');
        $this->view->headScript()->appendFile('/assets/js/graficos.js');
    }

    public function indexAction()
    {
    }
    
    public function bairrosMaisPerigososAction() 
    {
        //TODO: Buscar dados
    }
    
    public function tiposCrimeAction()
    {
        //TODO: Buscar dados
    }
    
    public function diasSemanaAction()
    {
        //TODO: Buscar dados
    }
    
    public function horariosDiaAction()
    {
        //TODO: Buscar dados
    }
    
    public function ocorrenciasPorMesAction()
    {
        //TODO: Buscar dados
    }
    
    public function ocorrenciasMulher1218Action()
    {
        //TODO: Buscar dados
    }
    
    public function ocorrenciasMulher1929Action()
    {
        //TODO: Buscar dados
    }
    
    public function ocorrenciasMulher3040Action()
    {
        //TODO: Buscar dados
    }
    
    public function ocorrenciasMulher4150Action()
    {
        //TODO: Buscar dados
    }
    
    public function ocorrenciasMulherIdadeAction()
    {
        //TODO: Buscar dados
    }

}