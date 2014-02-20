<?php

namespace Business\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class ServiceOrder extends EntityRepository {

    public function getServiceOrderTotal() {
        $result = $this->_em->createQuery("SELECT SUM(a.accountValue) total FROM {$this->_entityName} r JOIN r.account a")
                        ->getResult();
        foreach ($result as &$value) {
            $value = $value;
        }
        return $value;
    }

}