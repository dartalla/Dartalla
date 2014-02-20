<?php

namespace Company\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class Company extends EntityRepository {

    public function companyList() {
        $result = $this->_em->createQuery(
                        "SELECT c
                        FROM {$this->_entityName} c 
                        ORDER BY c.companyFancyName"
                )
                ->getResult();
        return $result;
    }

}