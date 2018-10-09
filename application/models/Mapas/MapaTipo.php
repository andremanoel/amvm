<?php

class Application_Model_Mapas_MapaTipo extends Zend_Db_Table_Abstract
{
    protected $_name    = 'tb_mapa_tipo';
    protected  $_primary = 'id_mapa_tipo';
    
    
    public function getTipos()
    {
        $sql = $this->getAdapter()->select();
        $sql->from($this->_name, array('id_mapa_tipo', 'nome'));
        return $this->getAdapter()->fetchPairs($sql);
    }

}

