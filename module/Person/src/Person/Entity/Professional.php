<?php

namespace Person\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="professional")
 */
class Professional {

    /**
     * @ORM\Id
     * @ORM\Column(name="professional_id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var integer Identity field of table
     */
    protected $professionalId;

    /**
     * @ORM\Column(name="professional_admission_date", type="datebr")
     */
    protected $professionalAdmissionDate;

    /**
     * @ORM\Column(name="professional_enterprise_name", type="string")
     */
    protected $professionalEnterpriseName;

    /**
     * @ORM\Column(name="professional_enterprise_cnpj", type="string")
     */
    protected $professionalEnterpriseCnpj;

    /**
     * @ORM\Column(name="professional_enterprise_business", type="string")
     */
    protected $professionalEnterpriseBusiness;

    /**
     * @ORM\Column(name="professional_enterprise_foundation_date", type="datebr")
     */
    protected $professionalEnterpriseFoundationDate;

    /**
     * @ORM\Column(name="professional_enterprise_participation", type="decimal", precision=2)
     */
    protected $professionalEnterpriseParticipation;

    /**
     * @ORM\Column(name="professional_enterprise_partner_count", type="integer")
     */
    protected $professionalEnterprisePartnerCount;

    /**
     * @ORM\Column(name="professional_office", type="string")
     */
    protected $professionalOffice;

    /**
     * @ORM\Column(name="professional_salary", type="decimal", precision=2)
     */
    protected $professionalSalary;

    /**
     * @ORM\Column(name="professional_other_revenue", type="decimal", precision=2)
     */
    protected $professionalOtherRevenue;
    
    /**
     * @ORM\Column(name="professional_benefit_number", type="string")
     */
    protected $professionalBenefitNumber;
    
    /**
     * @ORM\Column(name="professional_notes", type="text")
     */
    protected $professionalNotes;
    
    /**
     * @ORM\OneToOne(targetEntity="Contact", cascade="all")
     * @ORM\JoinColumn(name="contact_id", referencedColumnName="contact_id")
     */
    protected $contact;
    
    /**
     * @ORM\OneToOne(targetEntity="Address", cascade="all")
     * @ORM\JoinColumn(name="address_id", referencedColumnName="address_id")
     */
    protected $address;
    
    /**
     * @ORM\OneToOne(targetEntity="Business", cascade="persist")
     * @ORM\JoinColumn(name="business_id", referencedColumnName="business_id")
     */
    protected $business;
    
    public function __construct() {
        $this->professionalEnterpriseParticipation  = 0.00;
        $this->professionalEnterprisePartnerCount   = 0;
        $this->professionalSalary                   = 0.00;
        $this->professionalOtherRevenue             = 0.00;
    }
    
    public function getProfessionalId() {
        return $this->professionalId;
    }

    public function setProfessionalId($professionalId) {
        $this->professionalId = $professionalId;
        return $this;
    }

    public function getProfessionalAdmissionDate() {
        return $this->professionalAdmissionDate;
    }

    public function setProfessionalAdmissionDate($professionalAdmissionDate) {
        $this->professionalAdmissionDate = $professionalAdmissionDate;
        return $this;
    }

    public function getProfessionalEnterpriseName() {
        return $this->professionalEnterpriseName;
    }

    public function setProfessionalEnterpriseName($professionalEnterpriseName) {
        $this->professionalEnterpriseName = $professionalEnterpriseName;
        return $this;
    }

    public function getProfessionalEnterpriseCnpj() {
        return $this->professionalEnterpriseCnpj;
    }

    public function setProfessionalEnterpriseCnpj($professionalEnterpriseCnpj) {
        $this->professionalEnterpriseCnpj = $professionalEnterpriseCnpj;
        return $this;
    }

    public function getProfessionalEnterpriseBusiness() {
        return $this->professionalEnterpriseBusiness;
    }

    public function setProfessionalEnterpriseBusiness($professionalEnterpriseBusiness) {
        $this->professionalEnterpriseBusiness = $professionalEnterpriseBusiness;
        return $this;
    }

    public function getProfessionalEnterpriseFoundationDate() {
        return $this->professionalEnterpriseFoundationDate;
    }

    public function setProfessionalEnterpriseFoundationDate($professionalEnterpriseFoundationDate) {
        $this->professionalEnterpriseFoundationDate = $professionalEnterpriseFoundationDate;
        return $this;
    }

    public function getProfessionalEnterpriseParticipation() {
        return $this->professionalEnterpriseParticipation;
    }

    public function setProfessionalEnterpriseParticipation($professionalEnterpriseParticipation) {
        $this->professionalEnterpriseParticipation = (double) $professionalEnterpriseParticipation;
        return $this;
    }

    public function getProfessionalEnterprisePartnerCount() {
        return $this->professionalEnterprisePartnerCount;
    }

    public function setProfessionalEnterprisePartnerCount($professionalEnterprisePartnerCount) {
        $this->professionalEnterprisePartnerCount = (int) $professionalEnterprisePartnerCount;
        return $this;
    }

    public function getProfessionalOffice() {
        return $this->professionalOffice;
    }

    public function setProfessionalOffice($professionalOffice) {
        $this->professionalOffice = $professionalOffice;
        return $this;
    }

    public function getProfessionalSalary() {
        return $this->professionalSalary;
    }

    public function setProfessionalSalary($professionalSalary) {
        $this->professionalSalary = (double) $professionalSalary;
        return $this;
    }

    public function getProfessionalOtherRevenue() {
        return $this->professionalOtherRevenue;
    }

    public function setProfessionalOtherRevenue($professionalOtherRevenue) {
        $this->professionalOtherRevenue = (double) $professionalOtherRevenue;
        return $this;
    }

    public function getProfessionalBenefitNumber() {
        return $this->professionalBenefitNumber;
    }

    public function setProfessionalBenefitNumber($professionalBenefitNumber) {
        $this->professionalBenefitNumber = $professionalBenefitNumber;
        return $this;
    }

    public function getProfessionalNotes() {
        return $this->professionalNotes;
    }

    public function setProfessionalNotes($professionalNotes) {
        $this->professionalNotes = $professionalNotes;
        return $this;
    }

    public function getContact() {
        return $this->contact;
    }

    public function setContact($contact) {
        $this->contact = $contact;
        return $this;
    }

    public function getAddress() {
        return $this->address;
    }

    public function setAddress($address) {
        $this->address = $address;
        return $this;
    }

    public function getBusiness() {
        return $this->business;
    }

    public function setBusiness($business) {
        $this->business = $business;
        return $this;
    }
}