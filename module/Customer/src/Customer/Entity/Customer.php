<?php

namespace Customer\Entity;

use Doctrine\ORM\Mapping as ORM;
use Person\Entity\Person;
use Reference\Entity\Reference;
use Patrimony\Entity\Patrimony;
use BankAccount\Entity\BankAccount;
use Vehicle\Entity\Vehicle;
use Sponsor\Entity\Sponsor;

/**
 * @ORM\Entity(repositoryClass="Customer\Entity\Repository\Customer")
 * @ORM\Table(name="customer")
 */
class Customer {

    /**
     * @ORM\Id
     * @ORM\Column(name="customer_id", type="bigint")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $customerId;

    /**
     * @ORM\Column(name="customer_active", type="boolean")
     */
    protected $customerActive;

    /**
     * @ORM\Column(name="customer_timestamp", type="datetime")
     */
    protected $customerTimestamp;
    
    /**
     * @ORM\Column(name="customer_residence_time", type="string")
     */
    protected $customerResidenceTime;
    
    /**
     * @ORM\Column(name="customer_residence_type", type="string");
     */
    protected $customerResidenceType;
    
    /**
     * @ORM\Column(name="customer_residence_rent_value", type="decimal", precision=2)
     */
    protected $customerResidenceRentValue;
    
    /**
     * @ORM\Column(name="customer_notes", type="text")
     */
    protected $customerNotes;

    /**
     * @ORM\Column(name="company_id", type="integer")
     */
    protected $companyId;

    /**
     * @ORM\OneToOne(targetEntity="Person\Entity\Person", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="person_id", referencedColumnName="person_id")
     */
    protected $person;
    
    /**
     * @ORM\Column(name="customer_status_id", type="integer")
     */
    protected $statusId;
    
    /**
     * @ORM\ManyToMany(targetEntity="Reference\Entity\Reference", cascade="all")
     * @ORM\JoinTable(name="customer_reference", 
     *      joinColumns={@ORM\JoinColumn(name="customer_id", referencedColumnName="customer_id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="reference_id", referencedColumnName="reference_id", unique=true)}
     * )
     */
    protected $customerReference;
    
    /**
     * @ORM\ManyToMany(targetEntity="Patrimony\Entity\Patrimony", cascade="all")
     * @ORM\JoinTable(name="customer_patrimony", 
     *      joinColumns={@ORM\JoinColumn(name="customer_id", referencedColumnName="customer_id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="patrimony_id", referencedColumnName="patrimony_id", unique=true)}
     * )
     */
    protected $customerPatrimony;
    
    /**
     * @ORM\ManyToMany(targetEntity="BankAccount\Entity\BankAccount", cascade="all")
     * @ORM\JoinTable(name="customer_bank_account", 
     *      joinColumns={@ORM\JoinColumn(name="customer_id", referencedColumnName="customer_id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="bank_account_id", referencedColumnName="bank_account_id", unique=true)}
     * )
     */
    protected $customerBankAccount;
    
    /**
     * @ORM\OneToOne(targetEntity="Sponsor\Entity\Sponsor", cascade={"all"})
     * @ORM\JoinColumn(name="sponsor_id", referencedColumnName="sponsor_id")
     */
    protected $sponsor;
    
    public function __construct() {
        $this->customerTimestamp            = new \DateTime("now");
        $this->customerResidenceRentValue   = 0.00;
        $this->person                       = new Person();
        $this->sponsor                      = new Sponsor();
        $this->customerReference            = new \Doctrine\Common\Collections\ArrayCollection();
        $this->customerPatrimony            = new \Doctrine\Common\Collections\ArrayCollection();
        $this->customerBankAccount          = new \Doctrine\Common\Collections\ArrayCollection();
        $this->customerActive               = true;
    }

    public function getCustomerId() {
        return $this->customerId;
    }

    public function setCustomerId($customerId) {
        $this->customerId = $customerId;
        return $this;
    }
    
