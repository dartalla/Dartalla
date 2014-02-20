<?php

namespace CurrentAccount\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="current_account")
 */
class CurrentAccount {

    /**
     * @ORM\Id
     * @ORM\Column(name="current_account_id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var integer
     */
    protected $currentAccountId;

    /**
     * @ORM\Column(name="current_account_name", type="string")
     * @var string
     */
    protected $currentAccountName;

    /**
     * @ORM\Column(name="current_account_agency", type="string")
     * @var string
     */
    protected $currentAccountAgency;

    /**
     * @ORM\Column(name="current_account_agency_vd", type="string")
     * @var string
     */
    protected $currentAccountAgencyVd;

    /**
     * @ORM\Column(name="current_account_account", type="string")
     * @var string
     */
    protected $currentAccountAccount;

    /**
     * @ORM\Column(name="current_account_account_vd", type="string")
     * @var string
     */
    protected $currentAccountAccountVd;

    /**
     * @ORM\Column(name="current_account_manager", type="string")
     * @var string
     */
    protected $currentAccountManager;

    /**
     * @ORM\Column(name="current_account_manager_phone", type="string")
     * @var string
     */
    protected $currentAccountManagerPhone;

    /**
     * @ORM\Column(name="current_account_manager_email", type="string")
     * @var string
     */
    protected $currentAccountManagerEmail;

    /**
     * @ORM\Column(name="current_account_bank_home_page", type="string")
     * @var string
     */
    protected $currentAccountBankHomePage;

    /**
     * @ORM\Column(name="current_account_credit_limit", type="decimal", precision=2)
     * @var string
     */
    protected $currentAccountCreditLimit;

    /**
     * @ORM\Column(name="current_account_credit_expiration", type="date")
     * @var string
     */
    protected $currentAccountCreditExpiration;

    /**
     * @ORM\Column(name="current_account_open_date", type="date")
     * @var string
     */
    protected $currentAccountOpenDate;

    /**
     * @ORM\Column(name="current_account_open_balance", type="decimal", precision=2)
     * @var string
     */
    protected $currentAccountOpenBalance;

    /**
     * @ORM\Column(name="current_account_holder_code", type="string")
     * @var string
     */
    protected $currentAccountHolderCode;

    /**
     * @ORM\Column(name="current_account_description", type="string")
     * @var string
     */
    protected $currentAccountDescription;

    /**
     * @ORM\Column(name="current_account_closed", type="boolean")
     * @var string
     */
    protected $currentAccountClosed;

    /**
     * @ORM\Column(name="current_account_is_active", type="boolean")
     * @var string
     */
    protected $currentAccountIsActive;

    /**
     * @ORM\OneToOne(targetEntity="Bank\Entity\Bank", cascade={"persist"})
     * @ORM\JoinColumn(name="bank_id", referencedColumnName="bank_id")
     */
    protected $bankId;

    /**
     * @ORM\OneToOne(targetEntity="Company\Entity\Company", cascade={"persist"})
     * @ORM\JoinColumn(name="company_id", referencedColumnName="company_id")
     */
    protected $companyId;
    
    /**
     * @ORM\OneToOne(targetEntity="Currency\Entity\Currency", cascade={"persist"})
     * @ORM\JoinColumn(name="currency_id", referencedColumnName="currency_id")
     */
    protected $currencyId;

    public function __construct() {
        $this->currentAccountCreditLimit    = 0;
        $this->currentAccountOpenBalance    = 0;
        $this->currentAccountClosed         = 0;
        $this->currentAccountIsActive       = 1;
    }

    /**
     * 
     * @return integer
     */
    public function getCurrentAccountId() {
        return $this->currentAccountId;
    }

    /**
     * 
     * @param integer $currentAccountId
     */
    public function setCurrentAccountId($currentAccountId) {
        $this->currentAccountId = $currentAccountId;
        return $this;
    }

    /**
     * 
     * @return string
     */
    public function getCurrentAccountName() {
        return $this->currentAccountName;
    }

    /**
     * 
     * @param string $currentAccountName
     */
    public function setCurrentAccountName($currentAccountName) {
        $this->currentAccountName = $currentAccountName;
        return $this;
    }

    /**
     * 
     * @return string
     */
    public function getCurrentAccountAgency() {
        return $this->currentAccountAgency;
    }

    /**
     * 
     * @param string $currentAccountAgency
     */
    public function setCurrentAccountAgency($currentAccountAgency) {
        $this->currentAccountAgency = $currentAccountAgency;
        return $this;
    }

    /**
     * 
     * @return string
     */
    public function getCurrentAccountAccount() {
        return $this->currentAccountAccount;
    }

    /**
     * 
     * @param string $currentAccountAccount
     */
    public function setCurrentAccountAccount($currentAccountAccount) {
        $this->currentAccountAccount = $currentAccountAccount;
        return $this;
    }

