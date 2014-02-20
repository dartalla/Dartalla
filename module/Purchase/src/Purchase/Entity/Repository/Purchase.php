<?php

namespace Purchase\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class Purchase extends EntityRepository {

    public function getTotal() {
        $result = $this->_em->createQuery("SELECT SUM(p.purchaseTotal) total FROM {$this->_entityName} p")
                        ->getResult();
        foreach ($result as &$value) {
            $value = $value;
        }
        return $value;
    }
    
    public function getMonthTotal() {
        $daysOfMonth = date('t');
        $dateFrom = date('Y-m') . '-1';
        $dateTo = date('Y-m') . '-' . $daysOfMonth;
        $result = $this->_em->createQuery("
            SELECT SUM(p.purchaseTotal) monthTotal 
            FROM {$this->_entityName} p
            WHERE p.purchaseDate BETWEEN '{$dateFrom}' AND '{$dateTo}'")
                        ->getResult();
        foreach ($result as &$value) {
            $value = $value;
        }
        return $value;
    }
    
    public function getTotalOfDay($date) {
        $result = $this->_em->createQuery("
            SELECT SUM(p.purchaseTotal) totalOfDay 
            FROM {$this->_entityName} p
            WHERE p.purchaseDate = '{$date}'")
                        ->getResult();
        foreach ($result as &$value) {
            $value = $value;
        }
        return $value;
    }
}