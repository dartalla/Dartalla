<?php

namespace Business\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="`order`")
 */
class Order {
    
    /**
     * @ORM\Id
     * @ORM\Column(name="order_id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $orderId;
    
    /**
     * @ORM\Column(name="order_uid", type="string")
     */
    protected $orderUid;
    
    /**
     * @ORM\Column(name="order_date", type="datebr")
     */
    protected $orderDate;
    
    /**
     * @ORM\Column(name="order_addition", type="decimal", precision=2)
     */
    protected $orderAddition;
    
    /**
     * @ORM\Column(name="order_discount", type="decimal", precision=2)
     */
    protected $orderDiscount;
    
    /**
     * @ORM\Column(name="order_total", type="decimal", precision=2)
     */
    protected $orderTotal;
    
    /**
     * @ORM\OneToOne(targetEntity="Customer\Entity\Customer", cascade={"persist"})
     * @ORM\JoinColumn(name="customer_id", referencedColumnName="customer_id")
     */
    protected $customerId;
    
    /**
     * @ORM\OneToOne(targetEntity="Employee\Entity\Employee", cascade={"persist"})
     * @ORM\JoinColumn(name="employee_id", referencedColumnName="employee_id")
     */
    protected $employeeId;
    
    /**
     * @ORM\Column(name="company_id", type="integer")
     */
    protected $companyId;
    
    public function __construct() {
        $this->orderDate        = date('d/m/Y');
        $this->orderDiscount    = 0;
        $this->orderAddition    = 0;
        $this->orderTotal       = 0;
        $this->orderUid         = $this->getOrderUid();
    }
    
    public function getOrderId() {
        return $this->orderId;
    }

    public function setOrderId($orderId) {
        $this->orderId = $orderId;
        return $this;
    }

    public function getOrderUid() {
        if (null === $this->orderUid) {
            $datetime = new \DateTime("now");
            $this->orderUid = 'VND' . hash('crc32', 'manager' . ':' . $datetime->getTimestamp());
        }
        return $this->orderUid;
    }

    public function setOrderUid($orderUid) {
        $this->orderUid = $orderUid;
        return $this;
    }

    public function getOrderDate() {
        return $this->orderDate;
    }

    public function setOrderDate($orderDate) {
        $this->orderDate = $orderDate;
        return $this;
    }

    public function getOrderAddition() {
        return $this->orderAddition;
    }

    public function setOrderAddition($orderAddition) {
        $this->orderAddition = $orderAddition;
        return $this;
    }

    public function getOrderDiscount() {
        return $this->orderDiscount;
    }

    public function setOrderDiscount($orderDiscount) {
        $this->orderDiscount = $orderDiscount;
        return $this;
    }

    public function getOrderTotal() {
        return $this->orderTotal;
    }

    public function setOrderTotal($orderTotal) {
        $this->orderTotal = $orderTotal;
        return $this;
    }

    public function getCustomerId() {
        return $this->customerId;
    }

    public function setCustomerId($customerId) {
        $this->customerId = $customerId;
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
}
