<?php

namespace Department\Entity;

use Doctrine\ORM\Mapping as ORM;
use Company\Entity\Company;

/**
 * @ORM\Entity
 * @ORM\Table(name="department")
 */
class Department {
    
    /**
     * @ORM\Id
     * @ORM\Column(name="department_id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var integer
     */
    protected $departmentId;

    /**
     * @ORM\Column(name="department_name", type="string")
     * @var string
     */
    protected $departmentName;
    
    /**
     * @ORM\Column(name="company_id", type="integer")
     */
    protected $company;
   
    /**
     * 
     * @return integer
     */
    public function getDepartmentId() {
        return $this->departmentId;
    }

    /**
     * 
     * @param integer $departmentId
     */
    public function setDepartmentId($departmentId) {
        $this->departmentId = $departmentId;
        return $this;
    }
    
    /**
     * 
     * @return string
     */
    public function getDepartmentName() {
        return $this->departmentName;
    }

    /**
     * 
     * @param string $departmentName
     */
    public function setDepartmentName($departmentName) {
        $this->departmentName = $departmentName;
        return $this;
    }
    
    public function getCompany() {
        return $this->company;
    }

    public function setCompany($company) {
        $this->company = $company;
        return $this;
    }
}
