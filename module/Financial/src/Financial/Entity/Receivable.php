<?php

namespace Financial\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Financial\Entity\Repository\Receivable")
 * @ORM\Table(name="receivable")
 */
class Receivable {
    
    /**
     * @ORM\Id
     * @ORM\Column(name="receivable_id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $receivableId;
    
    /**
     * @ORM\OneToOne(targetEntity="Customer\Entity\Customer", cascade={"persist"})
     * @ORM\JoinColumn(name="customer_id", referencedColumnName="customer_id")
     */
    protected $customerId;
    
    /**
     * @ORM\Column(name="company_id", type="integer")
     */
    protected $companyId;

    /**
     * @ORM\OneToOne(targetEntity="Financial\Entity\Account", cascade={"all"})
     * @ORM\JoinColumn(name="account_id", referencedColumnName="account_id")
     */
    protected $account;
    
    public function __construct() {
        $this->account      = new Account();
    }
    
    public function getReceivableId() {
        return $this->receivableId;
    }

    public function setReceivableId($receivableId) {
        $this->receivableId = $receivableId;
        return $this;
    }

    public function getCustomerId() {
        return $this->customerId;
    }

    public function setCustomerId($customerId) {
        $this->customerId = $customerId;
        return $this;
    }

    public function getCompanyId() {
        return $this->companyId;
    }

    public function setCompanyId($companyId) {
        $this->companyId = $companyId;
        return $this;
    }

    public function getAccount() {
        return $this->account;
    }

    public function setAccount($account) {
        $this->account = $account;
        return $this;
    }
}
