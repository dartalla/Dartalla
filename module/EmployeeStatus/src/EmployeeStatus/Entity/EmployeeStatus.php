<?php

namespace EmployeeStatus\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="employee_status")
 */
class EmployeeStatus {
    
    /**
     * @ORM\Id
     * @ORM\Column(name="employee_status_id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var integer
     */
    protected $employeeStatusId;

    /**
     * @ORM\Column(name="employee_status_name", type="string")
     * @var string
     */
    protected $employeeStatusName;
    
   
    /**
     * 
     * @return integer
     */
    public function getEmployeeStatusId() {
        return $this->employeeStatusId;
    }

    /**
     * 
     * @param integer $employeeStatusId
     */
    public function setEmployeeStatusId($employeeStatusId) {
        $this->employeeStatusId = $employeeStatusId;
        return $this;
    }
    
    /**
     * 
     * @return string
     */
    public function getEmployeeStatusName() {
        return $this->employeeStatusName;
    }

    /**
     * 
     * @param string $employeeStatusName
     */
    public function setEmployeeStatusName($employeeStatusName) {
        $this->employeeStatusName = $employeeStatusName;
        return $this;
    }
}
