<?php

namespace Currency\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="currency")
 */
class Currency {
    
    /**
     * @ORM\Id
     * @ORM\Column(name="currency_id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var integer
     */
    protected $currencyId;

    /**
     * @ORM\Column(name="currency_name", type="string")
     * @var string
     */
    protected $currencyName;
    
    /**
     * 
     * @return integer
     */
    public function getCurrencyId() {
        return $this->currencyId;
    }

    /**
     * 
     * @param integer $currencyId
     */
    public function setCurrencyId($currencyId) {
        $this->currencyId = $currencyId;
        return $this;
    }
    
    /**
     * 
     * @return string
     */
    public function getCurrencyName() {
        return $this->currencyName;
    }

    /**
     * 
     * @param string $currencyName
     */
    public function setCurrencyName($currencyName) {
        $this->currencyName = $currencyName;
        return $this;
    }
}
