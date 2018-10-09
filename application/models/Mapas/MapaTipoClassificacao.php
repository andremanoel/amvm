<?php

class Application_Model_Mapas_MapaTipoClassificacao extends Zend_Db_Table_Abstract
{

    protected $_name = 'tb_mapa_tipo_classificacao';
    protected $_primary = 'id_mapa_tipo_classificacao';

    public function getTiposClassificacao($idTipoClassificacao)
    {
        $sql = $this->getAdapter()->select();
        $sql->from($this->_name, array('id_mapa_tipo_classificacao', 'nome'))
            ->where('id_mapa_tipo = ?', $idTipoClassificacao);
        return $this->getAdapter()->fetchPairs($sql);
    }
    
}

