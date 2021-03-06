<?php

namespace Financial\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class Revenue extends EntityRepository {

    public function getPaginationResult($companyId) {
        return $this->_em->createQuery("
            SELECT e,l FROM {$this->_entityName} e
            JOIN e.launch l
            WHERE e.companyId = {$companyId}
            ORDER BY e.revenueId DESC
        ");
    }
    
    public function getRevenues($companyId, $date = null) {
        $where = null;
        if ($date) {
            $where = "'AND l.launchDate = '{$date}'";
        }
        return $this->_em->createQuery(
                "SELECT e,l FROM $this->_entityName e
                    JOIN e.launch l
                    WHERE e.companyId = {$companyId}
                    {$where}
                    ORDER BY r.revenueId DESC
                ")->getResult();
    }

    public function getRevenueTotal($companyId, $date = null) {
        $where = null;
        if ($date) {
            $where = "AND l.launchDate = '{$date}'";
        }
        $result = $this->_em->createQuery(
                        "SELECT SUM(l.launchValue) total 
                    FROM {$this->_entityName} r 
                    JOIN r.launch l
                    WHERE r.companyId = {$companyId}
                    {$where}
                        ORDER BY r.revenueId DESC
                    ")->getResult();
        foreach ($result as &$value) {
            $value = $value;
        }
        return $value;
    }
    
    public function getRevenueLastTotal($companyId) {
        $timestamp = mktime(0, 0, 0, date('m'), date('d') - 1, date('Y'));
        $date = date('Y-m-d', $timestamp);
        $where = null;
        if ($date) {
            $where = "AND l.launchDate BETWEEN '1900-1-1' AND '{$date}'";
        }
        $result = $this->_em->createQuery(
                        "SELECT SUM(l.launchValue) total 
                    FROM {$this->_entityName} r 
                    JOIN r.launch l
                    WHERE r.companyId = {$companyId}
                    {$where}
                    ")->getResult();
        foreach ($result as $value) {
            $value = $value;
        }
        return $value;
    }
}