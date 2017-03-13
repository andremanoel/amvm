<?php

namespace Application\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\Entity
 * @ORM\Table(name="tb_publicacao")
 */
class Publicacao
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id_publicacao")
     */
    protected $idPublicacao;

    /**
     * @ORM\Column(name="titulo")
     */
    protected $titulo;

    /**
     * @ORM\Column(name="descricao")
     */
    protected $descricao;

    /**
     * @ORM\Column(name="nome_arquivo")
     */
    protected $nomeArquivo;

    /**
     * @ORM\Column(name="fk_id_usuario")
     */
    protected $idUsuario;

    /**
     * @return mixed
     */
    public function getIdPublicacao()
    {
        return $this->idPublicacao;
    }

    /**
     * @param mixed $idPublicacao
     */
    public function setIdPublicacao($idPublicacao)
    {
        $this->idPublicacao = $idPublicacao;
    }

    /**
     * @return mixed
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * @param mixed $titulo
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    /**
     * @return mixed
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * @param mixed $descricao
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

    /**
     * @return mixed
     */
    public function getNomeArquivo()
    {
        return $this->nomeArquivo;
    }

    /**
     * @param mixed $nomeArquivo
     */
    public function setNomeArquivo($nomeArquivo)
    {
        $this->nomeArquivo = $nomeArquivo;
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