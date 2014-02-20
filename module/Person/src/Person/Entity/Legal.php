<?php

namespace Person\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="legal")
 */
class Legal {

    /**
     * @ORM\Id
     * @ORM\Column(name="legal_id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $legalId;

    /**
     * @ORM\Column(name="legal_cnpj", type="string")
     */
    protected $legalCnpj;

    /**
     * @ORM\Column(name="legal_subscription", type="string")
     */
    protected $legalSubscription;

    /**
     * @ORM\Column(name="legal_representative_name", type="string")
     */
    protected $legalRepresentativeName;

    /**
     * @ORM\Column(name="legal_representative_phone", type="string")
     */
    protected $legalRepresentativePhone;
    
    /**
     * @ORM\Column(name="legal_representative_rg", type="string")
     */
    protected $legalRepresentativeRg;

    public function __construct() {
        
    }
    
    /**
     * @return the $legalId
     */
    public function getLegalId() {
        return $this->legalId;
    }

    /**
     * @param field_type $legalId
     */
    public function setLegalId($legalId) {
        $this->legalId = $legalId;
        return $this;
    }

    /**
     * @return the $legalCnpj
     */
    public function getLegalCnpj() {
        return $this->legalCnpj;
    }

    /**
     * @param field_type $legalCnpj
     */
    public function setLegalCnpj($legalCnpj) {
        $this->legalCnpj = $legalCnpj;
        return $this;
    }

    /**
     * @return the $legalSubscription
     */
    public function getLegalSubscription() {
        return $this->legalSubscription;
    }

    /**
     * @param field_type $legalSubscription
     */
    public function setLegalSubscription($legalSubscription) {
        $this->legalStateSubscription = $legalSubscription;
        return $this;
    }

    /**
     * @return the $legalRepresentativeName
     */
    public function getLegalRepresentativeName() {
        return $this->legalRepresentativeName;
    }

    /**
     * @param field_type $legalRepresentativeName
     */
    public function setLegalRepresentativeName($legalRepresentativeName) {
        $this->legalRepresentativeName = $legalRepresentativeName;
        return $this;
    }

    /**
     * @return the $legalRepresentativePhone
     */
    public function getLegalRepresentativePhone() {
        return $this->legalRepresentativePhone;
    }

    /**
     * @param field_type $legalRepresentativePhone
     */
    public function setLegalRepresentativePhone($legalRepresentativePhone) {
        $this->legalRepresentativePhone = $legalRepresentativePhone;
        return $this;
    }
    
    public function getLegalRepresentativeRg() {
        return $this->legalRepresentativeRg;
    }

    public function setLegalRepresentativeRg($legalRepresentativeRg) {
        $this->legalRepresentativeRg = $legalRepresentativeRg;
        return $this;
    }
}
