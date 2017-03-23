<?php

class LoginController extends Zend_Controller_Action
{
    public function indexAction()
    {
        if($this->_request->isPost()) {
            $username = $this->getParam('usuario');
            $password = $this->getParam('senha');
            
            $resultado = new Core_Auth_Adapter($username, $password);
            
            if($resultado->getCodeResult() > 0){
                
                $this->redirect('/gestor');
                	
            } else {
                //ENVIAR MENSAGEM DE ERRO
            }
        }
        
    }
}