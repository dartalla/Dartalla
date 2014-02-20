<?php

namespace Office\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="office")
 */
class Office {
    
    /**
     * @ORM\Id
     * @ORM\Column(name="office_id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var integer
     */
    protected $officeId;

    /**
     * @ORM\Column(name="office_name", type="string")
     * @var string
     */
    protected $officeName;
    
   
    /**
     * 
     * @return integer
     */
    public function getOfficeId() {
        return $this->officeId;
    }

    /**
     * 
     * @param integer $officeId
     */
    public function setOfficeId($officeId) {
        $this->officeId = $officeId;
        return $this;
    }
    
    /**
     * 
     * @return string
     */
    public function getOfficeName() {
        return $this->officeName;
    }

    /**
     * 
     * @param string $officeName
     */
    public function setOfficeName($officeName) {
        $this->officeName = $officeName;
        return $this;
    }
}
