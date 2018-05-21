<?php

class MensagensController extends Core_Controller_Seguro
{

    public function init()
    {
        parent::init();
        $this->_helper->layout()->setLayout("admin");
    }
    
    public function indexAction()
    {
        $modelContato = new Application_Model_Contato();
        $this->view->arrMensagens = $modelContato->fetchAll();
    }

}