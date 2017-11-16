<?php

/**
 * Core_Util_File
 * Manipulação de Arquivos
 *
 * @author André Manoel Lima da Silva Souza
 * @version 1.0
 * @category Core
 * @package  Core
 */
class Core_Util_File
{
    
    /**
     * Realiza o upload
     */
    static function upload($nome)
    {
        $arrRetorno = array('sucesso'=>false, 'mensagens'=> null, 'arquivo'=> null);
        $file = new Zend_File_Transfer_Adapter_Http();
        $file->setDestination(UPLOAD_PATH);
        
        if(is_uploaded_file($_FILES[$nome]['tmp_name'])){
            if (!$file->receive($nome)){
                $arrRetorno['mensagens']  = $file->getMessages[$nome];
                return $arrRetorno;
            }else{
                //Arquivo Enviado Com Sucesso
                //Realize As Ações Necessárias Com Os Dados
                $filename = $file->getFileName($nome);
                $arrRetorno['sucesso'] = true;
                $arrRetorno['arquivo'] = $filename;
                return $arrRetorno;
            }
        }
        return false;
    }
    
    /**
     * Retorna a extensão de um arquivo
     * @param string $nomeArquivo
     * @return string
     * @author André Manoel <andre@adsum.com.br>
     */
    static function getExtensao($nomeArquivo){
    	return strtolower( substr( $nomeArquivo, strrpos( $nomeArquivo, "." ) + 1 ) );
    }

    /*
     * Delete um arquivo no caminho especificado
     */
    static function excluirArquivo($caminho)
    {
        if (file_exists($caminho)){
            unlink($caminho);
        }
    }

    /**
     * Função para visualizar uma imagem
     * @param string  $path     Caminho absoluto da imagem no servidor
     * @param string  $mimetype Mimetype da imagem
     * @param boolean $download força o download do arquivo
     *
     * @return binário
     *
     * @example
     * Recuperar o path absoluto do arquivo e a extensão
     * Chamando o método:
     *    Core_Util_File::visualizarArquivo( $pathImagem, $extensao );
     **/
    static function visualizarArquivo( $path, $mimetype = null, $download = false, $nomeArquivo = ""){
    	//verifica se o arquivo existe
    	if( file_exists($path) ){
    		$tamanho_arquivo = filesize($path);
    
    		//verifica se deve ser realizado o download do arquivo
    		if( $download ){
    			header('Content-Type: octet/stream');
    			header('Content-Disposition: attachment;filename="'. $nomeArquivo .'";');
    			header('Content-Length: '.$tamanho_arquivo);
    			readfile($path);
    		}else{
    			$imgbinary = fread(fopen($path, "r"), $tamanho_arquivo);
    			header("Content-Type: $mimetype");
    			echo $imgbinary;
    		}
    	}else{
    		//não encontrou o arquivo
    		$pathNaoEncontrado = PUBLIC_PATH . "/images/thumb_foto_nao_carregada.jpg";
    		header('Content-length: 3439');
    		header('Content-type: image/jpg');
    		readfile($pathNaoEncontrado);
    	}
    	exit;
    }

}