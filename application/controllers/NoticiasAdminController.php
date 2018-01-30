<?php

class NoticiasAdminController extends Core_Controller_Seguro 
{

    public function init()
    {
        parent::init();
        $this->_helper->layout()->setLayout("admin");
    }

    public function indexAction()
    {
        $modelNoticia = new Application_Model_Noticia();
        $this->view->arrNoticias = $modelNoticia->buscarAdmin();
    }
    
    public function formAction()
    {
        
    }

}



