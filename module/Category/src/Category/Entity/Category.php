<?php

namespace Category\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="category")
 */
class Category {
    
    /**
     * @ORM\Id
     * @ORM\Column(name="category_id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var integer
     */
    protected $categoryId;

    /**
     * @ORM\Column(name="category_name", type="string")
     * @var string
     */
    protected $categoryName;
    
    /**
     * @ORM\Column(name="category_is_service", type="boolean")
     */
    protected $categoryIsService;
    
    /**
     * @ORM\OneToOne(targetEntity="Category", cascade={"persist"})
     * @ORM\JoinColumn(name="category_self", referencedColumnName="category_id")
     */
    protected $categorySelf;
    
    /**
     * @ORM\OneToOne(targetEntity="Company\Entity\Company", cascade={"persist"})
     * @ORM\JoinColumn(name="company_id", referencedColumnName="company_id")
     */
    protected $companyId;
    
    /**
     * 
     * @return integer
     */
    public function getCategoryId() {
        return $this->categoryId;
    }

    /**
     * 
     * @param integer $categoryId
     */
    public function setCategoryId($categoryId) {
        $this->categoryId = $categoryId;
        return $this;
    }
    
    /**
     * 
     * @return string
     */
    public function getCategoryName() {
        return $this->categoryName;
    }

    /**
     * 
     * @param string $categoryName
     */
    public function setCategoryName($categoryName) {
        $this->categoryName = $categoryName;
        return $this;
    }
    
    /**
     * 
     * @return boolean
     */
    public function getCategoryIsService() {
        return $this->categoryIsService;
    }

    /**
     * 
     * @param boolean $categoryIsService
     * @return \Category\Entity\Category
     */
    public function setCategoryIsService($categoryIsService) {
        $this->categoryIsService = $categoryIsService;
        return $this;
    }

    /**
     * 
     * @return integer
     */
    public function getCategorySelf() {
        return $this->categorySelf;
    }

    /**
     * 
     * @param boolean $categorySelf
     */
    public function setCategorySelf($categorySelf) {
        if (empty($categorySelf)) {
            $this->categorySelf = (unset) $categorySelf;
        } else {
            $this->categorySelf = $categorySelf;
        }
        return $this;
    }
    
    public function getCompanyId() {
        return $this->companyId;
    }

    public function setCompanyId($companyId) {
        $this->companyId = $companyId;
        return $this;
    }
}
