<?php

namespace Financial\Factory;

use Financial\Controller\RevenueController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class Revenue implements FactoryInterface {

    public function createService(ServiceLocatorInterface $controllers) {
        $services       = $controllers->getServiceLocator();
        $entitymanager  = $services->get('doctrine.entitymanager.orm_default');
        $controller     = new RevenueController();
        $controller->setEntityManager($entitymanager);
        $controller->setService($services->get('financial_revenue_service'));
        return $controller;
    }
}
