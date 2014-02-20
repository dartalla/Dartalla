<?php

namespace Business\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="Business\Entity\Repository\Sale")
 * @ORM\Table(name="sale")
 */
class Sale {
    
    /**
     * @ORM\Id
     * @ORM\Column(name="sale_id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $saleId;
    
    /**
     * @ORM\OneToOne(targetEntity="Business\Entity\Order", cascade={"all"})
     * @ORM\JoinColumn(name="order_id", referencedColumnName="order_id")
     */
    protected $order;
    
    /**
     * @ORM\OneToMany(targetEntity="Business\Entity\SaleDetail", mappedBy="sale", cascade={"all"})
     */
    protected $saleDetails;
    
    public function __construct() {
        $this->order        = new Order();
        $this->saleDetails  = new ArrayCollection();
    }
    
    public function getSaleId() {
        return $this->saleId;
    }

    public function setSaleId($saleId) {
        $this->saleId = $saleId;
        return $this;
    }

    public function getOrder() {
        return $this->order;
    }

    public function setOrder($order) {
        $this->order = $order;
        return $this;
    }

    public function getSaleDetails() {
        return $this->saleDetails;
    }

    public function addSaleDetails(SaleDetail $saleDetails) {
        $saleDetails->setSale($this);
        $this->saleDetails->add($saleDetails);
        return $this;
    }
}
