<?php

namespace Unit\Factory;

use Unit\Controller\UnitController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class Unit implements FactoryInterface {

    public function createService(ServiceLocatorInterface $controllers) {
        $services       = $controllers->getServiceLocator();
        $entitymanager  = $services->get('doctrine.entitymanager.orm_default');
        $controller     = new UnitController();
        $controller->setEntityManager($entitymanager);
        $controller->setRepository('Unit\Entity\Unit');
        return $controller;
    }
}
