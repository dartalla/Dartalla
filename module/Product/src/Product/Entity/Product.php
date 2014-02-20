<?php

namespace Product\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="product")
 */
class Product {
    
    /**
     * @ORM\Id
     * @ORM\Column(name="product_id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var integer
     */
    protected $productId;

    /**
     * @ORM\Column(name="product_uid", type="string")
     */
    protected $productUid;
    
    /**
     * @ORM\Column(name="product_barcode", type="string")
     */
    protected $productBarcode;
    
    /**
     * @ORM\Column(name="product_name", type="string")
     */
    protected $productName;
    
    /**
     * @ORM\Column(name="product_brand", type="string")
     */
    protected $productBrand;
    
    /**
     * @ORM\Column(name="product_model", type="string")
     */
    protected $productModel;
    
    /**
     * @ORM\Column(name="product_cost", type="decimal", precision=2)
     */
    protected $productCost;
    
    /**
     * @ORM\Column(name="product_markup", type="decimal", precision=2)
     */
    protected $productMarkup;
    
    /**
     * @ORM\Column(name="product_price", type="decimal", precision=2)
     */
    protected $productPrice;
    
    /**
     * @ORM\Column(name="product_promotional_markup", type="decimal", precision=2)
     */
    protected $productPromotionalMarkup;
    
    /**
     * @ORM\Column(name="product_promotional_price", type="decimal", precision=2)
     */
    protected $productPromotionalPrice;
    
    /**
     * @ORM\Column(name="product_wholesale_markup", type="decimal", precision=2)
     */
    protected $productWholesaleMarkup;
    
    /**
     * @ORM\Column(name="product_wholesale_price", type="decimal", precision=2)
     */
    protected $productWholesalePrice;

    /**
     * @ORM\Column(name="product_minimum_stock", type="decimal", precision=2)
     */
    protected $productMinimumStock;
    
    /**
     * @ORM\Column(name="product_ideal_stock", type="decimal", precision=2)
     */
    protected $productIdealStock;
    
    /**
     * @ORM\Column(name="product_stock", type="decimal", precision=2)
     */
    protected $productStock;
    
    /**
     * @ORM\Column(name="product_notes", type="text")
     */
    protected $productNotes;
    
    /**
     * @ORM\Column(name="product_image", type="string")
     */
    protected $productImage;
    
    /**
     * @ORM\Column(name="product_promotion", type="boolean")
     */
    protected $productPromotion;
    
    /**
     * @ORM\Column(name="product_active", type="boolean")
     */
    protected $productActive;
    
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
    
    /**
     * @ORM\OneToOne(targetEntity="Supplier\Entity\Supplier", cascade={"persist"})
     * @ORM\JoinColumn(name="supplier_id", referencedColumnName="supplier_id")
     */
    protected $supplierId;
    
    
    public function __construct() {
        $this->productActive    = true;
    }
    
    public function getProductId() {
        return $this->productId;
    }

    public function setProductId($productId) {
        $this->productId = $productId;
        return $this;
    }

    public function getProductUid() {
        return $this->productUid;
    }

    public function setProductUid($productUid) {
        $this->productUid = $productUid;
        return $this;
    }

    public function getProductBarcode() {
        return $this->productBarcode;
    }

    public function setProductBarcode($productBarcode) {
        $this->productBarcode = $productBarcode;
        return $this;
    }

    public function getProductName() {
        return $this->productName;
    }

    public function setProductName($productName) {
        $this->productName = $productName;
        return $this;
    }

    public function getProductBrand() {
        return $this->productBrand;
    }

    public function setProductBrand($productBrand) {
        $this->productBrand = $productBrand;
        return $this;
    }

    public function getProductModel() {
        return $this->productModel;
    }

    public function setProductModel($productModel) {
        $this->productModel = $productModel;
        return $this;
    }

    public function getProductCost() {
        return $this->productCost;
    }

    public function setProductCost($productCost) {
        $this->productCost = $productCost;
        return $this;
    }

    public function getProductMarkup() {
        return $this->productMarkup;
    }

    public function setProductMarkup($productMarkup) {
        $this->productMarkup = (float) $productMarkup;
        return $this;
    }

    public function getProductPrice() {
        return $this->productPrice;
    }

    public function setProductPrice($productPrice) {
        $this->productPrice = (float) $productPrice;
        return $this;
    }

    public function getProductPromotionalMarkup() {
        return $this->productPromotionalMarkup;
    }

    public function setProductPromotionalMarkup($productPromotionalMarkup) {
        $this->productPromotionalMarkup = (float) $productPromotionalMarkup;
        return $this;
    }

    public function getProductPromotionalPrice() {
        return $this->productPromotionalPrice;
    }

    public function setProductPromotionalPrice($productPromotionalPrice) {
        $this->productPromotionalPrice = (float) $productPromotionalPrice;
        return $this;
    }

    public function getProductWholesaleMarkup() {
        return $this->productWholesaleMarkup;
    }

    public function setProductWholesaleMarkup($productWholesaleMarkup) {
        $this->productWholesaleMarkup = (float) $productWholesaleMarkup;
        return $this;
    }

    public function getProductWholesalePrice() {
        return $this->productWholesalePrice;
    }

    public function setProductWholesalePrice($productWholesalePrice) {
        $this->productWholesalePrice = (float) $productWholesalePrice;
        return $this;
    }

    public function getProductMinimumStock() {
        return $this->productMinimumStock;
    }

    public function setProductMinimumStock($productMinimumStock) {
        $this->productMinimumStock = (double) $productMinimumStock;
        return $this;
    }

    public function getProductIdealStock() {
        return $this->productIdealStock;
    }

    public function setProductIdealStock($productIdealStock) {
        $this->productIdealStock = (double) $productIdealStock;
        return $this;
    }

    public function getProductStock() {
        return $this->productStock;
    }

    public function setProductStock($productStock) {
        $this->productStock = (double) $productStock;
        return $this;
    }

    public function getProductNotes() {
        return $this->productNotes;
    }

    public function setProductNotes($productNotes) {
        $this->productNotes = $productNotes;
        return $this;
    }

    public function getProductImage() {
        return $this->productImage;
    }

    public function setProductImage($productImage) {
        $this->productImage = $productImage;
        return $this;
    }

    public function getProductPromotion() {
        return $this->productPromotion;
    }

    public function setProductPromotion($productPromotion) {
        $this->productPromotion = (bool) $productPromotion;
        return $this;
    }

    public function getProductActive() {
        return $this->productActive;
    }

    public function setProductActive($productActive) {
        $this->productActive = (bool) $productActive;
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

    public function getSupplierId() {
        return $this->supplierId;
    }

    public function setSupplierId($supplierId) {
        $this->supplierId = $supplierId;
        return $this;
    }
}
