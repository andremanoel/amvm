<?php

class Application_Model_User extends Zend_Db_Table_Abstract
{
    protected $_name    = 'tb_usuario';
    
    protected  $_primary = 'id_usuario';
}

