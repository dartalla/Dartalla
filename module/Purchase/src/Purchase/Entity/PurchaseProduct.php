<?php

namespace Purchase\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="purchase_product")
 */
class PurchaseProduct {
    
    /**
     * @ORM\Id
     * @ORM\Column(name="purchase_product_id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $purchaseProductId;
    
    /**
     * @ORM\Column(name="purchase_product_quantity", type="decimal", precision=2)
     */
    protected $purchaseProductQuantity;
    
    /**
     * @ORM\Column(name="purchase_product_price", type="decimal", precision=2)
     */
    protected $purchaseProductPrice;
    
    /**
     * @ORM\Column(name="purchase_product_discount", type="decimal", precision=2)
     */
    protected $purchaseProductDiscount;
    
    /**
     * @ORM\Column(name="purchase_product_total", type="decimal", precision=2)
     */
    protected $purchaseProductTotal;

    /**
     * @ORM\OneToOne(targetEntity="Product\Entity\Product", cascade={"persist"})
     * @ORM\JoinColumn(name="product_id", referencedColumnName="product_id")
     */
    protected $productId;
    
    /**
     * @ORM\ManyToOne(targetEntity="Purchase\Entity\Purchase", inversedBy="products")
     * @ORM\JoinColumn(name="purchase_id", referencedColumnName="purchase_id");
     */
    protected $purchase;
    
    public function getPurchaseProductId() {
        return $this->purchaseProductId;
    }

    public function setPurchaseProductId($purchaseProductId) {
        $this->purchaseProductId = $purchaseProductId;
        return $this;
    }

    public function getPurchaseProductQuantity() {
        return $this->purchaseProductQuantity;
    }

    public function setPurchaseProductQuantity($purchaseProductQuantity) {
        $this->purchaseProductQuantity = $purchaseProductQuantity;
        return $this;
    }

    public function getPurchaseProductPrice() {
        return $this->purchaseProductPrice;
    }

    public function setPurchaseProductPrice($purchaseProductPrice) {
        $this->purchaseProductPrice = $purchaseProductPrice;
        return $this;
    }

    public function getPurchaseProductDiscount() {
        return $this->purchaseProductDiscount;
    }

    public function setPurchaseProductDiscount($purchaseProductDiscount) {
        $this->purchaseProductDiscount = $purchaseProductDiscount;
        return $this;
    }

    public function getPurchaseProductTotal() {
        return $this->purchaseProductTotal;
    }

    public function setPurchaseProductTotal($purchaseProductTotal) {
        $this->purchaseProductTotal = $purchaseProductTotal;
        return $this;
    }

    public function getPurchase() {
        return $this->purchase;
    }

    public function setPurchase($purchase) {
        $this->purchase = $purchase;
        return $this;
    }

    public function getProductId() {
        return $this->productId;
    }

    public function setProductId($productId) {
        $this->productId = $productId;
        return $this;
    }
}
