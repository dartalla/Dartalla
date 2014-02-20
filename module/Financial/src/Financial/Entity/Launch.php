<?php

namespace Financial\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="launch")
 */
class Launch {
    
    /**
     * @ORM\Id
     * @ORM\Column(name="launch_id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $launchId;
    
    /**
     * @ORM\Column(name="launch_date", type="date")
     */
    protected $launchDate;
    
    /**
     * @ORM\Column(name="launch_number", type="string")
     */
    protected $launchNumber;
    
    /**
     * @ORM\Column(name="launch_value", type="decimal", precision=2)
     */
    protected $launchValue;
    
    /**
     * @ORM\Column(name="launch_description", type="string")
     */
    protected $launchDescription;
    
    /**
     * @ORM\OneToOne(targetEntity="CurrentAccount\Entity\CurrentAccount", cascade={"persist"})
     * @ORM\JoinColumn(name="current_account_id", referencedColumnName="current_account_id")
     */
    protected $currentAccountId;
    
    /**
     * @ORM\OneToOne(targetEntity="Department\Entity\Department", cascade={"persist"})
     * @ORM\JoinColumn(name="department_id", referencedColumnName="department_id")
     */
    protected $departmentId;
    
    /**
     * @ORM\OneToOne(targetEntity="AccountingItem\Entity\AccountingItem", cascade={"persist"})
     * @ORM\JoinColumn(name="accounting_item_id", referencedColumnName="accounting_item_id")
     */
    protected $accountingItemId;
    
    public function __construct() {
        $this->launchDate = new \DateTime('now');
        $this->launchValue = 0;
    }
    
    public function getLaunchId() {
        return $this->launchId;
    }

    public function setLaunchId($launchId) {
        $this->launchId = $launchId;
        return $this;
    }

    public function getLaunchDate() {
        return $this->launchDate;
    }

    public function setLaunchDate($launchDate) {
        $this->launchDate = $launchDate;
        return $this;
    }

    public function getLaunchNumber() {
        return $this->launchNumber;
    }

    public function setLaunchNumber($launchNumber) {
        $this->launchNumber = $launchNumber;
        return $this;
    }

    public function getLaunchValue() {
        return $this->launchValue;
    }

    public function setLaunchValue($launchValue) {
        $this->launchValue = $launchValue;
        return $this;
    }

    public function getLaunchDescription() {
        return $this->launchDescription;
    }

    public function setLaunchDescription($launchDescription) {
        $this->launchDescription = $launchDescription;
        return $this;
    }

    public function getCurrentAccountId() {
        return $this->currentAccountId;
    }

    public function setCurrentAccountId($currentAccountId) {
        $this->currentAccountId = $currentAccountId;
        return $this;
    }

    public function getDepartmentId() {
        return $this->departmentId;
    }

    public function setDepartmentId($departmentId) {
        $this->departmentId = $departmentId;
        return $this;
    }
    
    public function getAccountingItemId() {
        return $this->accountingItemId;
    }

    public function setAccountingItemId($accountingItemId) {
        $this->accountingItemId = $accountingItemId;
        return $this;
    }
}
