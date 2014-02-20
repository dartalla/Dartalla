<?php

namespace Financial\Factory;

use Financial\Controller\ReceivableController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class Receivable implements FactoryInterface {

    public function createService(ServiceLocatorInterface $controllers) {
        $services       = $controllers->getServiceLocator();
        $entitymanager  = $services->get('doctrine.entitymanager.orm_default');
        $controller     = new ReceivableController();
        $controller->setEntityManager($entitymanager);
        $controller->setRepository('Financial\Entity\Receivable');
        return $controller;
    }
}
