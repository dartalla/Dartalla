<?php

namespace Person\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="address")
 */
class Address {

    /**
     * @ORM\Id
     * @ORM\Column(name="address_id", type="bigint")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $addressId;

    /**
     * @ORM\Column(name="address_name", type="string")
     */
    protected $addressName;

    /**
     * @ORM\Column(name="address_number", type="integer")
     */
    protected $addressNumber;

    /**
     * @ORM\Column(name="address_complement", type="string")
     */
    protected $addressComplement;

    /**
     * @ORM\Column(name="address_quarter", type="string")
     */
    protected $addressQuarter;

    /**
     * @ORM\Column(name="address_postal_code", type="string")
     */
    protected $addressPostalCode;

    /**
     * @ORM\Column(name="address_city", type="string")
     */
    protected $addressCity;

    /**
     * @ORM\Column(name="address_state", type="string")
     */
    protected $addressState;

    /**
     * @ORM\Column(name="address_country", type="string")
     */
    protected $addressCountry;
    
    /**
     * 
     * @return integer
     */
    public function getAddressId() {
        return $this->addressId;
    }

    /**
     * 
     * @param integer $addressId
     */
    public function setAddressId($addressId) {
        $this->addressId = $addressId;
        return $this;
    }

    /**
     * 
     * @return string
     */
    public function getAddressName() {
        return $this->addressName;
    }

    /**
     * 
     * @param string $addressName
     */
    public function setAddressName($addressName) {
        $this->addressName = $addressName;
        return $this;
    }

    /**
     * 
     * @return integer
     */
    public function getAddressNumber() {
        return $this->addressNumber;
    }

    /**
     * 
     * @param integer $addressNumber
     */
    public function setAddressNumber($addressNumber) {
        $this->addressNumber = (int) $addressNumber;
        return $this;
    }

    /**
     * 
     * @return string
     */
    public function getAddressComplement() {
        return $this->addressComplement;
    }

    /**
     * 
     * @param string $addressComplement
     */
    public function setAddressComplement($addressComplement) {
        $this->addressComplement = $addressComplement;
        return $this;
    }

    /**
     * 
     * @return string
     */
    public function getAddressQuarter() {
        return $this->addressQuarter;
    }

    /**
     * 
     * @param string $addressQuarter
     */
    public function setAddressQuarter($addressQuarter) {
        $this->addressQuarter = $addressQuarter;
        return $this;
    }

    /**
     * 
     * @return string
     */
    public function getAddressPostalCode() {
        return $this->addressPostalCode;
    }

    /**
     * 
     * @param string $addressPostalCode
     */
    public function setAddressPostalCode($addressPostalCode) {
        $this->addressPostalCode = $addressPostalCode;
        return $this;
    }

    /**
     * 
     * @return string
     */
    public function getAddressCity() {
        return $this->addressCity;
    }

    /**
     * 
     * @param string $addressCity
     */
    public function setAddressCity($addressCity) {
        $this->addressCity = $addressCity;
        return $this;
    }

    /**
     * 
     * @return string
     */
    public function getAddressState() {
        return $this->addressState;
    }

    /**
     * 
     * @param string $addressState
     */
    public function setAddressState($addressState) {
        $this->addressState = $addressState;
        return $this;
    }

    /**
     * 
     * @return string
     */
    public function getAddressCountry() {
        return $this->addressCountry;
    }

    /**
     * 
     * @param string $addressCountry
     */
    public function setAddressCountry($addressCountry) {
        $this->addressCountry = $addressCountry;
        return $this;
    }
}
