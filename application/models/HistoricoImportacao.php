<?php

class Application_Model_HistoricoImportacao extends Zend_Db_Table_Abstract
{
    protected $_name    = 'tb_historico_importacao';
    protected $_primary = 'id_historico_importacao';
    
    public function consulta($filtros) 
    {
        $sql = $this->getAdapter()->select();
        return $this->getAdapter()->fetchAll($sql);
    }
    
}

