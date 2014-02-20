<?php

namespace Business\Factory;

use Business\Controller\Sale as SaleController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class Sale implements FactoryInterface {

    public function createService(ServiceLocatorInterface $controllers) {
        $services       = $controllers->getServiceLocator();
        $entitymanager  = $services->get('doctrine.entitymanager.orm_default');
        $controller     = new SaleController();
        $controller->setEntityManager($entitymanager);
        $controller->setRepository('Business\Entity\Sale');
        return $controller;
    }
}
