<?php

namespace Person\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="business")
 */
class Business {

    /**
     * @ORM\Id
     * @ORM\Column(name="business_id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $businessId;

    /**
     * @ORM\Column(name="business_name", type="string")
     */
    protected $businessName;

    
    public function __construct() {}
    
    public function getBusinessId() {
        return $this->businessId;
    }

    public function setBusinessId($businessId) {
        $this->businessId = $businessId;
        return $this;
    }
    
    public function getBusinessName() {
        return $this->businessName;
    }

    public function setBusinessName($businessName) {
        $this->businessName = $businessName;
        return $this;
    }
}