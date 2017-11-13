<?php

class Application_Model_Noticia extends Zend_Db_Table_Abstract
{
    protected $_name    = 'tb_noticia';
    
    protected  $_primary = 'id_noticia';
    
    public function buscarNoticias()
    {
        $sql = $this->select();
        return $this->getAdapter()->fetchAll($sql);
    }
}

