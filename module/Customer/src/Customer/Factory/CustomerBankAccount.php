<?php

namespace Customer\Factory;

use Customer\Controller\CustomerBankAccountController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class CustomerBankAccount implements FactoryInterface {

    public function createService(ServiceLocatorInterface $controllers) {
        $services       = $controllers->getServiceLocator();
        $entitymanager  = $services->get('doctrine.entitymanager.orm_default');
        $controller     = new CustomerBankAccountController();
        $controller->setEntityManager($entitymanager);
        $controller->setRepository('CustomerBankAccount\Entity\CustomerBankAccount');
        return $controller;
    }
}
