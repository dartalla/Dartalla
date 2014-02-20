<?php

namespace Seller\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class Seller extends EntityRepository {

    public function sellerList($companyId) {
        $result = $this->_em->createQuery(
                        "SELECT s,p 
                            FROM {$this->_entityName} s 
                                JOIN s.person p 
                            WHERE s.companyId = {$companyId}
                                ORDER BY p.personName"
                )
                ->getResult();
        return $result;
    }

}