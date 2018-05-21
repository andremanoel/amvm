<?php

class Application_Model_Contato extends Zend_Db_Table_Abstract
{
    protected $_name    = 'tb_contato';
    protected  $_primary = 'id_contato';
    
    /**
     * Busca todos os contatos enviados pelo sistema
     */
    public function getAll() 
    {
        $sql = $this->select();
        $sql->order('data_cadastro DESC');
        return $this->getAdapter()->fetchAll($sql, null, Zend_Db::FETCH_OBJ);
    }
    
}

