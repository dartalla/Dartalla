<?php

namespace Financial\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="account_parcel")
 */
class AccountParcel {
    
    /**
     * @ORM\Id
     * @ORM\Column(name="account_parcel_id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $accountParcelId;
    
    /**
     * @ORM\Column(name="account_parcel_expiration", type="datebr")
     */
    protected $accountParcelExpiration;
    
    /**
     * @ORM\Column(name="account_parcel_value", type="decimal", precision=2)
     */
    protected $accountParcelValue;
    
    /**
     * @ORM\ManyToOne(targetEntity="Financial\Entity\Account", inversedBy="parcels")
     * @ORM\JoinColumn(name="account_id", referencedColumnName="account_id")
     */
    protected $account;


    public function __construct() {
        $this->accountParcelValue = 0;
        $this->accountParcelExpiration = new \DateTime('now');
    }
    
    public function getAccountParcelId() {
        return $this->accountParcelId;
    }

    public function setAccountParcelId($accountParcelId) {
        $this->accountParcelId = $accountParcelId;
        return $this;
    }

    public function getAccountParcelExpiration() {
        return $this->accountParcelExpiration;
    }

    public function setAccountParcelExpiration($accountParcelExpiration) {
        $this->accountParcelExpiration = $accountParcelExpiration;
        return $this;
    }

    public function getAccountParcelValue() {
        return $this->accountParcelValue;
    }

    public function setAccountParcelValue($accountParcelValue) {
        $this->accountParcelValue = $accountParcelValue;
        return $this;
    }
    
    public function getAccount() {
        return $this->account;
    }

    public function setAccount($account) {
        $this->account = $account;
        return $this;
    }
}