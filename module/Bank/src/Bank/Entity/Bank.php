<?php

namespace Bank\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="bank")
 */
class Bank {
    
    /**
     * @ORM\Id
     * @ORM\Column(name="bank_id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var integer
     */
    protected $bankId;

    /**
     * @ORM\Column(name="bank_code", type="string")
     * @var string
     */
    protected $bankCode;
    
    /**
     * @ORM\Column(name="bank_name", type="string")
     * @var string
     */
    protected $bankName;
    
    /**
     * @ORM\Column(name="bank_website", type="string")
     * @var string
     */
    protected $bankWebsite;
    
    /**
     * @ORM\Column(name="bank_tax", type="decimal", precision=2)
     */
    protected $bankTax;
    
    /**
     * @ORM\Column(name="bank_return", type="decimal", precision=2)
     */
    protected $bankReturn;
    
    /**
     * @ORM\Column(name="bank_direct", type="boolean")
     */
    protected $bankDirect;
    
    
    public function __construct() {
        $this->bankTax      = 0.00;
        $this->bankReturn   = 0.00;
        $this->bankDirect   = false;
    }
    
    /**
     * 
     * @return integer
     */
    public function getBankId() {
        return $this->bankId;
    }

    /**
     * 
     * @param integer $bankId
     */
    public function setBankId($bankId) {
        $this->bankId = $bankId;
        return $this;
    }
    
    /**
     * 
     * @return string
     */
    public function getBankCode() {
        return $this->bankCode;
    }

    /**
     * 
     * @param string $bankCode
     */
    public function setBankCode($bankCode) {
        $this->bankCode = $bankCode;
        return $this;
    }

    /**
     * 
     * @return string
     */
    public function getBankName() {
        return $this->bankName;
    }

    /**
     * 
     * @param string $bankName
     */
    public function setBankName($bankName) {
        $this->bankName = $bankName;
        return $this;
    }
    
    /**
     * 
     * @return string
     */
    public function getBankWebsite() {
        return $this->bankWebsite;
    }

    /**
     * 
     * @param string $bankWebsite
     * @return \Bank\Entity\Bank
     */
    public function setBankWebsite($bankWebsite) {
        $this->bankWebsite = $bankWebsite;
        return $this;
    }
    
    /**
     * 
     * @return float
     */
    public function getBankTax() {
        return $this->bankTax;
    }

    /**
     * 
     * @param float $bankTax
     * @return \Bank\Entity\Bank
     */
    public function setBankTax($bankTax) {
        $this->bankTax = $bankTax;
        return $this;
    }

    /**
     * 
     * @return float
     */
    public function getBankReturn() {
        return $this->bankReturn;
    }

    /**
     * 
     * @param float $bankReturn
     * @return \Bank\Entity\Bank 
     */
    public function setBankReturn($bankReturn) {
        $this->bankReturn = $bankReturn;
        return $this;
    }

    /**
     * 
     * @return boolean
     */
    public function getBankDirect() {
        return $this->bankDirect;
    }

    /**
     * 
     * @param boolean $bankDirect
     * @return \Bank\Entity\Bank
     */
    public function setBankDirect($bankDirect) {
        $this->bankDirect = $bankDirect;
        return $this;
    }
}
