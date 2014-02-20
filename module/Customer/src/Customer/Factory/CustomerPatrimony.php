<?php

namespace Customer\Factory;

use Customer\Controller\CustomerPatrimonyController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class CustomerPatrimony implements FactoryInterface {

    public function createService(ServiceLocatorInterface $controllers) {
        $services       = $controllers->getServiceLocator();
        $entitymanager  = $services->get('doctrine.entitymanager.orm_default');
        $controller     = new CustomerPatrimonyController();
        $controller->setEntityManager($entitymanager);
        $controller->setRepository('Patrimony\Entity\Patrimony');
        return $controller;
    }
}
