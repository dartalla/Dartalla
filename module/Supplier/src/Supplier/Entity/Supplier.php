<?php

namespace Supplier\Entity;

use Doctrine\ORM\Mapping as ORM;
use Person\Entity\Person as PersonEntity;

/**
 * @ORM\Entity(repositoryClass="Supplier\Entity\Repository\Supplier")
 * @ORM\Table(name="supplier")
 */
class Supplier {

    /**
     * @ORM\Id
     * @ORM\Column(name="supplier_id", type="bigint")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $supplierId;

    /**
     * @ORM\Column(name="supplier_timestamp", type="datetime")
     */
    protected $supplierTimestamp;

    /**
     * @ORM\Column(name="company_id", type="integer")
     */
    protected $companyId;

    /**
     * @ORM\OneToOne(targetEntity="Person\Entity\Person", cascade={"all"})
     * @ORM\JoinColumn(name="person_id", referencedColumnName="person_id")
     */
    protected $person;

    public function __construct() {
        $this->supplierTimestamp        = new \DateTime("now");
        $this->person                   = new PersonEntity();
    }

    public function getSupplierId() {
        return $this->supplierId;
    }

    public function setSupplierId($supplierId) {
        $this->supplierId = $supplierId;
        return $this;
    }

    public function getSupplierTimestamp() {
        return $this->supplierTimestamp;
    }

    public function setSupplierTimestamp($supplierTimestamp) {
        $this->supplierTimestamp = $supplierTimestamp;
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
    
    public function getSupplierName() {
        return $this->person->getPersonName();
    }
}
