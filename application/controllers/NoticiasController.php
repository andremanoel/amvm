<?php

class NoticiasController extends Core_Controller_Base
{

    public function init()
    {
        parent::init();
    }

    public function indexAction()
    {
        $modelNoticia = new Application_Model_Noticia();
        $this->view->arrNoticias = $modelNoticia->buscarNoticias();
    }

    public function visualizarAction()
    {
        $idNoticia = $this->getParam('id');
    }

    public function listarAction()
    {
        $this->verificarLogin();
    }
}



