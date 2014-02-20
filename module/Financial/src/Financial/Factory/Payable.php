<?php

namespace Financial\Factory;

use Financial\Controller\PayableController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class Payable implements FactoryInterface {

    public function createService(ServiceLocatorInterface $controllers) {
        $services       = $controllers->getServiceLocator();
        $entitymanager  = $services->get('doctrine.entitymanager.orm_default');
        $controller     = new PayableController();
        $controller->setEntityManager($entitymanager);
        $controller->setRepository('Financial\Entity\Payable');
        return $controller;
    }
}
