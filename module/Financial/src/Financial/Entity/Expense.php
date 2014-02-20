<?php

namespace Financial\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Financial\Entity\Repository\Expense")
 * @ORM\Table(name="expense")
 */
class Expense {
    
    /**
     * @ORM\Id
     * @ORM\Column(name="expense_id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $expenseId;
    
    /**
     * @ORM\OneToOne(targetEntity="Financial\Entity\Launch", cascade={"all"})
     * @ORM\JoinColumn(name="launch_id", referencedColumnName="launch_id")
     */
    protected $launch;
    
    /**
     * @ORM\OneToOne(targetEntity="Supplier\Entity\Supplier", cascade={"persist"})
     * @ORM\JoinColumn(name="supplier_id", referencedColumnName="supplier_id")
     */
    protected $supplierId;
    
    /**
     * @ORM\OneToOne(targetEntity="Company\Entity\Company", cascade={"persist"})
     * @ORM\JoinColumn(name="company_id", referencedColumnName="company_id")
     */
    protected $companyId;
    
    public function __construct() {
        $this->launch = new Launch();
    }
    
    public function getExpenseId() {
        return $this->expenseId;
    }

    public function setExpenseId($expenseId) {
        $this->expenseId = $expenseId;
        return $this;
    }

    public function getLaunch() {
        return $this->launch;
    }

    public function setLaunch(Launch $launch) {
        $this->launch = $launch;
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
}
