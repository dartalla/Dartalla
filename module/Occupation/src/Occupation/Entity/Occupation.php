<?php

namespace Occupation\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="occupation")
 */
class Occupation {
    
    /**
     * @ORM\Id
     * @ORM\Column(name="occupation_id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var integer
     */
    protected $occupationId;

    /**
     * @ORM\Column(name="occupation_name", type="string")
     * @var string
     */
    protected $occupationName;
    
    /**
     * 
     * @return integer
     */
    public function getOccupationId() {
        return $this->occupationId;
    }

    /**
     * 
     * @param integer $occupationId
     */
    public function setOccupationId($occupationId) {
        $this->occupationId = $occupationId;
        return $this;
    }
    
    /**
     * 
     * @return string
     */
    public function getOccupationName() {
        return $this->occupationName;
    }

    /**
     * 
     * @param string $occupationName
     */
    public function setOccupationName($occupationName) {
        $this->occupationName = $occupationName;
        return $this;
    }
}
