<?php

namespace DocumentType\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="document_type")
 */
class DocumentType {
    
    /**
     * @ORM\Id
     * @ORM\Column(name="document_type_id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var integer
     */
    protected $documentTypeId;

    /**
     * @ORM\Column(name="document_type_name", type="string")
     * @var string
     */
    protected $documentTypeName;
    
    /**
     * @ORM\Column(name="company_id", type="integer")
     */
    protected $company;
    
   
    /**
     * 
     * @return integer
     */
    public function getDocumentTypeId() {
        return $this->documentTypeId;
    }

    /**
     * 
     * @param integer $documentTypeId
     */
    public function setDocumentTypeId($documentTypeId) {
        $this->documentTypeId = $documentTypeId;
        return $this;
    }
    
    /**
     * 
     * @return string
     */
    public function getDocumentTypeName() {
        return $this->documentTypeName;
    }

    /**
     * 
     * @param string $documentTypeName
     */
    public function setDocumentTypeName($documentTypeName) {
        $this->documentTypeName = $documentTypeName;
        return $this;
    }
    
    public function getCompany() {
        return $this->company;
    }

    public function setCompany($company) {
        $this->company = $company;
        return $this;
    }
}
