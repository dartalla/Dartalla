<?php

namespace Financial\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Financial\Entity\Repository\Revenue")
 * @ORM\Table(name="revenue")
 */
class Revenue {
    
    /**
     * @ORM\Id
     * @ORM\Column(name="revenue_id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $revenueId;
    
    /**
     * @ORM\OneToOne(targetEntity="Financial\Entity\Launch", cascade={"all"})
     * @ORM\JoinColumn(name="launch_id", referencedColumnName="launch_id")
     */
    protected $launch;
    
    /**
     * @ORM\OneToOne(targetEntity="Customer\Entity\Customer", cascade={"persist"})
     * @ORM\JoinColumn(name="customer_id", referencedColumnName="customer_id")
     */
    protected $customerId;
    
    /**
     * @ORM\OneToOne(targetEntity="Company\Entity\Company", cascade={"persist"})
     * @ORM\JoinColumn(name="company_id", referencedColumnName="company_id")
     */
    protected $companyId;
    
    public function __construct() {
        $this->launch = new Launch();
    }
    
    public function getRevenueId() {
        return $this->revenueId;
    }

    public function setRevenueId($revenueId) {
        $this->revenueId = $revenueId;
        return $this;
    }

    public function getLaunch() {
        return $this->launch;
    }

    public function setLaunch($launch) {
        $this->launch = $launch;
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
}
