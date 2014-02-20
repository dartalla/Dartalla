<?php

namespace Customer\Factory;

use Customer\Controller\CustomerController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class Customer implements FactoryInterface {

    public function createService(ServiceLocatorInterface $controllers) {
        $services           = $controllers->getServiceLocator();
        $entityManager      = $services->get('doctrine.entitymanager.orm_default');
        $controller         = new CustomerController();
        $controller->setEntityManager($entityManager);
        $controller->setRepository('Customer\Entity\Customer');
        return $controller;
    }

}
