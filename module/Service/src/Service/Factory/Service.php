<?php

namespace Service\Factory;

use Service\Controller\ServiceController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class Service implements FactoryInterface {

    public function createService(ServiceLocatorInterface $controllers) {
        $services       = $controllers->getServiceLocator();
        $entitymanager  = $services->get('doctrine.entitymanager.orm_default');
        $controller     = new ServiceController();
        $controller->setEntityManager($entitymanager);
        $controller->setRepository('Service\Entity\Service');
        return $controller;
    }
}
