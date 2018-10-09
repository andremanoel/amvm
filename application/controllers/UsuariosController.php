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
        $idUsuario = $this->getParam('id_usuario');
        if (!empty($idUsuario)) {
            $objUsuario = $modelUsuario->find($idUsuario)->current();
        } else {
            $objUsuario = $modelUsuario->createRow();
        }
        
        if ($this->_request->isPost()) {
            try {
                $this->validar();
                $objUsuario->setFromArray($this->getAllParams());
                $objUsuario->senha = hash('whirlpool', $objUsuario->senha);
                $objUsuario->save();
                
                $this->addMensagem('Registro salvo com sucesso.', 'success');
                $this->redirect('/usuarios');
            } catch (Exception $e) {
                $this->addMensagem($e->getMessage(), 'danger');
            }
        }
        
        $this->view->objUsuario = $objUsuario;
    }
    
    public function validar()
    {
        $data = $this->getAllParams();
        $emailValidate = new Zend_Validate_EmailAddress();
        if (empty($data['email'])) {
            throw new Core_Exception_ValidacaoException('O e-mail é obrigatório.');
        }
        
        if (empty($data['nome'])) {
            throw new Core_Exception_ValidacaoException('O nome é obrigatório.');
        }
        
        if ( !$emailValidate->isValid($data['email'])) {
            throw new Core_Exception_ValidacaoException('O e-mail é inválido.');
        }
        
        if (empty($data['login'])) {
            throw new Core_Exception_ValidacaoException('O login é obrigatório.');
        }
        
        if (!empty($data['senha'])) {
            if ($data['senha'] !== $data['confirmarSenha']) {
                throw new Core_Exception_ValidacaoException('A senha e a confirmação da senha estão diferentes.');
            }
        }
    }
}