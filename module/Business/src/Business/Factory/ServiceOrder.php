<?php

namespace Business\Factory;

use Business\Controller\ServiceOrder as ServiceOrderController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ServiceOrder implements FactoryInterface {

    public function createService(ServiceLocatorInterface $controllers) {
        $services       = $controllers->getServiceLocator();
        $entitymanager  = $services->get('doctrine.entitymanager.orm_default');
        $controller     = new ServiceOrderController();
        $controller->setEntityManager($entitymanager);
        $controller->setRepository('Business\Entity\ServiceOrder');
        return $controller;
    }
}
