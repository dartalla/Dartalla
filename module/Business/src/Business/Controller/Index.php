<?php

namespace Business\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class Index extends AbstractActionController {

    protected $entityManager;

    public function indexAction() {
        
    }

    public function getEntityManager() {
        return $this->entityManager;
    }

    public function setEntityManager($entityManager) {
        $this->entityManager = $entityManager;
    }
}
