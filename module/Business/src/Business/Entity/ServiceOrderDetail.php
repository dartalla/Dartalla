<?php

namespace Business\Entity;

use Doctrine\ORM\Mapping as ORM;
use Service\Entity\Service;

/**
 * @ORM\Entity
 * @ORM\Table(name="service_order_detail")
 */
class ServiceOrderDetail {
    
    /**
     * @ORM\Id
     * @ORM\Column(name="service_order_detail_id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $serviceOrderDetailId;
    
    /**
     * @ORM\Column(name="service_order_detail_quantity", type="integer")
     */
    protected $serviceOrderDetailQuantity;
    
    /**
     * @ORM\Column(name="service_order_detail_price", type="decimal", precision=2)
     */
    protected $serviceOrderDetailPrice;
    
    /**
     * @ORM\Column(name="service_order_detail_discount", type="decimal", precision=2)
     */
    protected $serviceOrderDetailDiscount;
    
    /**
     * @ORM\Column(name="service_order_detail_total", type="decimal", precision=2)
     */
    protected $serviceOrderDetailTotal;
    
    /**
     * @ORM\OneToOne(targetEntity="Service\Entity\Service", cascade={"persist"})
     * @ORM\JoinColumn(name="service_id", referencedColumnName="service_id")
     */
    protected $serviceId;
    
    /**
     * @ORM\ManyToOne(targetEntity="ServiceOrder", inversedBy="serviceOrderDetail")
     * @ORM\JoinColumn(name="service_order_id", referencedColumnName="service_order_id")
     */
    protected $serviceOrder;
    
    public function __construct() {
        $this->serviceId = new Service();
    }
    
    public function getServiceOrderDetailId() {
        return $this->serviceOrderDetailId;
    }

    public function setServiceOrderDetailId($serviceOrderDetailId) {
        $this->serviceOrderDetailId = $serviceOrderDetailId;
        return $this;
    }

    public function getServiceOrderDetailQuantity() {
        return $this->saleDetailQuantity;
    }

    public function setServiceOrderDetailQuantity($serviceOrderDetailQuantity) {
        $this->saleDetailQuantity = $serviceOrderDetailQuantity;
        return $this;
    }

    public function getServiceOrderDetailPrice() {
        return $this->saleDetailPrice;
    }

    public function setServiceOrderDetailPrice($serviceOrderDetailPrice) {
        $this->saleDetailPrice = $serviceOrderDetailPrice;
        return $this;
    }

    public function getServiceOrderDetailDiscount() {
        return $this->saleDetailDiscount;
    }

    public function setServiceOrderDetailDiscount($serviceOrderDetailDiscount) {
        $this->saleDetailDiscount = $serviceOrderDetailDiscount;
        return $this;
    }

    public function getServiceOrderDetailTotal() {
        return $this->saleDetailTotal;
    }

    public function setServiceOrderDetailTotal($serviceOrderDetailTotal) {
        $this->saleDetailTotal = $serviceOrderDetailTotal;
        return $this;
    }

    public function getServiceId() {
        return $this->serviceId;
    }

    public function setServiceId($serviceId) {
        $this->serviceId = $serviceId;
        return $this;
    }
    
    public function getServiceOrder() {
        return $this->serviceOrder;
    }

    public function setServiceOrder($serviceOrder) {
        $this->serviceOrder = $serviceOrder;
        return $this;
    }
}
