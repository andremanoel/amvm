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
        $stdMensagem->icone = $this->iconeMensagem($tipo);
        
        array_push($arrMensagens, $stdMensagem);
        $this->sessaoMensagem->mensagens = $arrMensagens;
        
    }
    
    public function postDispatch()
    {
        $this->view->messages = $this->sessaoMensagem->mensagens;
    }
    
    public function iconeMensagem($tipo)
    {
        $icone = 'mdi-check';
        switch ($tipo) {
        	case 'primary':
        	    $icone = 'mdi-info-outline';
        	break;
        	
        	case 'warning':
        	    $icone = 'mdi-alert-triangle';
    	    break;
    	    
    	    case 'danger':
    	        $icone = 'mdi-close-circle-o';
	        break;
        }
        
        return $icone;
        
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