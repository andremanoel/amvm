<?php

class NoticiasController extends Core_Controller_Base
{

    public function init()
    {
        parent::init();
    }

    public function indexAction()
    {}

    public function visualizarAction()
    {
        $idNoticia = $this->getParam('id');
    }

    public function listarAction()
    {
        $this->verificarLogin();
    }
}



