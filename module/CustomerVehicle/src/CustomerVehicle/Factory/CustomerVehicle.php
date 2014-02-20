<?php

namespace CustomerVehicle\Factory;

use CustomerVehicle\Controller\CustomerVehicleController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class CustomerVehicle implements FactoryInterface {

    public function createService(ServiceLocatorInterface $controllers) {
        $services       = $controllers->getServiceLocator();
        $entitymanager  = $services->get('doctrine.entitymanager.orm_default');
        $controller     = new CustomerVehicleController();
        $controller->setEntityManager($entitymanager);
        $controller->setRepository('CustomerVehicle\Entity\CustomerVehicle');
        return $controller;
    }
}
