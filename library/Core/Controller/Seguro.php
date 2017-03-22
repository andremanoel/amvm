<?php

class Core_Controller_Seguro extends Zend_Controller_Action
{
    public function init()
    {
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

}