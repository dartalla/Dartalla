<?php

namespace Purchase\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="Purchase\Entity\Repository\Purchase")
 * @ORM\Table(name="purchase")
 */
class Purchase {
    
    /**
     * @ORM\Id
     * @ORM\Column(name="purchase_id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $purchaseId;
    
    /**
     * @ORM\Column(name="purchase_uid", type="string")
     */
    protected $purchaseUid;
    
    /**
     * @ORM\Column(name="purchase_date", type="datebr")
     */
    protected $purchaseDate;
    
    /**
     * @ORM\Column(name="purchase_datetime", type="datetime")
     */
    protected $purchaseDateTime;
    
    /**
     * @ORM\Column(name="purchase_discount", type="decimal", precision=2)
     */
    protected $purchaseDiscount;
    
    /**
     * @ORM\Column(name="purchase_total", type="decimal", precision=2)
     */
    protected $purchaseTotal;
    
    /**
     * @ORM\OneToOne(targetEntity="Supplier\Entity\Supplier", cascade={"persist"})
     * @ORM\JoinColumn(name="supplier_id", referencedColumnName="supplier_id")
     */
    protected $supplierId;
    
    /**
     * @ORM\OneToOne(targetEntity="Employee\Entity\Employee", cascade={"persist"})
     * @ORM\JoinColumn(name="employee_id", referencedColumnName="employee_id")
     */
    protected $employeeId;
    
    /**
     * @ORM\Column(name="company_id", type="integer")
     */
    protected $companyId;
    
    /**
     * @var \Doctrine\Common\Collections\Collection
     * @ORM\OneToMany(targetEntity="Purchase\Entity\PurchaseProduct", mappedBy="purchase", cascade={"all"})
     */
    protected $products;
    
    public function __construct() {
        $this->purchaseDate        = date('d/m/Y');
        $this->purchaseDateTime    = new \DateTime('now');
        $this->purchaseDiscount    = 0;
        $this->purchaseTotal       = 0;
        $this->purchaseUid         = $this->getPurchaseUid();
        $this->products            = new ArrayCollection();
    }
    
    public function getPurchaseId() {
        return $this->purchaseId;
    }

    public function setPurchaseId($purchaseId) {
        $this->purchaseId = $purchaseId;
        return $this;
    }

    public function getPurchaseUid() {
        if (null === $this->purchaseUid) {
            $datetime = new \DateTime("now");
            $this->purchaseUid = 'CMP' . hash('crc32', 'manager' . ':' . $datetime->getTimestamp());
        }
        $filter = new \Zend\Filter\StringToUpper();
        return $filter->filter($this->purchaseUid);
    }

    public function setPurchaseUid($purchaseUid) {
        $this->purchaseUid = $purchaseUid;
        return $this;
    }

    public function getPurchaseDate() {
        return $this->purchaseDate;
    }

    public function setPurchaseDate($purchaseDate) {
        $this->purchaseDate = $purchaseDate;
        return $this;
    }

    public function getPurchaseDiscount() {
        return $this->purchaseDiscount;
    }

    public function setPurchaseDiscount($purchaseDiscount) {
        $this->purchaseDiscount = $purchaseDiscount;
        return $this;
    }

    public function getPurchaseTotal() {
        return $this->purchaseTotal;
    }

    public function setPurchaseTotal($purchaseTotal) {
        $this->purchaseTotal = $purchaseTotal;
        return $this;
    }

    public function getSupplierId() {
        return $this->supplierId;
    }

    public function setSupplierId($supplierId) {
        $this->supplierId = $supplierId;
        return $this;
    }

    public function getEmployeeId() {
        return $this->employeeId;
    }

    public function setEmployeeId($employeeId) {
        $this->employeeId = $employeeId;
        return $this;
    }

    public function getCompanyId() {
        return $this->companyId;
    }

    public function setCompanyId($companyId) {
        $this->companyId = $companyId;
        return $this;
    }
    
    public function getPurchaseDateTime() {
        return $this->purchaseDateTime;
    }

    public function setPurchaseDateTime($purchaseDateTime) {
        $this->purchaseDateTime = $purchaseDateTime;
        return $this;
    }

    public function getProducts() {
        return $this->products;
    }

    public function addProducts($products) {
        $products->setPurchase($this);
        $this->products->add($products);
        return $this;
    }
}
