<?php

namespace CurrentAccount\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="credit_card")
 */
class CreditCard {
    
    /**
     * @ORM\Id
     * @ORM\Column(name="credit_card_id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $creditCardId;
    
    /**
     * @ORM\Column(name="credit_card_number", type="string")
     */
    protected $creditCardNumber;
    
    /**
     * @ORM\Column(name="credit_card_brand", type="string")
     */
    protected $creditCardBrand;
    
    /**
     * @ORM\Column(name="credit_card_closing", type="integer")
     */
    protected $creditCardClosing;
    
    /**
     * @ORM\Column(name="credit_card_expiration", type="integer")
     */
    protected $creditCardExpiration;
    
    /**
     * @ORM\Column(name="credit_card_Validity", type="string")
     */
    protected $creditCardValidity;
    
    public function getCreditCardId() {
        return $this->creditCardId;
    }

    public function setCreditCardId($creditCardId) {
        $this->creditCardId = (int) $creditCardId;
        return $this;
    }

    public function getCreditCardNumber() {
        return $this->creditCardNumber;
    }

    public function setCreditCardNumber($creditCardNumber) {
        $this->creditCardNumber = $creditCardNumber;
        return $this;
    }

    public function getCreditCardBrand() {
        return $this->creditCardBrand;
    }

    public function setCreditCardBrand($creditCardBrand) {
        $this->creditCardBrand = $creditCardBrand;
        return $this;
    }

    public function getCreditCardClosing() {
        return $this->creditCardClosing;
    }

    public function setCreditCardClosing($creditCardClosing) {
        $this->creditCardClosing = (int) $creditCardClosing;
        return $this;
    }

    public function getCreditCardExpiration() {
        return $this->creditCardExpiration;
    }

    public function setCreditCardExpiration($creditCardExpiration) {
        $this->creditCardExpiration = (int) $creditCardExpiration;
        return $this;
    }

    public function getCreditCardValidity() {
        return $this->creditCardValidity;
    }

    public function setCreditCardValidity($creditCardValidity) {
        $this->creditCardValidity = $creditCardValidity;
        return $this;
    }
}
