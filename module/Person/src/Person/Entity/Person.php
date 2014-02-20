<?php

namespace Person\Entity;

use Doctrine\ORM\Mapping as ORM;
use Person\Entity\Address as AddressEntity;
use Person\Entity\Contact as ContactEntity;
use Person\Entity\Individual as IndividualEntity;
use Person\Entity\Legal as LegalEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="person")
 */
class Person {

    /**
     * @ORM\Id
     * @ORM\Column(type="bigint", name="person_id")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $personId;

    /**
     * @ORM\Column(type="string", name="person_name")
     */
    protected $personName;
    
    /**
     * @ORM\Column(type="string", name="person_type")
     */
    protected $personType;
    
    /**
     * @ORM\Column(type="datetime", name="person_date")
     */
    protected $personDate;
    
    /**
     * @ORM\Column(type="string", name="person_is_active")
     */
    protected $personIsActive;

    /**
     * @ORM\OneToOne(targetEntity="Person\Entity\Address", cascade={"all"})
     * @ORM\JoinColumn(name="address_id", referencedColumnName="address_id")
     */
    protected $address;

    /**
     * @ORM\OneToOne(targetEntity="Person\Entity\Contact", cascade={"all"})
     * @ORM\JoinColumn(name="contact_id", referencedColumnName="contact_id")
     */
    protected $contact;
    
    /**
     * @ORM\OneToOne(targetEntity="Person\Entity\Individual", cascade={"all"})
     * @ORM\JoinColumn(name="individual_id", referencedColumnName="individual_id")
     */
    protected $individual;
    
    /**
     * @ORM\OneToOne(targetEntity="Person\Entity\Legal", cascade={"all"})
     * @ORM\JoinColumn(name="legal_id", referencedColumnName="legal_id")
     */
    protected $legal;
    
    public function __construct() {
        $this->personType       = 0;
        $this->personIsActive   = 1;
        $this->personDate       = new \DateTime('now');
        $this->address          = new AddressEntity();
        $this->contact          = new ContactEntity();
        $this->individual       = new IndividualEntity();
        $this->legal            = new LegalEntity();
    }

    public function getPersonId() {
        return $this->personId;
    }

    public function setPersonId($personId) {
        $this->personId = $personId;
        return $this;
    }

    public function getPersonName() {
        return $this->personName;
    }

    public function setPersonName($personName) {
        $this->personName = $personName;
        return $this;
    }
    
    public function getPersonType() {
        return $this->personType;
    }
    
    public function getPersonIsActive() {
        return $this->personIsActive;
    }

    public function setPersonIsActive($personIsActive) {
        $this->personIsActive = $personIsActive;
        return $this;
    }

    public function setPersonType($personType) {
        $this->personType = $personType;
        return $this;
    }

    public function getPersonDate() {
        return $this->personDate;
    }

    public function setPersonDate($personDate) {
        $this->personDate = $personDate;
        return $this;
    }

    public function getAddress() {
        return $this->address;
    }

    public function setAddress(AddressEntity $address) {
        $this->address = $address;
        return $this;
    }

    public function getContact() {
        return $this->contact;
    }

    public function setContact(ContactEntity $contact) {
        $this->contact = $contact;
        return $this;
    }
    
    public function getIndividual() {
        return $this->individual;
    }

    public function setIndividual(IndividualEntity $individual) {
        $this->individual = $individual;
        return $this;
    }

    public function getLegal() {
        return $this->legal;
    }

    public function setLegal(LegalEntity $legal) {
        $this->legal = $legal;
        return $this;
    }
}
