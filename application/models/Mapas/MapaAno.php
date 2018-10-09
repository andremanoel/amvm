<?php

class Application_Model_Mapas_MapaAno extends Zend_Db_Table_Abstract
{
    protected $_name    = 'tb_mapa_ano';
    protected  $_primary = 'id_mapa_ano';
    
    public function getAnos()
    {
        $sql = $this->getAdapter()->select();
        $sql->from($this->_name, array('id_mapa_ano', 'ano'))
            ->order('ano ASC');
        return $this->getAdapter()->fetchPairs($sql);
    }

}

