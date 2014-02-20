<?php

namespace Service\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="service")
 */
class Service {
    
    /**
     * @ORM\Id
     * @ORM\Column(name="service_id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var integer
     */
    protected $serviceId;

    /**
     * @ORM\Column(name="service_name", type="string")
     */
    protected $serviceName;
    
    /**
     * @ORM\Column(name="service_price", type="decimal", precision=2)
     */
    protected $servicePrice;
    
    /**
     * @ORM\Column(name="service_promotional_price", type="decimal", precision=2)
     */
    protected $servicePromotionalPrice;
    
    /**
     * @ORM\Column(name="service_notes", type="text")
     */
    protected $serviceNotes;
    
    /**
     * @ORM\Column(name="service_date", type="datetime")
     */
    protected $serviceDate;
    
    /**
     * @ORM\Column(name="service_promotional", type="boolean")
     */
    protected $servicePromotional;
    
    /**
     * @ORM\Column(name="service_active", type="boolean")
     */
    protected $serviceActive;
    
    /**
     * @ORM\OneToOne(targetEntity="Company\Entity\Company", cascade={"persist"})
     * @ORM\JoinColumn(name="company_id", referencedColumnName="company_id")
     */
    protected $companyId;
    
    /**
     * @ORM\OneToOne(targetEntity="Unit\Entity\Unit", cascade={"persist"})
     * @ORM\JoinColumn(name="unit_id", referencedColumnName="unit_id")
     */
    protected $unitId;
    
    /**
     * @ORM\OneToOne(targetEntity="Category\Entity\Category", cascade={"persist"})
     * @ORM\JoinColumn(name="category_id", referencedColumnName="category_id")
     */
    protected $categoryId;
    
    
    public function __construct() {
        $this->serviceDate = new \DateTime("now");
    }
    
    public function getServiceId() {
        return $this->serviceId;
    }

    public function setServiceId($serviceId) {
        $this->serviceId = $serviceId;
        return $this;
    }

    public function getServiceName() {
        return $this->serviceName;
    }

    public function setServiceName($serviceName) {
        $this->serviceName = $serviceName;
        return $this;
    }

    public function getServicePrice() {
        return $this->servicePrice;
    }

    public function setServicePrice($servicePrice) {
        $this->servicePrice = $servicePrice;
        return $this;
    }

    public function getServicePromotionalPrice() {
        return $this->servicePromotionalPrice;
    }

    public function setServicePromotionalPrice($servicePromotionalPrice) {
        $this->servicePromotionalPrice = $servicePromotionalPrice;
        return $this;
    }

    public function getServiceNotes() {
        return $this->serviceNotes;
    }

    public function setServiceNotes($serviceNotes) {
        $this->serviceNotes = $serviceNotes;
        return $this;
    }

    public function getServiceDate() {
        return $this->serviceDate;
    }

    public function setServiceDate($serviceDate) {
        $this->serviceDate = $serviceDate;
        return $this;
    }

    public function getServicePromotional() {
        return $this->servicePromotional;
    }

    public function setServicePromotional($servicePromotional) {
        $this->servicePromotional = $servicePromotional;
        return $this;
    }

    public function getServiceActive() {
        return $this->serviceActive;
    }

    public function setServiceActive($serviceActive) {
        $this->serviceActive = $serviceActive;
        return $this;
    }

    public function getCompanyId() {
        return $this->companyId;
    }

    public function setCompanyId($companyId) {
        $this->companyId = $companyId;
        return $this;
    }

    public function getUnitId() {
        return $this->unitId;
    }

    public function setUnitId($unitId) {
        $this->unitId = $unitId;
        return $this;
    }

    public function getCategoryId() {
        return $this->categoryId;
    }

    public function setCategoryId($categoryId) {
        $this->categoryId = $categoryId;
        return $this;
    }
}
