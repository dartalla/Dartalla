<?php

namespace Person\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="individual")
 */
class Individual {

    /**
     * @ORM\Id
     * @ORM\Column(name="individual_id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $individualId;

    /**
     * @ORM\Column(name="individual_cpf", type="string")
     */
    protected $individualCpf;

    /**
     * @ORM\Column(name="individual_rg", type="string")
     */
    protected $individualRg;

    /**
     * @ORM\Column(name="individual_rg_date", type="date")
     */
    protected $individualRgDate;

    /**
     * @ORM\Column(name="individual_rg_organ", type="string")
     */
    protected $individualRgOrgan;

    /**
     * @ORM\Column(name="individual_rg_uf", type="string")
     */
    protected $individualRgUf;

    /**
     * @ORM\Column(name="individual_birth_day", type="string")
     */
    protected $individualBirthDay;

    /**
     * @ORM\Column(name="individual_birth_month", type="string")
     */
    protected $individualBirthMonth;

    /**
     * @ORM\Column(name="individual_birth_year", type="string")
     */
    protected $individualBirthYear;

    /**
     * @ORM\Column(name="individual_gender", type="string")
     */
    protected $individualGender;

    /**
     * @ORM\Column(name="individual_father", type="string")
     */
    protected $individualFather;

    /**
     * @ORM\Column(name="individual_mother", type="string")
     */
    protected $individualMother;

    /**
     * @ORM\Column(name="individual_birth_place", type="string")
     */
    protected $individualBirthPlace;

    /**
     * @ORM\Column(name="individual_birth_uf", type="string")
     */
    protected $individualBirthUf;

    /**
     * @ORM\Column(name="individual_nationality", type="string")
     */
    protected $individualNationality;
    
    /**
     * @ORM\Column(name="individual_status", type="string")
     */
    protected $individualStatus;
    
    /**
     * @ORM\OneToOne(targetEntity="Occupation\Entity\Occupation", cascade={"persist"})
     * @ORM\JoinColumn(name="occupation_id", referencedColumnName="occupation_id")
     */
    protected $occupation;
    
    /**
     * @ORM\OneToOne(targetEntity="Person\Entity\Professional", cascade={"all"})
     * @ORM\JoinColumn(name="professional_id", referencedColumnName="professional_id")
     */
    protected $professional;
    
    /**
     * @ORM\OneToOne(targetEntity="Person\Entity\ProfessionalAddon", cascade={"all"})
     * @ORM\JoinColumn(name="professional_addon_id", referencedColumnName="professional_addon_id")
     */
    protected $professionalAddon;
    
    public function __construct() {
        $this->individualRgDate     = new \DateTime("now");
        $this->professional         = new Professional();
        $this->professionalAddon    = new ProfessionalAddon();
    }
    
    public function getIndividualId() {
        return $this->individualId;
    }

    public function setIndividualId($individualId) {
        $this->individualId = $individualId;
        return $this;
    }

    public function getIndividualCpf() {
        return $this->individualCpf;
    }

    public function setIndividualCpf($individualCpf) {
        $this->individualCpf = $individualCpf;
        return $this;
    }

    public function getIndividualRg() {
        return $this->individualRg;
    }

    public function setIndividualRg($individualRg) {
        $this->individualRg = $individualRg;
        return $this;
    }

    public function getIndividualRgDate() {
        return $this->individualRgDate;
    }

    public function setIndividualRgDate($individualRgDate) {
        $this->individualRgDate = $individualRgDate;
        return $this;
    }

    public function getIndividualRgOrgan() {
        return $this->individualRgOrgan;
    }

    public function setIndividualRgOrgan($individualRgOrgan) {
        $this->individualRgOrgan = $individualRgOrgan;
        return $this;
    }

    public function getIndividualRgUf() {
        return $this->individualRgUf;
    }

    public function setIndividualRgUf($individualRgUf) {
        $this->individualRgUf = $individualRgUf;
        return $this;
    }

    public function getIndividualBirthDay() {
        return $this->individualBirthDay;
    }

    public function setIndividualBirthDay($individualBirthDay) {
        $this->individualBirthDay = $individualBirthDay;
        return $this;
    }

    public function getIndividualBirthMonth() {
        return $this->individualBirthMonth;
    }

    public function setIndividualBirthMonth($individualBirthMonth) {
        $this->individualBirthMonth = $individualBirthMonth;
        return $this;
    }

    public function getIndividualBirthYear() {
        return $this->individualBirthYear;
    }

    public function setIndividualBirthYear($individualBirthYear) {
        $this->individualBirthYear = $individualBirthYear;
        return $this;
    }

    public function getIndividualGender() {
        return $this->individualGender;
    }

    public function setIndividualGender($individualGender) {
        $this->individualGender = $individualGender;
        return $this;
    }

    public function getIndividualFather() {
        return $this->individualFather;
    }

    public function setIndividualFather($individualFather) {
        $this->individualFather = $individualFather;
        return $this;
    }

    public function getIndividualMother() {
        return $this->individualMother;
    }

    public function setIndividualMother($individualMother) {
        $this->individualMother = $individualMother;
        return $this;
    }

    public function getIndividualBirthPlace() {
        return $this->individualBirthPlace;
    }

    public function setIndividualBirthPlace($individualBirthPlace) {
        $this->individualBirthPlace = $individualBirthPlace;
        return $this;
    }

    public function getIndividualBirthUf() {
        return $this->individualBirthUf;
    }

    public function setIndividualBirthUf($individualBirthUf) {
        $this->individualBirthUf = $individualBirthUf;
        return $this;
    }

    public function getIndividualNationality() {
        return $this->individualNationality;
    }

    public function setIndividualNationality($individualNationality) {
        $this->individualNationality = $individualNationality;
        return $this;
    }
    
    public function getOccupation() {
        return $this->occupation;
    }

    public function setOccupation($occupation) {
        $this->occupation = $occupation;
        return $this;
    }
    
    public function getIndividualStatus() {
        return $this->individualStatus;
    }

    public function setIndividualStatus($individualStatus) {
        $this->individualStatus = $individualStatus;
        return $this;
    }
    
    public function getProfessionalAddon() {
        return $this->professionalAddon;
    }

    public function setProfessionalAddon($professionalAddon) {
        $this->professionalAddon = $professionalAddon;
        return $this;
    }
    
    public function getProfessional() {
        return $this->professional;
    }

    public function setProfessional($professional) {
        $this->professional = $professional;
        return $this;
    }
}
