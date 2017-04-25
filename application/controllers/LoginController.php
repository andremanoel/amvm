<?php

class LoginController extends Core_Controller_Base
{

    public function indexAction()
    {
        if ($this->_request->isPost()) {
            $username = $this->getParam('usuario');
            $password = $this->getParam('senha');
            
            if(empty($username) || empty($password)) {
                $this->addMensagem('Usuário e senha obrigatórios', 'warning');
            } else {
                $senha = hash('whirlpool', $password);
                $resultado = new Core_Auth_Adapter($username, $senha);
                
                if ($resultado->getCodeResult() > 0) {
                    
                    $this->redirect('/gestor');
                } else {
                    // ENVIAR MENSAGEM DE ERRO
                }
            }
            
        }
    }
}