<?php

namespace Purchase\Factory;

use Purchase\Controller\Purchase as PurchaseController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class Purchase implements FactoryInterface {

    public function createService(ServiceLocatorInterface $controllers) {
        $services       = $controllers->getServiceLocator();
        $entitymanager  = $services->get('doctrine.entitymanager.orm_default');
        $controller     = new PurchaseController();
        $controller->setEntityManager($entitymanager);
        return $controller;
    }
}
