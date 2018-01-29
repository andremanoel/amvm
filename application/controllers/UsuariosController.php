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

    public function formAction()
    {
        $modelUsuario = new Application_Model_Usuario();
        if ($this->hasParam('id_usuario')) {
            $idUsuario  = $this->hasParam('id_usuario');
            $objUsuario = $modelUsuario->find($idUsuario)->current();
        } else {
            $objUsuario = $modelUsuario->createRow();
        }
        
        if ($this->_request->isPost()) {
            
        }
        
        $this->view->objUsuario = $objUsuario;
    }
}