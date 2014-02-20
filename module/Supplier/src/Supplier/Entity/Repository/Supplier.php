<?php

namespace Supplier\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class Supplier extends EntityRepository {

    public function supplierList($companyId) {
        $result = $this->_em->createQuery(
                "SELECT s,p 
                    FROM {$this->_entityName} s 
                        JOIN s.person p 
                    WHERE s.companyId = {$companyId}
                        ORDER BY p.personName")
                        ->getResult();
        return $result;
    }

}