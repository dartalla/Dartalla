<?php

namespace Employee\Factory;

use Employee\Controller\EmployeeController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class Employee implements FactoryInterface {

    public function createService(ServiceLocatorInterface $controllers) {
        $services           = $controllers->getServiceLocator();
        $entityManager      = $services->get('doctrine.entitymanager.orm_default');
        $controller         = new EmployeeController();
        $controller->setEntityManager($entityManager);
        $controller->setRepository('Employee\Entity\Employee');
        return $controller;
    }

}
