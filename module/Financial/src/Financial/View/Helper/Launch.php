<?php

namespace Financial\View\Helper;

use Zend\View\Helper\AbstractHelper;

class Launch extends AbstractHelper {

    protected $entityManager;
    protected $entity;

    public function __invoke($launchId = null) {
        $result = null;
        if ($launchId) {
            $isRevenue = $this->getEntityManager()
                    ->getRepository('Financial\Entity\Revenue')
                    ->createQueryBuilder('r')
                    ->where("r.launch = {$launchId}")
                    ->getQuery()
                    ->getOneOrNullResult();
            $result = $isRevenue;
            if (!$isRevenue) {
                $isExpense = $this->getEntityManager()
                        ->getRepository('Financial\Entity\Expense')
                        ->createQueryBuilder('e')
                        ->where("e.launch = {$launchId}")
                        ->getQuery()
                        ->getOneOrNullResult();
                $result = $isExpense;
            }
            return $result;
        }
        return false;
    }

    /**
     * 
     * @return \Doctrine\ORM\EntityManager
     */
    public function getEntityManager() {
        return $this->entityManager;
    }

    /**
     * 
     * @return \Financial\Entity\Launch
     */
    public function getEntity() {
        return $this->entity;
    }

    /**
     * 
     * @param \Doctrine\ORM\EntityManager $entityManager
     */
    public function setEntityManager($entityManager) {
        $this->entityManager = $entityManager;
    }

    /**
     * 
     * @param \Financial\Entity\Launch $entity
     */
    public function setEntity($entity) {
        $this->entity = $entity;
    }

}
