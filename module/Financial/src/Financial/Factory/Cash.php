<?php

namespace Financial\Factory;

use Financial\Controller\Cash as CashController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class Cash implements FactoryInterface {

    public function createService(ServiceLocatorInterface $controllers) {
        $services       = $controllers->getServiceLocator();
        $entitymanager  = $services->get('doctrine.entitymanager.orm_default');
        $controller     = new CashController();
        $controller->setEntityManager($entitymanager);
        $controller->setService($services->get('financial_cash_service'));
        return $controller;
    }
}
