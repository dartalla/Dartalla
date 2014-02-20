<?php

namespace Customer\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class Customer extends EntityRepository {

    public function customerList($companyId) {
        $result = $this->_em->createQuery(
                        "SELECT c,p 
                            FROM {$this->_entityName} c 
                                JOIN c.person p 
                            WHERE c.companyId = {$companyId}
                                ORDER BY p.personName"
                )
                ->getResult();
        return $result;
    }

    /**
     * Returns count of rows in table
     * 
     * @return integer
     */
    public function customerCount() {
        $result = $this->_em->getRepository($this->_entityName)
                ->createQueryBuilder('c')
                ->select('COUNT(c.customerId) AS customerCount')
                ->where('c.customerActive = true')
                ->getQuery()
                ->getSingleResult();
        return $result['customerCount'];
    }

    /**
     * Returns count of rows in table
     * 
     * @return integer
     */
    public function findLastCustomers($limit = 5) {
        $result = $this->_em->getRepository($this->_entityName)
                ->createQueryBuilder('c')
                ->select(array('p.personName', 'c.customerTimestamp'))
                ->join('c.person', 'p')
                ->where('c.customerActive = true')
                ->orderBy('c.customerTimestamp', 'DESC')
                ->setMaxResults($limit)
                ->getQuery()
                ->getResult();
        return $result;
    }

}