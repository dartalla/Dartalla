<?php

namespace BankAccount\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="bank_account")
 */
class BankAccount {
    
    /**
     * @ORM\Id
     * @ORM\Column(name="bank_account_id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var integer
     */
    protected $bankAccountId;

    /**
     * @ORM\Column(name="bank_account_type", type="string")
     * @var string
     */
    protected $bankAccountType;

    /**
     * @ORM\Column(name="bank_account_bank", type="string")
     * @var string
     */
    protected $bankAccountBank;
    
    /**
     * @ORM\Column(name="bank_account_agency", type="string")
     */
    protected $bankAccountAgency;
    
    /**
     * @ORM\Column(name="bank_account_account", type="string")
     */
    protected $bankAccountAccount;
    
    /**
     * @ORM\Column(name="bank_account_since", type="datebr")
     */
    protected $bankAccountSince;
    
    public function getBankAccountId() {
        return $this->bankAccountId;
    }

    public function setBankAccountId($bankAccountId) {
        $this->bankAccountId = $bankAccountId;
        return $this;
    }

    public function getBankAccountType() {
        return $this->bankAccountType;
    }

    public function setBankAccountType($bankAccountType) {
        $this->bankAccountType = $bankAccountType;
        return $this;
    }

    public function getBankAccountBank() {
        return $this->bankAccountBank;
    }

    public function setBankAccountBank($bankAccountBank) {
        $this->bankAccountBank = $bankAccountBank;
        return $this;
    }

    public function getBankAccountAgency() {
        return $this->bankAccountAgency;
    }

    public function setBankAccountAgency($bankAccountAgency) {
        $this->bankAccountAgency = $bankAccountAgency;
        return $this;
    }

    public function getBankAccountAccount() {
        return $this->bankAccountAccount;
    }

    public function setBankAccountAccount($bankAccountAccount) {
        $this->bankAccountAccount = $bankAccountAccount;
        return $this;
    }

    public function getBankAccountSince() {
        return $this->bankAccountSince;
    }

    public function setBankAccountSince($bankAccountSince) {
        $this->bankAccountSince = $bankAccountSince;
        return $this;
    }
}
