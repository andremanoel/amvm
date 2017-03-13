<?php

namespace Application\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\Entity
 * @ORM\Table(name="tb_planilha")
 */
class Planilha
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id_planilha")
     */
    protected $idPlanilha;

    /**
     * @ORM\Column(name="data_upload")
     */
    protected $dataUpload;

    /**
     * @ORM\Column(name="url_arquivo")
     */
    protected $urlArquivo;

    /**
     * @ORM\Column(name="fk_id_usuario")
     */
    protected $idUsuario;

    /**
     * @return mixed
     */
    public function getIdPlanilha()
    {
        return $this->idPlanilha;
    }

    /**
     * @param mixed $idPlanilha
     */
    public function setIdPlanilha($idPlanilha)
    {
        $this->idPlanilha = $idPlanilha;
    }

    /**
     * @return mixed
     */
    public function getDataUpload()
    {
        return $this->dataUpload;
    }

    /**
     * @param mixed $dataUpload
     */
    public function setDataUpload($dataUpload)
    {
        $this->dataUpload = $dataUpload;
    }

    /**
     * @return mixed
     */
    public function getUrlArquivo()
    {
        return $this->urlArquivo;
    }

    /**
     * @param mixed $urlArquivo
     */
    public function setUrlArquivo($urlArquivo)
    {
        $this->urlArquivo = $urlArquivo;
    }

    /**
     * @return mixed
     */
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    /**
     * @param mixed $idUsuario
     */
    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;
    }
}