    /**
     * 
     * @return string
     */
    public function getCurrentAccountManager() {
        return $this->currentAccountManager;
    }

    /**
     * 
     * @param string $currentAccountManager
     */
    public function setCurrentAccountManager($currentAccountManager) {
        $this->currentAccountManager = $currentAccountManager;
        return $this;
    }

    /**
     * 
     * @return string
     */
    public function getCurrentAccountManagerPhone() {
        return $this->currentAccountManagerPhone;
    }

    /**
     * 
     * @param string $currentAccountManagerPhone
     */
    public function setCurrentAccountManagerPhone($currentAccountManagerPhone) {
        $this->currentAccountManagerPhone = $currentAccountManagerPhone;
        return $this;
    }

    /**
     * 
     * @return string
     */
    public function getCurrentAccountDescription() {
        return $this->currentAccountDescription;
    }

    /**
     * 
     * @param string $currentAccountDescription
     */
    public function setCurrentAccountDescription($currentAccountDescription) {
        $this->currentAccountDescription = $currentAccountDescription;
        return $this;
    }

    /**
     * 
     * @return integer
     */
    public function getBankId() {
        return $this->bankId;
    }

    /**
     * 
     * @param integer $bankId
     */
    public function setBankId($bankId) {
        $this->bankId = $bankId;
        return $this;
    }

    /**
     * 
     * @return CompanyId
     */
    public function getCompanyId() {
        return $this->companyId;
    }

    /**
     * 
     * @param int $companyId
     */
    public function setCompanyId($companyId) {
        $this->companyId = $companyId;
        return $this;
    }

    public function getCurrentAccountAgencyVd() {
        return $this->currentAccountAgencyVd;
    }

    public function setCurrentAccountAgencyVd($currentAccountAgencyVd) {
        $this->currentAccountAgencyVd = $currentAccountAgencyVd;
        return $this;
    }

    public function getCurrentAccountAccountVd() {
        return $this->currentAccountAccountVd;
    }

    public function setCurrentAccountAccountVd($currentAccountAccountVd) {
        $this->currentAccountAccountVd = $currentAccountAccountVd;
        return $this;
    }

    public function getCurrentAccountManagerEmail() {
        return $this->currentAccountManagerEmail;
    }

    public function setCurrentAccountManagerEmail($currentAccountManagerEmail) {
        $this->currentAccountManagerEmail = $currentAccountManagerEmail;
        return $this;
    }

    public function getCurrentAccountBankHomePage() {
        return $this->currentAccountBankHomePage;
    }

    public function setCurrentAccountBankHomePage($currentAccountBankHomePage) {
        $this->currentAccountBankHomePage = $currentAccountBankHomePage;
        return $this;
    }

    public function getCurrentAccountCreditLimit() {
        return $this->currentAccountCreditLimit;
    }

    public function setCurrentAccountCreditLimit($currentAccountCreditLimit) {
        $this->currentAccountCreditLimit = $currentAccountCreditLimit;
        return $this;
    }

    public function getCurrentAccountCreditExpiration() {
        return $this->currentAccountCreditExpiration;
    }

    public function setCurrentAccountCreditExpiration($currentAccountCreditExpiration) {
        $this->currentAccountCreditExpiration = $currentAccountCreditExpiration;
        return $this;
    }

    public function getCurrentAccountOpenDate() {
        return $this->currentAccountOpenDate;
    }

    public function setCurrentAccountOpenDate($currentAccountOpenDate) {
        $this->currentAccountOpenDate = $currentAccountOpenDate;
        return $this;
    }

    public function getCurrentAccountOpenBalance() {
        return $this->currentAccountOpenBalance;
    }

    public function setCurrentAccountOpenBalance($currentAccountOpenBalance) {
        $this->currentAccountOpenBalance = $currentAccountOpenBalance;
        return $this;
    }

    public function getCurrentAccountHolderCode() {
        return $this->currentAccountHolderCode;
    }

    public function setCurrentAccountHolderCode($currentAccountHolderCode) {
        $this->currentAccountHolderCode = $currentAccountHolderCode;
        return $this;
    }

    public function getCurrentAccountClosed() {
        return $this->currentAccountClosed;
    }

    public function setCurrentAccountClosed($currentAccountClosed) {
        $this->currentAccountClosed = (bool) $currentAccountClosed;
        return $this;
    }
    
    public function getCurrentAccountIsActive() {
        return $this->currentAccountIsActive;
    }

    public function setCurrentAccountIsActive($currentAccountIsActive) {
        $this->currentAccountIsActive = (bool) $currentAccountIsActive;
        return $this;
    }

    public function getCurrencyId() {
        return $this->currencyId;
    }

    public function setCurrencyId($currencyId) {
        $this->currencyId = $currencyId;
        return $this;
    }
}
