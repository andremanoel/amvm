<?php

class NoticiasController extends Zend_Controller_Action
{
    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
    }
    
    public function visualizarAction()
    {
        $idNoticia = $this->getParam('id');
    }

}



