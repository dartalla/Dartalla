<?php

namespace Financial\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Financial\Entity\Repository\Payable")
 * @ORM\Table(name="payable")
 */
class Payable {
    
    /**
     * @ORM\Id
     * @ORM\Column(name="payable_id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $payableId;
    
    /**
     * @ORM\OneToOne(targetEntity="Supplier\Entity\Supplier", cascade={"all"})
     * @ORM\JoinColumn(name="supplier_id", referencedColumnName="supplier_id")
     */
    protected $supplierId;
    
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
        $this->account = new Account();
    }
    
    public function getPayableId() {
        return $this->payableId;
    }

    public function setPayableId($payableId) {
        $this->payableId = $payableId;
        return $this;
    }

    public function getSupplierId() {
        return $this->supplierId;
    }

    public function setSupplierId($supplierId) {
        $this->supplierId = $supplierId;
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
