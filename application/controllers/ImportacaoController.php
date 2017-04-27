<?php

class ImportacaoController extends Core_Controller_Seguro
{

    public function init()
    {
        parent::init();
        $this->_helper->layout()->setLayout("admin");
    }
    
    public function indexAction()
    {
        if($this->_request->isPost()) {
            $file = Core_Util_File::upload('planilha');
            
            if($file['sucesso']) {
                 //rodar a rotina do phpExcel   
            } else {
                $this->addMensagem('Não foi possível realizar o upload', 'danger');
            }
        }
        
        $this->view->arrAnos = array(
            2014 => 2014,
            2015 => 2015,
            2016 => 2016,
            2017 => 2017
        );
    }
}