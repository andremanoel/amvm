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
        return $this->getAdapter()->fetchPairs($sql);
    }

}

