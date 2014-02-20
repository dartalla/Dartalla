<?php

namespace Sponsor\Entity;

use Doctrine\ORM\Mapping as ORM;
use Person\Entity\Person;
use Reference\Entity\Reference;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="Sponsor\Entity\Repository\Sponsor")
 * @ORM\Table(name="sponsor")
 */
class Sponsor {

    /**
     * @ORM\Id
     * @ORM\Column(name="sponsor_id", type="bigint")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $sponsorId;

    /**
     * @ORM\Column(name="sponsor_residence_time", type="string")
     */
    protected $sponsorResidenceTime;
    
    /**
     * @ORM\Column(name="sponsor_residence_type", type="string")
     */
    protected $sponsorResidenceType;

    /**
     * @ORM\Column(name="sponsor_residence_rent_value", type="decimal", precision=2)
     */
    protected $sponsorResidenceRentValue;

    /**
     * @ORM\OneToOne(targetEntity="Person\Entity\Person", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="person_id", referencedColumnName="person_id")
     */
    protected $person;
    
    /**
     * @ORM\OneToOne(targetEntity="BankAccount\Entity\BankAccount", cascade={"all"})
     * @ORM\JoinColumn(name="bank_account_id", referencedColumnName="bank_account_id")
     */
    protected $bankAccount;
    
    /**
     * @ORM\ManyToMany(targetEntity="Reference\Entity\Reference", cascade="all")
     * @ORM\JoinTable(name="sponsor_reference", 
     *      joinColumns={@ORM\JoinColumn(name="sponsor_id", referencedColumnName="sponsor_id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="reference_id", referencedColumnName="reference_id", unique=true)}
     * )
     */
    protected $references;

    
    public function __construct() {
        $this->person       = new Person();
        $this->references   = new ArrayCollection();
    }

    public function getSponsorId() {
        return $this->sponsorId;
    }

    public function setSponsorId($sponsorId) {
        $this->sponsorId = $sponsorId;
    }

    public function getSponsorResidenceType() {
        return $this->sponsorResidenceType;
    }

    public function setSponsorResidenceType($sponsorResidenceType) {
        $this->sponsorResidenceType = $sponsorResidenceType;
    }

    public function getSponsorResidenceTime() {
        return $this->sponsorResidenceTime;
    }

    public function setSponsorResidenceTime($sponsorResidenceTime) {
        $this->sponsorResidenceTime = $sponsorResidenceTime;
    }

    public function getSponsorResidenceRentValue() {
        return $this->sponsorResidenceRentValue;
    }

    public function setSponsorResidenceRentValue($sponsorResidenceRentValue) {
        $this->sponsorResidenceRentValue = (double) $sponsorResidenceRentValue;
    }

    public function getPerson() {
        return $this->person;
    }

    public function setPerson($person) {
        $this->person = $person;
    }
    
    public function getBankAccount() {
        return $this->bankAccount;
    }

    public function setBankAccount($bankAccount) {
        $this->bankAccount = $bankAccount;
        return $this;
    }

    public function getReferences() {
        return $this->references;
    }

    public function addReference(Reference $reference) {
        $this->references->add($reference);
    }
    
    public function setReference($references) {
        foreach ($references as $reference) {
            $this->addReference($reference);
        }
        return $this;
    }
}
