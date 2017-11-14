<?php

class Core_Auth_Adapter implements Zend_Auth_Adapter_Interface
{

    protected $_username;

    protected $_password;

    protected $_codeResult;

    /**
     * Nome sessão para Usuários do Portal
     *
     * @var string
     */
    static $nameSessionStorage = 'amvm';

    /**
     * Sets username and password for authentication
     *
     * @return void
     */
    public function __construct($username, $password)
    {
        $this->setUsername($username);
        $this->setPassword($password);
        $auth = Zend_Auth::getInstance();
        $auth->clearIdentity();
        
        return $this->authenticate();
    }

    /**
     * Performs an authentication attempt
     * @return Zend_Auth_Result
     */
    public function authenticate()
    {
        // create adapter db
        $authenticationAdapter = new Zend_Auth_Adapter_DbTable(
            Zend_Db_Table::getDefaultAdapter(),
            'tb_usuario',
            'login',
            'senha'
        );
        
        Zend_Session::rememberMe(14400);
        $authenticationAdapter->setIdentity($this->getUsername())
                              ->setCredential($this->getPassword());
        
        try {
            $result = $authenticationAdapter->authenticate();
            
            $this->setCodeResult($result->getCode());
            $sucessoAutenticacao = false;
            
            switch ($result->getCode()) {
                
                case Zend_Auth_Result::SUCCESS:
                    // modificando a sessão do usuário
                    $auth = Zend_Auth::getInstance();
                    $auth->setStorage(Zend_Auth::getInstance()->getStorage());
                    
                    // recuperando os dados do usuário
                    $registroUsuario = $authenticationAdapter->getResultRowObject();
                    
                    // setando a flag para autenticação
                    $sucessoAutenticacao = true;
                break;
            }
        } catch (Exception $e) {
            throw $e;
        }
        
        // escreve na sessão
        if ($sucessoAutenticacao) {
            $storage = Zend_Auth::getInstance()->getStorage();
            $storage->write($registroUsuario);
            
            return Zend_Auth_Result::SUCCESS;
        }
        return Zend_Auth_Result::FAILURE;
    }

    /**
     *
     * @return the $_username
     */
    public function getUsername()
    {
        return $this->_username;
    }

    /**
     *
     * @return the $_password
     */
    public function getPassword()
    {
        return $this->_password;
    }

    /**
     *
     * @return the $_codeResult
     */
    public function getCodeResult()
    {
        return $this->_codeResult;
    }

    /**
     *
     * @param field_type $_username
     */
    public function setUsername($_username)
    {
        $this->_username = $_username;
    }

    /**
     *
     * @param field_type $_password
     */
    public function setPassword($_password)
    {
        $this->_password = $_password;
    }

    /**
     *
     * @param field_type $_codeResult
     */
    public function setCodeResult($_codeResult)
    {
        $this->_codeResult = $_codeResult;
    }

    static function getUsuarioLogado()
    {
        $storage = Zend_Auth::getInstance()->getStorage();
        Zend_Auth::getInstance()->setStorage($storage);
        return Zend_Auth::getInstance()->getIdentity();
    }
}