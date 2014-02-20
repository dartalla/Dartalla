<?php

namespace PaymentType\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="payment_type")
 */
class PaymentType {

    /**
     * @ORM\Id
     * @ORM\Column(name="payment_type_id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var integer
     */
    protected $paymentTypeId;

    /**
     * @ORM\Column(name="payment_type_name", type="string")
     * @var string
     */
    protected $paymentTypeName;

    /**
     * @ORM\Column(name="company_id", type="integer")
     */
    protected $companyId;

    /**
     * @return integer
     */
    public function getPaymentTypeId() {
        return $this->paymentTypeId;
    }

    /**
     * @param integer $paymentTypeId
     */
    public function setPaymentTypeId($paymentTypeId) {
        $this->paymentTypeId = $paymentTypeId;
        return $this;
    }

    /**
     * @return string
     */
    public function getPaymentTypeName() {
        return $this->paymentTypeName;
    }

    /**
     * @param string $paymentTypeName
     */
    public function setPaymentTypeName($paymentTypeName) {
        $this->paymentTypeName = $paymentTypeName;
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
