<?php

namespace Department\Factory;

use Department\Controller\DepartmentController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class Department implements FactoryInterface {

    public function createService(ServiceLocatorInterface $controllers) {
        $services       = $controllers->getServiceLocator();
        $entitymanager  = $services->get('doctrine.entitymanager.orm_default');
        $controller     = new DepartmentController();
        $controller->setEntityManager($entitymanager);
        $controller->setRepository('Department\Entity\Department');
        return $controller;
    }
}
