<?php

class LoginController extends Zend_Controller_Action
{
    public function indexAction()
    {
        if($this->_request->isPost()) {
            a($this->_request->getData());
        }
        
    }
}