<?php

namespace Business\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="Business\Entity\Repository\ServiceOrder")
 * @ORM\Table(name="service_order")
 */
class ServiceOrder {
    
    /**
     * @ORM\Id
     * @ORM\Column(name="service_order_id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $serviceOrderId;
    
    /**
     * @ORM\OneToOne(targetEntity="Business\Entity\Order", cascade={"all"})
     * @ORM\JoinColumn(name="order_id", referencedColumnName="order_id")
     */
    protected $orderId;
    
    /**
     * @ORM\OneToMany(targetEntity="Business\Entity\ServiceOrderDetail", mappedBy="serviceOrder", cascade={"all"})
     */
    protected $serviceOrderDetails;
    
    public function __construct() {
        $this->orderId              = new Order();
        $this->serviceOrderDetails  = new ArrayCollection();
    }
    
    public function getServiceOrderId() {
        return $this->saleId;
    }

    public function setServiceOrderId($serviceOrderId) {
        $this->saleId = $serviceOrderId;
        return $this;
    }

    public function getOrderId() {
        return $this->orderId;
    }

    public function setOrderId($orderId) {
        $this->orderId = $orderId;
        return $this;
    }

    public function getServiceOrderDetails() {
        return $this->saleDetails;
    }

    public function addServiceOrderDetails($serviceOrderDetails) {
        $this->saleDetails[] = $serviceOrderDetails;
        return $this;
    }
}
