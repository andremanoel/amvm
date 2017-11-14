<?php

class UsuariosController extends Core_Controller_Seguro
{

    public function init()
    {
        parent::init();
        $this->_helper->layout()->setLayout("admin");
    }
    
    public function indexAction()
    {
        $modelUsuario = new Application_Model_Usuario();
        $this->view->arrUsuarios = $modelUsuario->fetchAll();
    }

    public function cadastrarAction()
    {}
}