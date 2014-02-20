<?php

namespace Person\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="contact")
 */
class Contact {

    /**
     * @ORM\Id
     * @ORM\Column(name="contact_id", type="bigint")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $contactId;

    /**
     * @ORM\Column(name="contact_email", type="string")
     */
    protected $contactEmail;

    /**
     * @ORM\Column(name="contact_website", type="string")
     */
    protected $contactWebsite;

    /**
     * @ORM\Column(name="contact_phone", type="string")
     */
    protected $contactPhone;

    /**
     * @ORM\Column(name="contact_cell", type="string")
     */
    protected $contactCell;

    /**
     * @ORM\Column(name="contact_fax", type="string")
     */
    protected $contactFax;
    
    /**
     * 
     * @return integer
     */
    public function getContactId() {
        return $this->contactId;
    }

    /**
     * 
     * @param integer $contactId
     * @return \Person\Entity\Contact
     */
    public function setContactId($contactId) {
        $this->contactId = $contactId;
        return $this;
    }

    /**
     * 
     * @return string
     */
    public function getContactEmail() {
        return $this->contactEmail;
    }

    /**
     * 
     * @param string $contactEmail
     * @return \Person\Entity\Contact
     */
    public function setContactEmail($contactEmail) {
        $this->contactEmail = $contactEmail;
        return $this;
    }

    /**
     * 
     * @return string
     */
    public function getContactWebsite() {
        return $this->contactWebsite;
    }

    /**
     * 
     * @param string $contactWebsite
     * @return \Person\Entity\Contact
     */
    public function setContactWebsite($contactWebsite) {
        $this->contactWebsite = $contactWebsite;
        return $this;
    }

    /**
     * 
     * @return string
     */
    public function getContactPhone() {
        return $this->contactPhone;
    }

    /**
     * 
     * @param string $contactPhone
     * @return \Person\Entity\Contact
     */
    public function setContactPhone($contactPhone) {
        $this->contactPhone = $contactPhone;
        return $this;
    }

    /**
     * 
     * @return string
     */
    public function getContactCell() {
        return $this->contactCell;
    }

    /**
     * 
     * @param string $contactCell
     * @return \Person\Entity\Contact
     */
    public function setContactCell($contactCell) {
        $this->contactCell = $contactCell;
        return $this;
    }

    /**
     * 
     * @return string
     */
    public function getContactFax() {
        return $this->contactFax;
    }

    /**
     * 
     * @param string $contactFax
     * @return \Person\Entity\Contact
     */
    public function setContactFax($contactFax) {
        $this->contactFax = $contactFax;
        return $this;
    }
}
