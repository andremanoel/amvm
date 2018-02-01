<?php

class ContatoController extends Core_Controller_Base
{

    public function init()
    {
        parent::init();
    }

    public function indexAction()
    {
        if ($this->_request->isPost()) {
            try {
                $this->validate();
                $params = $this->getAllParams();
                $modelContato = new Application_Model_Contato();
                $objContato   = $modelContato->createRow($this->getAllParams());
                $objContato->save();
                $this->addMensagem('Sua mensagem foi enviada. Aguarde a resposta.', 'success');
                $this->redirect('/contato');
            } catch (Exception $e) {
                $this->addMensagem($e->getMessage(), 'warning');
            }
        }
    }

    public function validate()
    {
        $params = $this->getAllParams();
        $nome = $this->limparTexto($params['nome']);
        if (empty($params['nome'])) {
            throw new Core_Controller_Exception_Validate('O nome é obrigatório.');    
        }
        
        $email = $this->limparTexto($params['email']);
        if (empty($params['email'])) {
            throw new Core_Controller_Exception_Validate('O email é obrigatório.');
        }
        
        $assunto = $this->limparTexto($params['assunto']);
        if (empty($params['assunto'])) {
            throw new Core_Controller_Exception_Validate('O assunto é obrigatório.');
        }
        
        $mensagem = $this->limparTexto($params['mensagem']);
        if (empty($params['mensagem'])) {
            throw new Core_Controller_Exception_Validate('A mensagem é obrigatória.');
        }
    }
    
    public function limparTexto($var)
    {
        return strip_tags(trim($var));
    }
}



