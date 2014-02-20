<?php

namespace Bank\Factory;

use Bank\Controller\BankController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class Bank implements FactoryInterface {

    public function createService(ServiceLocatorInterface $controllers) {
        $services       = $controllers->getServiceLocator();
        $entitymanager  = $services->get('doctrine.entitymanager.orm_default');
        $controller     = new BankController();
        $controller->setEntityManager($entitymanager);
        $controller->setRepository('Bank\Entity\Bank');
        return $controller;
    }
}
