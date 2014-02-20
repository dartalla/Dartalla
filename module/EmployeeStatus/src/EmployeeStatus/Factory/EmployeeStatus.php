<?php

namespace EmployeeStatus\Factory;

use EmployeeStatus\Controller\EmployeeStatusController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class EmployeeStatus implements FactoryInterface {

    public function createService(ServiceLocatorInterface $controllers) {
        $services       = $controllers->getServiceLocator();
        $entitymanager  = $services->get('doctrine.entitymanager.orm_default');
        $controller     = new EmployeeStatusController();
        $controller->setEntityManager($entitymanager);
        $controller->setRepository('EmployeeStatus\Entity\EmployeeStatus');
        return $controller;
    }
}
