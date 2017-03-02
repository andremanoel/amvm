<?php

namespace Application\Service;


use Application\Model\Repository\AbstractRepository;

class AbstractService
{

    /**
     * @var AbstractRepository
     */
    private $repository;


    /**
     * @return mixed
     */
    public function getRepository()
    {
        return $this->repository;
    }

    /**
     * @param mixed $repository
     * @return AbstractService
     */
    public function setRepository($repository)
    {
        $this->repository = $repository;
        return $this;
    }

    public function persist($data)
    {
        try {
            $this->getRepository()->persist($data);
        } catch(\Exception $e) {
            throw $e;
        }
    }

    public function remove($id)
    {
        try {
            $this->getRepository()->remove($id);
        } catch(\Exception $e) {
            throw $e;
        }
    }

    public function find($id)
    {
        try {
            $this->getRepository()->find($id);
        } catch(\Exception $e) {
            throw $e;
        }
    }

    public function findAll()
    {
        return $this->getRepository()->findAll();
    }

    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
    {
        return $this->getRepository()->findAll($criteria, $orderBy, $limit, $offset);
    }

    public function findOneBy(array $criteria, array $orderBy = null)
    {
        return $this->getRepository()->findOneBy($criteria, $orderBy);
    }

}