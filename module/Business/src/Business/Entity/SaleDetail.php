<?php

namespace Business\Entity;

use Doctrine\ORM\Mapping as ORM;
use Product\Entity\Product;

/**
 * @ORM\Entity
 * @ORM\Table(name="sale_detail")
 */
class SaleDetail {
    
    /**
     * @ORM\Id
     * @ORM\Column(name="sale_detail_id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $saleDetailId;
    
    /**
     * @ORM\Column(name="sale_detail_quantity", type="integer")
     */
    protected $saleDetailQuantity;
    
    /**
     * @ORM\Column(name="sale_detail_price", type="decimal", precision=2)
     */
    protected $saleDetailPrice;
    
    /**
     * @ORM\Column(name="sale_detail_discount", type="decimal", precision=2)
     */
    protected $saleDetailDiscount;
    
    /**
     * @ORM\Column(name="sale_detail_total", type="decimal", precision=2)
     */
    protected $saleDetailTotal;
    
    /**
     * @ORM\OneToOne(targetEntity="Product\Entity\Product", cascade={"persist"})
     * @ORM\JoinColumn(name="product_id", referencedColumnName="product_id")
     */
    protected $productId;
    
    /**
     * @ORM\ManyToOne(targetEntity="Business\Entity\Sale", inversedBy="saleDetail")
     * @ORM\JoinColumn(name="sale_id", referencedColumnName="sale_id")
     */
    protected $sale;
    
    public function __construct() {
        $this->productId = new Product();
    }
    
    public function getSaleDetailId() {
        return $this->saleDetailId;
    }

    public function setSaleDetailId($saleDetailId) {
        $this->saleDetailId = $saleDetailId;
        return $this;
    }
    
    public function getSaleDetailQuantity() {
        return $this->saleDetailQuantity;
    }

    public function setSaleDetailQuantity($saleDetailQuantity) {
        $this->saleDetailQuantity = $saleDetailQuantity;
        return $this;
    }

    public function getSaleDetailPrice() {
        return $this->saleDetailPrice;
    }

    public function setSaleDetailPrice($saleDetailPrice) {
        $this->saleDetailPrice = $saleDetailPrice;
        return $this;
    }

    public function getSaleDetailDiscount() {
        return $this->saleDetailDiscount;
    }

    public function setSaleDetailDiscount($saleDetailDiscount) {
        $this->saleDetailDiscount = $saleDetailDiscount;
        return $this;
    }

    public function getSaleDetailTotal() {
        return $this->saleDetailTotal;
    }

    public function setSaleDetailTotal($saleDetailTotal) {
        $this->saleDetailTotal = $saleDetailTotal;
        return $this;
    }

    public function getProductId() {
        return $this->productId;
    }

    public function setProductId($productId) {
        $this->productId = $productId;
        return $this;
    }
    
    public function getSale() {
        return $this->sale;
    }

    public function setSale($sale) {
        $this->sale = $sale;
        return $this;
    }
}
