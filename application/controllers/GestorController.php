<?php

use Core\Util\UsuarioUtil;

class GestorController extends Zend_Controller_Action
{
    public function init()
    {
        $usuarioUtil = new UsuarioUtil();
        a($usuarioUtil->temUsuarioLogado());
    }

    public function indexAction()
    {
    }

    public function loginAction()
    {
    }

}