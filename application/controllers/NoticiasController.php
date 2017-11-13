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
        $modelNoticia = new Application_Model_Noticia();
        $idNoticia = $this->getParam('id');
        $this->view->noticia = $modelNoticia->find($idNoticia)->current();
    }

    public function listarAction()
    {
        $this->verificarLogin();
    }
}



