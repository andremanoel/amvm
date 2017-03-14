<?php

namespace Core\Util;

class UsuarioUtil
{
    protected $instanceAuth = null;
    
    public function __construct()
    {
        $this->instanceAuth = Zend_Auth::getInstance();
    }
    
    public function temUsuarioLogado() 
    {
        if($this->getInstanceAuth()->hasIdentity()) {
            return true;
        }
        return false;
    }
    
    public function getInstanceAuth()
    {
        return $this->instanceAuth;
    }
}