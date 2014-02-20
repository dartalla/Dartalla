<?php

namespace Employee\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class Employee extends EntityRepository {

    public function employeeList($companyId) {
        $result = $this->_em->createQuery(
                "SELECT e,p FROM {$this->_entityName} e 
                    JOIN e.person p 
                    WHERE e.companyId = {$companyId}
                    ORDER BY p.personName")
                        ->getResult();
        return $result;
    }

}