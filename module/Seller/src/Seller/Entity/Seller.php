<?php

namespace Seller\Entity;

use Doctrine\ORM\Mapping as ORM;
use Person\Entity\Person;

/**
 * @ORM\Entity(repositoryClass="Seller\Entity\Repository\Seller")
 * @ORM\Table(name="seller")
 */
class Seller {

    /**
     * @ORM\Id
     * @ORM\Column(name="seller_id", type="bigint")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $sellerId;

    /**
     * @ORM\Column(name="seller_timestamp", type="datetime")
     */
    protected $sellerTimestamp;
    
    /**
     * @ORM\OneToOne(targetEntity="Person\Entity\Person", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="person_id", referencedColumnName="person_id")
     */
    protected $person;

    
    public function __construct() {
        $this->sellerTimestamp  = new \DateTime("now");
        $this->person           = new Person();
    }

    public function getSellerId() {
        return $this->sellerId;
    }

    public function setSellerId($sellerId) {
        $this->sellerId = $sellerId;
        return $this;
    }

    public function getSellerTimestamp() {
        return $this->sellerTimestamp;
    }

    public function setSellerTimestamp($sellerTimestamp) {
        $this->sellerTimestamp = $sellerTimestamp;
        return $this;
    }

    public function getPerson() {
        return $this->person;
    }

    public function setPerson(Person $person) {
        $this->person = $person;
        return $this;
    }
    
    public function getSellerName() {
        return $this->person->getPersonName();
    }
}
