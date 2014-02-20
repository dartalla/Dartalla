<?php

namespace Reference\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="reference")
 */
class Reference {
    
    /**
     * @ORM\Id
     * @ORM\Column(name="reference_id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var integer
     */
    protected $referenceId;

    /**
     * @ORM\Column(name="reference_type", type="string")
     * @var string
     */
    protected $referenceType;

    /**
     * @ORM\Column(name="reference_name", type="string")
     * @var string
     */
    protected $referenceName;
    
    /**
     * @ORM\Column(name="reference_phone", type="string")
     */
    protected $referencePhone;
    

    public function __construct() {}
    
    public function getReferenceId() {
        return $this->referenceId;
    }

    public function setReferenceId($referenceId) {
        $this->referenceId = $referenceId;
        return $this;
    }

    public function getReferenceType() {
        return $this->referenceType;
    }

    public function setReferenceType($referenceType) {
        $this->referenceType = $referenceType;
        return $this;
    }

    public function getReferenceName() {
        return $this->referenceName;
    }

    public function setReferenceName($referenceName) {
        $this->referenceName = $referenceName;
        return $this;
    }

    public function getReferencePhone() {
        return $this->referencePhone;
    }

    public function setReferencePhone($referencePhone) {
        $this->referencePhone = $referencePhone;
        return $this;
    }
}
