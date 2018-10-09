<?php

class MapasAdminController extends Core_Controller_Seguro
{
    
    public $modelTipo;
    public $modelAno;
    public $modelClassificacao;
    public $modelMapa;

    public function init()
    {
        parent::init();
        $this->_helper->layout()->setLayout("admin");
        $this->modelTipo = new Application_Model_Mapas_MapaTipo();
        $this->modelAno  = new Application_Model_Mapas_MapaAno();
        $this->modelClassificacao  = new Application_Model_Mapas_MapaTipoClassificacao();
        $this->modelMapa  = new Application_Model_Mapas_Mapa();
        
        // parametros de busca
        $idAno = $this->getParam('ano');
        $idTipo = $this->getParam('tipo');
        $idClassificacao = $this->getParam('classificacao');
        
        // valores SELECT
        $this->view->tipos = [''=>'Todos'] + $this->modelTipo->getTipos();
        $this->view->anos = [''=>'Todos'] + $this->modelAno->getAnos();
        $arrClassificacao = [];
        if (!empty($idTipo)) {
            $arrClassificacao = $this->modelClassificacao->getTiposClassificacao($idTipo);
        }
        $this->view->classificacao = [''=>'Todos'] + $arrClassificacao;
        
        // Selecionados
        $this->view->anoSelecionado = $idAno;
        $this->view->tipoSelecionado = $idTipo;
        $this->view->classificacaoSelecionado = $idClassificacao;
        
    }
    
    public function indexAction() 
    {
        
        try {
            $this->view->mapas = $this->modelMapa->buscarTodos($this->getAllParams());
        } catch (Exception $e) {
           $this->addMensagem('Erro ao listar Mapas. ' . $e->getMessage(), 'error');
        }
    }
    
    public function formAction()
    {
        $idMapa = $this->getParam('id_mapa');
    
        if (!empty($idMapa)) {
            $obj = $this->modelMapa->find($idMapa)->current();
        } else {
            $obj = $this->modelMapa->createRow();
        }
        
        //Verifica se está inserindo dados de um mapa que já existe
        $result = $this->modelMapa->buscarMapaExistente($this->getParam('id_mapa_ano'), $this->getParam('id_mapa_tipo_classificacao'));
        $mapaSubstituido = false;
        if(!empty($result)) {
            $obj = $this->modelMapa->find($result)->current();
            a($obj);
            $mapaSubstituido = true;
        }
    
        $obj->setFromArray($this->getAllParams());
        if($this->_request->isPost()) {
            try {
                $this->validate();
                $obj->setFromArray($this->getAllParams());
                $obj->save();
                if ($mapaSubstituido) {
                    $this->addMensagem('O Mapa já existia e foi substituído com os dados informados.', 'warn');
                } else {
                    $this->addMensagem('O Mapa foi cadastrado com Sucesso.', 'primary');
                }
                $this->redirect('/mapas-admin');
    
            } catch (Exception $e) {
                $this->addMensagem($e->getMessage(), 'warning');
            }
        }
    
        $this->view->obj = $obj;
        // 
        $this->view->arrAnos = $this->modelAno->getAnos();
        $this->view->arrTipos = $this->modelTipo->getTipos();
    }
    
    public function validate()
    {
        $params = $this->getAllParams();
        if (empty($params['titulo'])) {
            throw new Core_Controller_Exception_Validate('O Título é obrigatório.');
        }
    
        if (empty($params['url_mapa'])){
            throw new Core_Controller_Exception_Validate('O URL do Mapa é obrigatória.');
        }
        
        if (empty($params['tipo'])){
            throw new Core_Controller_Exception_Validate('O Tipo do Mapa é obrigatório.');
        }
        
        if (empty($params['id_mapa_tipo_classificacao'])){
            throw new Core_Controller_Exception_Validate('A Classificação do Mapa é obrigatória.');
        }
        
        if (empty($params['id_mapa_ano'])){
            throw new Core_Controller_Exception_Validate('O Ano do Mapa é obrigatório.');
        }
    }
    
    public function carregarClassificacaoAction()
    {
        $this->_helper->layout()->disableLayout();
        $idTipo = $this->getParam('tipo');
        $this->view->classificacao = $this->modelClassificacao->getTiposClassificacao($idTipo);
        $this->view->classificacaoSelecionado = '';
    }
    
    public function excluirAction()
    {
        $id = $this->getParam('id_mapa');
        $this->modelMapa->delete('id_mapa =' . $id);
        $this->addMensagem('Mapa excluído.', 'success');
        $this->redirect('/mapas-admin');
    }
    
}