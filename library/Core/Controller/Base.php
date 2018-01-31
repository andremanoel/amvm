<?php

class Core_Controller_Base extends Zend_Controller_Action
{

    public $sessaoMensagem = null;

    public function init()
    {
        $this->sessaoMensagem = new Zend_Session_Namespace('mensagens');
    }

    /**
     * Adiciona uma mensagem na sessão
     * Tipos: primary, success, warning, danger
     * @param unknown $mensagem
     * @param string $tipo
     */
    public function addMensagem($mensagem, $tipo = 'success')
    {
        if(!isset($this->sessaoMensagem->mensagens)) {
            $this->sessaoMensagem->mensagens = array();
        }
        $arrMensagens = $this->sessaoMensagem->mensagens;
        
        $stdMensagem = new stdClass();
        $stdMensagem->texto = $mensagem;
        $stdMensagem->tipo  = $tipo;
        
        array_push($arrMensagens, $stdMensagem);
        $this->sessaoMensagem->mensagens = $arrMensagens;
        
    }
    
    public function postDispatch()
    {
        $this->view->messages = $this->sessaoMensagem->mensagens;
    }
    
    static function apagarMensagens()
    {
        $sessaoMensagem = new Zend_Session_Namespace('mensagens');
        $sessaoMensagem->mensagens = null;
    }
    
    /**
     * Verifica se tem usuário logado
     */
    public function verificarLogin()
    {
        if(!Zend_Auth::getInstance()->hasIdentity()) {
            $this->redirect('/login');
        }
    }
    
    
}