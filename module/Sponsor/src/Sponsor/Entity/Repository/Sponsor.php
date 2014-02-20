<?php

namespace Sponsor\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class Sponsor extends EntityRepository {

    public function sponsorList($companyId) {
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

}