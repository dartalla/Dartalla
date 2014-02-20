<?php

namespace Company\Entity;

use Doctrine\ORM\Mapping as ORM;
use User\Entity\User;
use Person\Entity\Address;
use Person\Entity\Contact;

/**
 * @ORM\Entity(repositoryClass="Company\Entity\Repository\Company")
 * @ORM\Table(name="company")
 */
class Company {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer", name="company_id")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $companyId;

    /**
     * @ORM\Column(type="string", length=8, name="company_uid", nullable=false)
     */
    protected $companyUid;

    /**
     * @ORM\Column(type="string", name="company_fancy_name", nullable=false)
     */
    protected $companyName;

    /**
     * @ORM\Column(type="string", name="company_name", nullable=false)
     */
    protected $companyFancyName;

    /**
     * @ORM\Column(type="string", name="company_cnpj")
     */
    protected $companyCnpj;

    /**
     * @ORM\Column(type="string", name="company_subscription")
     */
    protected $companySubscription;

    /**
     * @ORM\Column(type="string", name="company_representative_name")
     */
    protected $companyRepresentativeName;

    /**
     * @ORM\Column(type="bigint", name="company_representative_phone")
     */
    protected $companyRepresentativePhone;

    /**
     * @ORM\Column(type="datetime", name="company_timestamp", nullable=true)
     */
    protected $companyTimestamp;
    
    /**
     * @ORM\Column(type="boolean", name="company_is_master")
     * @var boolean 
     */
    protected $companyIsMaster;
    
    /**
     * @ORM\Column(type="boolean", name="company_is_active", nullable=false)
     */
    protected $companyIsActive;

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
     * @ORM\OneToOne(targetEntity="User\Entity\User", cascade={"remove"})
     * @ORM\JoinColumn(name="user_id", referencedColumnName="user_id")
     */
    protected $user;
    
    /**
     * @ORM\OneToMany(targetEntity="Company\Entity\Company", mappedBy="parent");
     * 
     */
    protected $children;
    
    /**
     * @ORM\ManyToOne(targetEntity="Company\Entity\Company", inversedBy="children")
     * @ORM\JoinColumn(name="company_self", referencedColumnName="company_id")
     */
    protected $companySelf;
    
    public function __construct() {
        $this->companyUid       = $this->getCompanyUid();
        $this->companyTimestamp = new \DateTime("now");
        $this->companyIsActive  = true;
        $this->address          = new Address();
        $this->contact          = new Contact();
        $this->user             = new User();
        $this->children         = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * @return the $companyUid
     */
    public function getCompanyUid() {
        if (null === $this->companyUid) {
            $datetime = new \DateTime("now");
            $this->companyUid = hash('crc32', 'manager' . ':' . $datetime->getTimestamp());
        }
        return $this->companyUid;
    }

    public function getAddress() {
        return $this->address;
    }
    
    public function setAddress(Address $address) {
        $this->address = $address;
    }
    
    public function getContact() {
        return $this->contact;
    }
    
    public function setContact(Contact $contact) {
        $this->contact = $contact;
    }
    
    public function getCompanyId() {
        return $this->companyId;
    }

    public function getCompanyName() {
        return $this->companyName;
    }

    public function getCompanyFancyName() {
        return $this->companyFancyName;
    }

    public function getCompanyCnpj() {
        return $this->companyCnpj;
    }

    public function getCompanySubscription() {
        return $this->companySubscription;
    }

    public function getCompanyRepresentativeName() {
        return $this->companyRepresentativeName;
    }

    public function getCompanyRepresentativePhone() {
        return $this->companyRepresentativePhone;
    }

    public function getCompanyTimestamp() {
        return $this->companyTimestamp;
    }

    public function getCompanyIsActive() {
        return $this->companyIsActive;
    }

    public function setCompanyId($companyId) {
        $this->companyId = $companyId;
        return $this;
    }

    public function setCompanyUid($companyUid) {
        $this->companyUid = $companyUid;
        return $this;
    }

    public function setCompanyName($companyName) {
        $this->companyName = $companyName;
        return $this;
    }

    public function setCompanyFancyName($companyFancyName) {
        $this->companyFancyName = $companyFancyName;
        return $this;
    }

    public function setCompanyCnpj($companyCnpj) {
        $this->companyCnpj = $companyCnpj;
        return $this;
    }

    public function setCompanySubscription($companySubscription) {
        $this->companySubscription = $companySubscription;
        return $this;
    }

    public function setCompanyRepresentativeName($companyRepresentativeName) {
        $this->companyRepresentativeName = $companyRepresentativeName;
        return $this;
    }

    public function setCompanyRepresentativePhone($companyRepresentativePhone) {
        $this->companyRepresentativePhone = ($companyRepresentativePhone) ? $companyRepresentativePhone : null;
        return $this;
    }

    public function setCompanyTimestamp($companyTimestamp) {
        $this->companyTimestamp = $companyTimestamp;
        return $this;
    }
    
    public function getCompanyIsMaster() {
        return $this->companyIsMaster;
    }

    public function setCompanyIsMaster($companyIsMaster) {
        $this->companyIsMaster = (bool) $companyIsMaster;
        return $this;
    }
    
    public function setCompanyIsActive($companyIsActive) {
        $this->companyIsActive = $companyIsActive;
        return $this;
    }
    
    public function getUser() {
        return $this->user;
    }
    
    public function setUser(User $user) {
        $this->user = $user;
        return $this;
    }
    
    public function getChildren() {
        return $this->children;
    }

    public function setChildren($children) {
        $this->children = $children;
        return $this;
    }

        
    public function getCompanySelf() {
        return $this->companySelf;
    }

    public function setCompanySelf($companySelf) {
        $this->companySelf = $companySelf;
        return $this;
    }
}
