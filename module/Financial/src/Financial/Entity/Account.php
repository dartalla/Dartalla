<?php

namespace Financial\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="account")
 */
class Account {

    /**
     * @ORM\Id
     * @ORM\Column(name="account_id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $accountId;

    /**
     * @ORM\Column(name="account_auto_id", type="integer")
     */
    protected $accountAutoId;

    /**
     * @ORM\Column(name="account_description", type="string")
     */
    protected $accountDescription;

    /**
     * @ORM\Column(name="account_number", type="string")
     */
    protected $accountNumber;

    /**
     * @ORM\Column(name="account_emission_date", type="datebr")
     */
    protected $accountEmissionDate;

    /**
     * @ORM\Column(name="account_expiration_date", type="datebr")
     */
    protected $accountExpirationDate;

    /**
     * @ORM\Column(name="account_competency_date", type="datebr")
     */
    protected $accountCompetencyDate;

    /**
     * @ORM\Column(name="account_value", type="decimal", precision=2)
     */
    protected $accountValue;

    /**
     * @ORM\Column(name="account_parcels", type="integer")
     */
    protected $accountParcels;

    /**
     * @ORM\Column(name="account_carrier", type="string")
     */
    protected $accountCarrier;

    /**
     * @ORM\Column(name="account_barcode", type="string")
     */
    protected $accountBarcode;

    /**
     * @ORM\Column(name="account_auto_launch", type="boolean")
     */
    protected $accountAutoLaunch;

    /**
     * @ORM\Column(name="account_fine", type="decimal", precision=2)
     */
    protected $accountFine;

    /**
     * @ORM\Column(name="account_interest", type="decimal", precision=2)
     */
    protected $accountInterest;

    /**
     * @ORM\Column(name="account_interest_interval", type="integer")
     */
    protected $accountInterestInterval;

    /**
     * @ORM\Column(name="account_notes", type="text")
     */
    protected $accountNotes;

    /**
     * @ORM\Column(name="account_date", type="datetime")
     */
    protected $accountDate;

    /**
     * @ORM\OneToOne(targetEntity="CurrentAccount\Entity\CurrentAccount", cascade={"persist"})
     * @ORM\JoinColumn(name="current_account_id", referencedColumnName="current_account_id")
     */
    protected $currentAccountId;

    /**
     * @ORM\OneToOne(targetEntity="PaymentType\Entity\PaymentType", cascade={"persist"})
     * @ORM\JoinColumn(name="payment_type_id", referencedColumnName="payment_type_id")
     */
    protected $paymentTypeId;

    /**
     * @ORM\OneToOne(targetEntity="AccountingItem\Entity\AccountingItem", cascade={"persist"})
     * @ORM\JoinColumn(name="accounting_item_id", referencedColumnName="accounting_item_id")
     */
    protected $accountingItemId;

    /**
     * @ORM\OneToOne(targetEntity="Department\Entity\Department", cascade={"persist"})
     * @ORM\JoinColumn(name="department_id", referencedColumnName="department_id")
     */
    protected $departmentId;

    /**
     * @ORM\OneToOne(targetEntity="DocumentType\Entity\DocumentType", cascade={"persist"})
     * @ORM\JoinColumn(name="document_type_id", referencedColumnName="document_type_id")
     */
    protected $documentTypeId;

    /**
     * @ORM\OneToMany(targetEntity="Financial\Entity\AccountParcel", mappedBy="account", cascade={"all"})
     */
    protected $parcels;

    public function __construct() {
        $this->accountAutoId = $this->getAccountAutoId();
        $this->accountDate = new \DateTime('now');
        $this->accountEmissionDate = date('d/m/Y');
        $this->accountExpirationDate = date('d/m/Y');
        $this->accountCompetencyDate = date('d/m/Y');
        $this->accountFine = 0;
        $this->accountInterest = 0;
        $this->accountValue = 0;
        $this->accountParcels = 1;
        $this->parcels = new ArrayCollection();
    }

    public function getAccountId() {
        return $this->accountId;
    }

    public function setAccountId($accountId) {
        $this->accountId = $accountId;
        return $this;
    }

    public function getAccountAutoId() {
        if (null === $this->accountAutoId) {
            $datetime = new \DateTime("now");
            $this->accountAutoId = 'DOC' . hash('crc32', 'manager' . ':' . $datetime->getTimestamp());
        }
        return $this->accountAutoId;
    }

