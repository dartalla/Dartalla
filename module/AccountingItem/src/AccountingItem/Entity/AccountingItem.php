<?php

namespace AccountingItem\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="accounting_item")
 */
class AccountingItem {
    
    /**
     * @ORM\Id
     * @ORM\Column(name="accounting_item_id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var integer
     */
    protected $accountingItemId;

    /**
     * @ORM\Column(name="accounting_item_name", type="string")
     * @var string
     */
    protected $accountingItemName;
    
    /**
     * @ORM\Column(name="accounting_item_type", type="boolean")
     * @var boolean
     */
    protected $accountingItemType;
    
    /**
     * @ORM\OneToOne(targetEntity="Company\Entity\Company", cascade={"persist"})
     * @ORM\JoinColumn(name="company_id", referencedColumnName="company_id")
     */
    protected $companyId;
    
    /**
     * 
     * @return integer
     */
    public function getAccountingItemId() {
        return $this->accountingItemId;
    }

    /**
     * 
     * @param integer $accountingItemId
     */
    public function setAccountingItemId($accountingItemId) {
        $this->accountingItemId = $accountingItemId;
        return $this;
    }
    
    /**
     * 
     * @return string
     */
    public function getAccountingItemName() {
        return $this->accountingItemName;
    }

    /**
     * 
     * @param string $accountingItemName
     */
    public function setAccountingItemName($accountingItemName) {
        $this->accountingItemName = $accountingItemName;
        return $this;
    }
    
    /**
     * 
     * @return boolean
     */
    public function getAccountingItemType() {
        return $this->accountingItemType;
    }

    /**
     * 
     * @param string $accountingItemType
     */
    public function setAccountingItemType($accountingItemType) {
        $this->accountingItemType = $accountingItemType;
        return $this;
    }
    
    public function getCompanyId() {
        return $this->companyId;
    }

    public function setCompanyId($companyId) {
        $this->companyId = $companyId;
        return $this;
    }
}
