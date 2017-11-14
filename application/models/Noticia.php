<?php

class Application_Model_Noticia extends Zend_Db_Table_Abstract
{
    protected $_name    = 'tb_noticia';
    
    protected  $_primary = 'id_noticia';
    
    public function buscarNoticias()
    {
        $sql = $this->select();
        return $this->getAdapter()->fetchAll($sql, null, Zend_Db::FETCH_OBJ);
    }
    
    public function buscarAdmin()
    {
        $sql = $this->getAdapter()->select();
        $sql->from(array('n'=>'tb_noticia'), array('n.*'))
            ->joinInner(array('u' => 'tb_usuario'), 'u.id_usuario = n.id_usuario_cadastro', array('u.nome'));
        return $this->getAdapter()->fetchAll($sql, null, Zend_Db::FETCH_OBJ); 
    }
    
}
