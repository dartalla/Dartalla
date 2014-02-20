<?php

namespace Business\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class Sale extends EntityRepository {

    public function getSaleTotal() {
        $result = $this->_em->createQuery("SELECT SUM(a.accountValue) total FROM {$this->_entityName} r JOIN r.account a")
                        ->getResult();
        foreach ($result as &$value) {
            $value = $value;
        }
        return $value;
    }

}