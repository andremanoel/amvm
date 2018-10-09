<?php

class Application_Model_AcessoUsuario extends Zend_Db_Table_Abstract
{
    protected $_name    = 'tb_acesso_usuario';
    protected  $_primary = 'id_acesso_usuario';
    
    public function cadastrarAcesso()
    {
        $usuarioLogado = Core_Auth_Adapter::getUsuarioLogado();
        
        $obj = $this->createRow();
        $obj->id_usuario = $usuarioLogado->id_usuario;
        $obj->data_acesso = getDataAtual();
        $obj->ip = $_SERVER['REMOTE_ADDR'];
        $obj->browser = $_SERVER['HTTP_USER_AGENT'];
        $obj->save();
        
        
    }
}

