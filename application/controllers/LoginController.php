<?php

class LoginController extends Core_Controller_Base
{

    public function indexAction()
    {
        if ($this->_request->isPost()) {
            $username = $this->getParam('usuario_amvm');
            $password = $this->getParam('senha_amvm');
            
            if(empty($username) || empty($password)) {
                $this->addMensagem('Usuário e senha obrigatórios', 'warning');
            } else {
                $senha = hash('whirlpool', $password);
                $resultado = new Core_Auth_Adapter($username, $senha);
                if ($resultado->getCodeResult() > 0) {
                    $modelAcesso = new Application_Model_AcessoUsuario();
                    $modelAcesso->cadastrarAcesso();
                    $this->redirect('/gestor');
                } else {
                    $this->addMensagem('Dados incorretos', 'warning');
                }
            }
        }
    }
    
    public function logoutAction()
    {
        $this->_helper->viewRenderer->setNoRender();
        Zend_Auth::getInstance()->clearIdentity();
        $this->addMensagem('Até a próxima');
        $this->redirect('/');
    }
}