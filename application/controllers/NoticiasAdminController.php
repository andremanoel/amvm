<?php

class NoticiasAdminController extends Core_Controller_Seguro 
{

    public function init()
    {
        parent::init();
        $this->_helper->layout()->setLayout("admin");
    }

    public function indexAction()
    {
        $modelNoticia = new Application_Model_Noticia();
        $this->view->arrNoticias = $modelNoticia->buscarAdmin();
    }
    
    public function formAction()
    {
        $modelNoticia = new Application_Model_Noticia();
        $idNoticia = $this->getParam('id_noticia');
        $usuarioLogado = Core_Util_Usuario::getUsuarioLogado();
        
        if (!empty($idNoticia)) {
            $objNoticia = $modelNoticia->find($idNoticia)->current();
        } else {
            $objNoticia = $modelNoticia->createRow();
        }
        
        $objNoticia->setFromArray($this->getAllParams());
        if($this->_request->isPost()) {
            try {
                $this->validate();
                $objNoticia->setFromArray($this->getAllParams());
                
                $objNoticia->id_usuario_cadastro = $usuarioLogado->id_usuario;
                $objNoticia->save();
                $this->addMensagem('Notícia cadastrada com Sucesso.', 'primary');
                $this->redirect('/noticias-admin');
                
            } catch (Exception $e) {
                $this->addMensagem($e->getMessage(), 'warning');
            }
        }
        
        $this->view->objNoticia = $objNoticia;
    }
    
    public function validate()
    {
        $params = $this->getAllParams();
        if (empty($params['titulo'])) {
            throw new Core_Controller_Exception_Validate('O Título é obrigatório.');
        }
        
        if (empty($params['texto_noticia'])){
            throw new Core_Controller_Exception_Validate('O Texto é obrigatório.');
        }
    }

}