    public function getCustomerActive() {
        return $this->customerActive;
    }

    public function setCustomerActive($customerActive) {
        $this->customerActive = $customerActive;
        return $this;
    }

    public function getCustomerTimestamp() {
        return $this->customerTimestamp;
    }

    public function setCustomerTimestamp($customerTimestamp) {
        $this->customerTimestamp = $customerTimestamp;
        return $this;
    }

    public function getCompanyId() {
        return $this->companyId;
    }

    public function setCompanyId($companyId) {
        $this->companyId = $companyId;
        return $this;
    }

    public function getPerson() {
        return $this->person;
    }

    public function setPerson(Person $person) {
        $this->person = $person;
        return $this;
    }
    
    public function getCustomerName() {
        return $this->person->getPersonName();
    }
    
    public function getCustomerResidenceTime() {
        return $this->customerResidenceTime;
    }

    public function setCustomerResidenceTime($customerResidenceTime) {
        $this->customerResidenceTime = $customerResidenceTime;
        return $this;
    }

    public function getCustomerResidenceStatus() {
        return $this->customerResidenceType;
    }

    public function setCustomerResidenceStatus($customerResidenceType) {
        $this->customerResidenceType = $customerResidenceType;
        return $this;
    }

    public function getCustomerRentValue() {
        return $this->customerResidenceRentValue;
    }

    public function setCustomerRentValue($customerResidenceRentValue) {
        $this->customerResidenceRentValue = $customerResidenceRentValue;
        return $this;
    }
    
    public function getCustomerStatusId() {
        return $this->statusId;
    }

    public function setCustomerStatusId($statusId) {
        $this->statusId = $statusId;
        return $this;
    }
    
    public function getCustomerReference() {
        return $this->customerReference;
    }

    public function addCustomerReference(Reference $reference) {
        $this->customerReference->add($reference);
    }
    
    public function setCustomerReference($customerReference) {
        foreach ($customerReference as $reference) {
            $this->addCustomerReference($reference);
        }
        return $this;
    }
    
    public function getCustomerPatrimony() {
        return $this->customerPatrimony;
    }

    public function addCustomerPatrimony(Patrimony $patrimony) {
        $this->customerPatrimony->add($patrimony);
    }
    
    public function setCustomerPatrimony($customerPatrimony) {
        foreach ($customerPatrimony as $patrimony) {
            $this->addCustomerPatrimony($patrimony);
        }
        return $this;
    }
    
    public function getCustomerBankAccount() {
        return $this->customerBankAccount;
    }

    public function addCustomerBankAccount(BankAccount $bankAccount) {
        $this->customerBankAccount->add($bankAccount);
    }
    
    public function setCustomerBankAccount($customerBankAccount) {
        foreach ($customerBankAccount as $bankAccount) {
            $this->addCustomerBankAccount($bankAccount);
        }
        return $this;
    }
    
        
    public function setCustomerVehicle($customerVehicle) {
        foreach ($customerVehicle as $vehicle) {
            $this->addCustomerVehicle($vehicle);
        }
        return $this;
    }
    
    public function getSponsor() {
        return $this->sponsor;
    }

    public function setSponsor($sponsor) {
        $this->sponsor = $sponsor;
        return $this;
    }
    
    public function getCustomerResidenceType() {
        return $this->customerResidenceType;
    }

    public function setCustomerResidenceType($customerResidenceType) {
        $this->customerResidenceType = $customerResidenceType;
        return $this;
    }

    public function getCustomerResidenceRentValue() {
        return $this->customerResidenceRentValue;
    }

    public function setCustomerResidenceRentValue($customerResidenceRentValue) {
        $this->customerResidenceRentValue = $customerResidenceRentValue;
        return $this;
    }

    public function getCustomerNotes() {
        return $this->customerNotes;
    }

    public function setCustomerNotes($customerNotes) {
        $this->customerNotes = $customerNotes;
        return $this;
    }
}
