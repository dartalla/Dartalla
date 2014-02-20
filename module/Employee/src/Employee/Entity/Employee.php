<?php

namespace Employee\Entity;

use Doctrine\ORM\Mapping as ORM;
use Person\Entity\Person as PersonEntity;
use User\Entity\User as UserEntity;
use EmployeeStatus\Entity\EmployeeStatus;

/**
 * @ORM\Entity(repositoryClass="Employee\Entity\Repository\Employee")
 * @ORM\Table(name="employee")
 */
class Employee {

    /**
     * @ORM\Id
     * @ORM\Column(name="employee_id", type="bigint")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $employeeId;

    /**
     * @ORM\Column(name="employee_admission_date", type="datetime")
     */
    protected $employeeAdmissionDate;

    /**
     * @ORM\Column(name="employee_demission_date", type="datetime")
     */
    protected $employeeDemissionDate;

    /**
     * @ORM\Column(name="employee_work_time", type="integer")
     */
    protected $employeeWorkTime;

    /**
     * @ORM\Column(name="employee_ctps", type="string")
     */
    protected $employeeCtps;

    /**
     * @ORM\Column(name="employee_ctps_serie", type="string")
     */
    protected $employeeCtpsSerie;

    /**
     * @ORM\Column(name="employee_pis", type="string")
     */
    protected $employeePis;

    /**
     * @ORM\Column(name="employee_picture", type="string")
     */
    protected $employeePicture;

    /**
     * @ORM\Column(name="employee_salary", type="decimal")
     */
    protected $employeeSalary;

    /**
     * @ORM\Column(name="employee_bonus", type="decimal")
     */
    protected $employeeBonus;

    /**
     * @ORM\Column(name="employee_commission", type="float")
     */
    protected $employeeCommission;

    /**
     * @ORM\Column(name="employee_timestamp", type="datetime")
     */
    protected $employeeTimestamp;

    /**
     * @ORM\Column(name="employee_active", type="boolean")
     */
    protected $employeeActive;

    /**
     * @ORM\Column(name="company_id", type="integer")
     */
    protected $companyId;
    
    /**
     * @ORM\OneToOne(targetEntity="EmployeeStatus\Entity\EmployeeStatus", cascade={"persist"})
     * @ORM\JoinColumn(name="employee_status_id", referencedColumnName="employee_status_id")
     */
    protected $employeeStatusId;
    
    /**
     * @ORM\OneToOne(targetEntity="Office\Entity\Office", cascade={"persist"})
     * @ORM\JoinColumn(name="office_id", referencedColumnName="office_id")
     */
    protected $officeId;

    /**
     * @ORM\OneToOne(targetEntity="Person\Entity\Person", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="person_id", referencedColumnName="person_id")
     */
    protected $person;
    
    /**
     * @ORM\OneToOne(targetEntity="User\Entity\User", cascade={"all"})
     * @ORM\JoinColumn(name="user_id", referencedColumnName="user_id")
     */
    protected $user;

    public function __construct() {
        $this->employeeTimestamp        = new \DateTime("now");
        $this->employeeAdmissionDate    = new \DateTime("now");
        $this->employeeDemissionDate    = new \DateTime("now");
        $this->person                   = new PersonEntity();
        $this->person->setPersonType(0);
    }

    public function getEmployeeId() {
        return $this->employeeId;
    }

    public function setEmployeeId($employeeId) {
        $this->employeeId = $employeeId;
        return $this;
    }

    public function getEmployeeAdmissionDate() {
        return $this->employeeAdmissionDate;
    }

    public function setEmployeeAdmissionDate($employeeAdmissionDate) {
        $this->employeeAdmissionDate = $employeeAdmissionDate;
        return $this;
    }

    public function getEmployeeDemissionDate() {
        return $this->employeeDemissionDate;
    }

    public function setEmployeeDemissionDate($employeeDemissionDate) {
        $this->employeeDemissionDate = $employeeDemissionDate;
        return $this;
    }

    public function getEmployeeWorkTime() {
        return $this->employeeWorkTime;
    }

    public function setEmployeeWorkTime($employeeWorkTime) {
        $this->employeeWorkTime = (int)$employeeWorkTime;
        return $this;
    }

    public function getEmployeeCtps() {
        return $this->employeeCtps;
    }

    public function setEmployeeCtps($employeeCtps) {
        $this->employeeCtps = $employeeCtps;
        return $this;
    }

    public function getEmployeeCtpsSerie() {
        return $this->employeeCtpsSerie;
    }

    public function setEmployeeCtpsSerie($employeeCtpsSerie) {
        $this->employeeCtpsSerie = $employeeCtpsSerie;
        return $this;
    }

    public function getEmployeePis() {
        return $this->employeePis;
    }

    public function setEmployeePis($employeePis) {
        $this->employeePis = $employeePis;
        return $this;
    }

    public function getEmployeePicture() {
        return $this->employeePicture;
    }

    public function setEmployeePicture($employeePicture) {
        $this->employeePicture = $employeePicture;
        return $this;
    }

    public function getEmployeeSalary() {
        return $this->employeeSalary;
    }

    public function setEmployeeSalary($employeeSalary) {
        $this->employeeSalary = (double)$employeeSalary;
        return $this;
    }

    public function getEmployeeBonus() {
        return $this->employeeBonus;
    }

    public function setEmployeeBonus($employeeBonus) {
        $this->employeeBonus = (double)$employeeBonus;
        return $this;
    }

    public function getEmployeeCommission() {
        return $this->employeeCommission;
    }

    public function setEmployeeCommission($employeeCommission) {
        $this->employeeCommission = (float)$employeeCommission;
        return $this;
    }

    public function getEmployeeTimestamp() {
        return $this->employeeTimestamp;
    }

    public function setEmployeeTimestamp($employeeTimestamp) {
        $this->employeeTimestamp = $employeeTimestamp;
        return $this;
    }
    
    public function getEmployeeActive() {
        return $this->employeeActive;
    }

    public function setEmployeeActive($employeeActive) {
        $this->employeeActive = $employeeActive;
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

    public function setPerson(PersonEntity $person) {
        $this->person = $person;
        return $this;
    }
    
    public function getEmployeeName() {
        return $this->person->getPersonName();
    }
    
    public function getUser() {
        return $this->user;
    }
    
    public function setUser(UserEntity $user) {
        $this->user = $user;
        return $this;
    }
    
    public function getEmployeeStatusId() {
        return $this->employeeStatusId;
    }

    public function setEmployeeStatusId(EmployeeStatus $employeeStatusId) {
        $this->employeeStatusId = $employeeStatusId;
        return $this;
    }
    
    public function getOfficeId() {
        return $this->officeId;
    }

    public function setOfficeId($officeId) {
        $this->officeId = $officeId;
        return $this;
    }
}
