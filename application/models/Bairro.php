<?php

class Application_Model_Bairro extends Zend_Db_Table_Abstract
{
    protected $_name    = 'tb_bairro';
    
    protected  $_primary = 'id_bairro';
    
    
    public function sincronizarBairros($dados)
    {
        
    }

}

