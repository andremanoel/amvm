<?php

class Application_Model_Mapas_Mapa extends Zend_Db_Table_Abstract
{
    protected $_name    = 'tb_mapa';
    protected  $_primary = 'id_mapa';
    
    public function getMapa($idTipoClassificacao, $idMapaAno)
    {
        $sql = $this->getAdapter()->select();
        $sql->from($this->_name, array('titulo', 'url_mapa'))
            ->where('id_mapa_tipo_classificacao = ?',$idTipoClassificacao)
            ->where('id_mapa_ano = ?',$idMapaAno);
        
        return $this->getAdapter()->fetchRow($sql);
    }
    
    public function buscarTodos($data) 
    {
        $sql = $this->getAdapter()->select();
        $sql->from(array('m'=> $this->_name), array('m.titulo', 'm.url_mapa', 'm.id_mapa'))
            ->joinInner(array('a'=>'tb_mapa_ano'), 'm.id_mapa_ano = a.id_mapa_ano', array('a.ano'))
            ->joinInner(array('c'=>'tb_mapa_tipo_classificacao'), 
                    'm.id_mapa_tipo_classificacao = c.id_mapa_tipo_classificacao', 
                    array('tipo_classificacao'=>'c.nome'))
            ->joinInner(array('t'=>'tb_mapa_tipo'), 'c.id_mapa_tipo = t.id_mapa_tipo', array('tipo'=>'t.nome'))
            ->order(array('a.ano', 'm.id_mapa_tipo_classificacao'));
        //a($data);
        // Filtros busca
        if(isset($data['classificacao']) && !empty($data['classificacao'])) {
            $sql->where('m.id_mapa_tipo_classificacao = ?',$data['classificacao']);
        }
        
        if(isset($data['ano']) && !empty($data['ano'])) {
            $sql->where('m.id_mapa_ano = ?',$data['ano']);
        }
        
        return $this->getAdapter()->fetchAll($sql);
    }
    
    public function buscarMapaExistente($ano, $classificacao)
    {
        if (!empty($ano) && !empty($classificacao)){
        $sql = $this->getAdapter()->select();
        $sql->from(array('m'=> $this->_name), array('m.id_mapa'))
            ->where('m.id_mapa_ano = ?', $ano)
            ->where('m.id_mapa_tipo_classificacao = ?', $classificacao);
        
            return $this->getAdapter()->fetchOne($sql);
        } else {
            return null;
        }
    }
    

}

