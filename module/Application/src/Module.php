<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Application\Model\Usuario;
use Zend\Form\Element\DateTime;

class Module
{
    const VERSION = '3.0.2dev';

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    /**
     * @param \Zend\Mvc\MvcEvent $mvcEvent
     */
    public function onBootstrap($mvcEvent)
    {
        $sm = $mvcEvent->getApplication()->getServiceManager();
        // $entityManager = $sm->get('doctrine.entitymanager.orm_default');
        // $usuario = new Usuario();
        // $usuario->setNome('Teste Andre');
        // $usuario->setEmail('teste@gmai.com');
        // $usuario->setSenha('iuasuahsuiahisuis');
        // $usuario->setDataCadastro(date('Y-m-d H:i:s'));
        // $entityManager->persist($usuario);
        // $entityManager->flush();
    }

}
