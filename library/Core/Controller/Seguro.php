<?php

class Core_Controller_Seguro extends Core_Controller_Base
{
    public function init()
    {
        parent::init();
        
        //verifica o login
        if(Zend_Auth::getInstance()->hasIdentity() === false) {
            $this->redirect('/login');
        }
    }

    public function indexAction()
    {
    }

    public function loginAction()
    {
    }
    
    public function postDispatch()
    {
        parent::postDispatch();
        $usuarioLogado = Zend_Auth::getInstance()->getIdentity();
        $this->view->usuarioLogado = $usuarioLogado;
    }

}