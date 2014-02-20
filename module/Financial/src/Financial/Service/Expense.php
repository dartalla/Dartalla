<?php

namespace Financial\Service;

class Expense {
    
    /**
     * @var Doctrine\ORM\EntityManager
     */
    protected $entityManager;
    
    /**
     * @var string
     */
    protected $repository;
    
    public function getPaginationResult($companyId) {
        return $this->getEntityManager()
                ->getRepository($this->getRepository())
                ->getPaginationResult($companyId);
    }
    
    public function getExpenseTotal($companyId) {
        return $this->getEntityManager()
                ->getRepository($this->getRepository())
                ->getExpenseTotal($companyId);
    }
    
    public function getExpenseTotalByDate($date = null) {
        return $this->getEntityManager()
                ->getRepository($this->getRepository())
                ->getExpenseTotalByDate($date);
    }
    
    public function find($id) {
        return $this->getEntityManager()
                ->find($this->getRepository(), $id);
    }
    
    public function findAll() {
        return $this->getEntityManager()
                ->getRepository($this->getRepository())
                ->findAll();
    }
    
    public function findOneBy(array $criteria, array $orderBy = null) {
        return $this->getEntityManager()
                ->getRepository($this->getRepository())
                ->findOneBy($criteria, $orderBy);
    }
    
    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null) {
        return $this->getEntityManager()
                ->getRepository($this->getRepository())
                ->findBy($criteria, $orderBy, $limit, $offset);
    }
    
    /**
     * @return Doctrine\ORM\EntityManager
     */
    public function getEntityManager() {
        return $this->entityManager;
    }

    /**
     * @param Doctrine\ORM\EntityManager $entityManager
     * @return \Financial\Service\Expense
     */
    public function setEntityManager($entityManager) {
        $this->entityManager = $entityManager;
        return $this;
    }

    /**
     * @return string
     */
    public function getRepository() {
        if (!isset($this->repository)) {
            $this->setRepository('Financial\Entity\Expense');
        }
        return $this->repository;
    }

    /**
     * @param string $repository
     * @return \Financial\Service\Expense
     */
    public function setRepository($repository) {
        $this->repository = $repository;
        return $this;
    }
}
