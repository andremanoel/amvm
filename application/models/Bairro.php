<?php

class Application_Model_Bairro extends Zend_Db_Table_Abstract
{
    protected $_name    = 'tb_bairro';
    
    protected  $_primary = 'id_bairro';
    
    
    public function sincronizarBairros($dados)
    {
        
    }
    
    public function getBairros()
    {
        $sql = $this->getAdapter()->select();
        $sql->from($this->_name, array('id_bairro', 'nome'))
            ->order('nome ASC');
        
        // Ignorando Bairro Parque Timbira * Pouca população
        $sql->where('id_bairro NOT IN (?)',[136]);
        return $this->getAdapter()->fetchPairs($sql);
    }

}

