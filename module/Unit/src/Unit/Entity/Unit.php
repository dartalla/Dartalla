<?php

namespace Unit\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="unit")
 */
class Unit {
    
    /**
     * @ORM\Id
     * @ORM\Column(name="unit_id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var integer
     */
    protected $unitId;

    /**
     * @ORM\Column(name="unit_name", type="string")
     * @var string
     */
    protected $unitName;
    
    /**
     * @ORM\Column(name="unit_symbol", type="string")
     * @var string
     */
    protected $unitSymbol;
    
    
    public function __construct() {}
    
    /**
     * 
     * @return integer
     */
    public function getUnitId() {
        return $this->unitId;
    }

    /**
     * 
     * @param integer $unitId
     */
    public function setUnitId($unitId) {
        $this->unitId = $unitId;
        return $this;
    }
    
    /**
     * 
     * @return string
     */
    public function getUnitName() {
        return $this->unitName;
    }

    /**
     * 
     * @param string $unitName
     */
    public function setUnitName($unitName) {
        $this->unitName = $unitName;
        return $this;
    }
    
    /**
     * 
     * @return string
     */
    public function getUnitSymbol() {
        return $this->unitSymbol;
    }

    /**
     * 
     * @param string $unitSymbol
     */
    public function setUnitSymbol($unitSymbol) {
        $this->unitSymbol = $unitSymbol;
        return $this;
    }

}
