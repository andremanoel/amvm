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
    public function __construct($username, $password, $cryptPassword = true)
    {
        $this->setUsername($username);
        $this->setPassword($password);
        
        // limpando a sessão anterior
        $auth = Zend_Auth::getInstance();
        $auth->clearIdentity();
        
        return $this->authenticate($cryptPassword);
    }

    /**
     * Performs an authentication attempt
     *
     * @throws Zend_Auth_Adapter_Exception If authentication cannot
     *         be performed
     * @return Zend_Auth_Result
     */
    public function authenticate($cryptPassword = true)
    {
        // create adapter db
        $authenticationAdapter = new Zend_Auth_Adapter_DbTable(Zend_Db_Table::getDefaultAdapter());
        
        // configure the instance with setter methods
        $authenticationAdapter->setTableName('tb_usuario')
            ->setIdentityColumn('email_usuario')
            ->setCredentialColumn('senha_usuario');
                                                    
        $credentialNew = hash('whirlpool', $this->_password);
        $authenticationAdapter->setIdentity($this->_username)->setCredential($credentialNew);
        
        try {
            $result = $authenticationAdapter->authenticate();
            
            $this->setCodeResult($result->getCode());
            $sucessoAutenticacao = false;
            
            switch ($result->getCode()) {
                
                case Zend_Auth_Result::SUCCESS:
                    // modificando a sessão do usuário
                    $auth = Zend_Auth::getInstance();
                    $auth->setStorage(self::getStorage());
                    
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
            $modelUsuario = new Administrador_Model_Usuario();
                    
            // dados da sessão
            Zend_Session::rememberMe(14400); 
            $idSessao = Zend_Session::getId();
            $objUsuarioBanco->session_id = $idSessao;
            $objUsuarioBanco->save();
            
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
        $storage = self::getStorage();
        Zend_Auth::getInstance()->setStorage($storage);
        return Zend_Auth::getInstance()->getIdentity();
    }
}