    public function setAccountAutoId($accountAutoId) {
        $this->accountAutoId = $accountAutoId;
        return $this;
    }

    public function getAccountDescription() {
        return $this->accountDescription;
    }

    public function setAccountDescription($accountDescription) {
        $this->accountDescription = $accountDescription;
        return $this;
    }

    public function getAccountNumber() {
        return $this->accountNumber;
    }

    public function setAccountNumber($accountNumber) {
        $this->accountNumber = $accountNumber;
        return $this;
    }

    public function getAccountEmissionDate() {
        return $this->accountEmissionDate;
    }

    public function setAccountEmissionDate($accountEmissionDate) {
        $this->accountEmissionDate = $accountEmissionDate;
        return $this;
    }

    public function getAccountExpirationDate() {
        return $this->accountExpirationDate;
    }

    public function setAccountExpirationDate($accountExpirationDate) {
        $this->accountExpirationDate = $accountExpirationDate;
        return $this;
    }

    public function getAccountValue() {
        return $this->accountValue;
    }

    public function setAccountValue($accountValue) {
        $this->accountValue = $accountValue;
        return $this;
    }

    public function getAccountParcels() {
        return $this->accountParcels;
    }

    public function setAccountParcels($accountParcels) {
        $this->accountParcels = (int) $accountParcels;
    }

    public function getAccountCarrier() {
        return $this->accountCarrier;
    }

    public function setAccountCarrier($accountCarrier) {
        $this->accountCarrier = $accountCarrier;
        return $this;
    }

    public function getAccountBarcode() {
        return $this->accountBarcode;
    }

    public function setAccountBarcode($accountBarcode) {
        $this->accountBarcode = $accountBarcode;
        return $this;
    }

    public function getAccountAutoLaunch() {
        return $this->accountAutoLaunch;
    }

    public function setAccountAutoLaunch($accountAutoLaunch) {
        $this->accountAutoLaunch = (bool) $accountAutoLaunch;
        return $this;
    }

    public function getAccountFine() {
        return $this->accountFine;
    }

    public function setAccountFine($accountFine) {
        $this->accountFine = $accountFine;
        return $this;
    }

    public function getAccountInterest() {
        return $this->accountInterest;
    }

    public function setAccountInterest($accountInterest) {
        $this->accountInterest = $accountInterest;
        return $this;
    }

    public function getAccountInterestInterval() {
        return $this->accountInterestInterval;
    }

    public function setAccountInterestInterval($accountInterestInterval) {
        $this->accountInterestInterval = $accountInterestInterval;
        return $this;
    }

    public function getAccountNotes() {
        return $this->accountNotes;
    }

    public function setAccountNotes($accountNotes) {
        $this->accountNotes = $accountNotes;
        return $this;
    }

    public function getAccountDate() {
        return $this->accountDate;
    }

    public function setAccountDate($accountDate) {
        $this->accountDate = $accountDate;
        return $this;
    }

    public function getCurrentAccountId() {
        return $this->currentAccountId;
    }

    public function setCurrentAccountId($currentAccountId) {
        $this->currentAccountId = $currentAccountId;
        return $this;
    }

    public function getPaymentTypeId() {
        return $this->paymentTypeId;
    }

    public function setPaymentTypeId($paymentTypeId) {
        $this->paymentTypeId = $paymentTypeId;
        return $this;
    }

    public function getAccountingItemId() {
        return $this->accountingItemId;
    }

    public function setAccountingItemId($accountingItemId) {
        $this->accountingItemId = $accountingItemId;
        return $this;
    }

    public function getDepartmentId() {
        return $this->departmentId;
    }

    public function setDepartmentId($departmentId) {
        $this->departmentId = $departmentId;
        return $this;
    }

    public function getDocumentTypeId() {
        return $this->documentTypeId;
    }

    public function setDocumentTypeId($documentTypeId) {
        $this->documentTypeId = $documentTypeId;
        return $this;
    }

    public function getAccountCompetencyDate() {
        return $this->accountCompetencyDate;
    }

    public function setAccountCompetencyDate($accountCompetencyDate) {
        $this->accountCompetencyDate = $accountCompetencyDate;
    }

    public function getParcels() {
        return $this->parcels;
    }

    public function addParcels(AccountParcel $parcel) {
        $parcel->setAccount($this);
        $this->parcels->add($parcel);
        return $this;
    }

    public function setParcels($parcels) {
        foreach ($parcels as $parcel) {
            $this->addParcels($parcel);
        }
    }

}
