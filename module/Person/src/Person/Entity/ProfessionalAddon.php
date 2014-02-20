<?php

namespace Person\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="professional_addon")
 */
class ProfessionalAddon {
    
    /**
     * @ORM\Id
     * @ORM\Column(name="professional_addon_id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var integer
     */
    protected $professionalAddonId;

    /**
     * @ORM\Column(name="professional_addon_previous_company", type="string")
     * @var string
     */
    protected $professionalAddonPreviousCompany;
    
    /**
     * @ORM\Column(name="professional_addon_previous_phone", type="string")
     * @var string
     */
    protected $professionalAddonPreviousPhone;
    
    /**
     * @ORM\Column(name="professional_addon_previous_admission", type="datebr")
     * @var string
     */
    protected $professionalAddonPreviousAdmission;
    
    /**
     * @ORM\Column(name="professional_addon_previous_demission", type="datebr")
     */
    protected $professionalAddonPreviousDemission;
    
    /**
     * @ORM\Column(name="professional_addon_previous_office", type="string")
     */
    protected $professionalAddonPreviousOffice;
    
    /**
     * @ORM\Column(name="professional_addon_previous_salary", type="decimal", precision=2)
     */
    protected $professionalAddonPreviousSalary;
    
    
    public function __construct() {
        $this->professionalAddonPreviousSalary      = 0.00;
        $this->professionalAddonPreivousAdmission   = new \DateTime('now');
        $this->professionalAddonPreivousDemission   = new \DateTime('now');
    }
    
    public function getProfessionalAddonId() {
        return $this->professionalAddonId;
    }

    public function setProfessionalAddonId($professionalAddonId) {
        $this->professionalAddonId = $professionalAddonId;
        return $this;
    }

    public function getProfessionalAddonPreviousCompany() {
        return $this->professionalAddonPreviousCompany;
    }

    public function setProfessionalAddonPreviousCompany($professionalAddonPreviousCompany) {
        $this->professionalAddonPreviousCompany = $professionalAddonPreviousCompany;
        return $this;
    }

    public function getProfessionalAddonPreviousPhone() {
        return $this->professionalAddonPreviousPhone;
    }

    public function setProfessionalAddonPreviousPhone($professionalAddonPreviousPhone) {
        $this->professionalAddonPreviousPhone = $professionalAddonPreviousPhone;
        return $this;
    }

    public function getProfessionalAddonPreviousAdmission() {
        return $this->professionalAddonPreviousAdmission;
    }

    public function setProfessionalAddonPreviousAdmission($professionalAddonPreviousAdmission) {
        $this->professionalAddonPreviousAdmission = $professionalAddonPreviousAdmission;
        return $this;
    }

    public function getProfessionalAddonPreviousDemission() {
        return $this->professionalAddonPreviousDemission;
    }

    public function setProfessionalAddonPreviousDemission($professionalAddonPreviousDemission) {
        $this->professionalAddonPreviousDemission = $professionalAddonPreviousDemission;
        return $this;
    }

    public function getProfessionalAddonPreviousOffice() {
        return $this->professionalAddonPreviousOffice;
    }

    public function setProfessionalAddonPreviousOffice($professionalAddonPreviousOffice) {
        $this->professionalAddonPreviousOffice = $professionalAddonPreviousOffice;
        return $this;
    }

    public function getProfessionalAddonPreviousSalary() {
        return $this->professionalAddonPreviousSalary;
    }

    public function setProfessionalAddonPreviousSalary($professionalAddonPreviousSalary) {
        $this->professionalAddonPreviousSalary = $professionalAddonPreviousSalary;
        return $this;
    }
}
