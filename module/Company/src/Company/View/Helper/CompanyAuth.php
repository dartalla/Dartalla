<?php

namespace Company\View\Helper;

use Zend\View\Helper\AbstractHelper;

class CompanyAuth extends AbstractHelper {

    protected $authService;
    protected $entityManager;
    protected $entity;

    public function __invoke() {

        $identity = $this->getAuthService()->getIdentity();

        $entityManager = $this->getEntityManager();
        
        $employee = $entityManager->getRepository('Employee\Entity\Employee')->findOneBy(array(
            'user' => $identity->getId()
        ));

        if ($employee) {
            $company = $entityManager->find($this->getEntity(), $employee->getCompanyId());
            return $company;
        }

        $company = $entityManager->getRepository($this->getEntity())->findOneBy(array('user' => $identity->getId()));
        
        return $company;
    }

    public function getAuthService() {
        return $this->authService;
    }

    public function setAuthService($authService) {
        $this->authService = $authService;
        return $this;
    }

    public function getEntityManager() {
        return $this->entityManager;
    }

    public function setEntityManager($entityManager) {
        $this->entityManager = $entityManager;
        return $this;
    }

    public function getEntity() {
        return $this->entity;
    }

    public function setEntity($entity) {
        $this->entity = $entity;
        return $this;
    }
}
