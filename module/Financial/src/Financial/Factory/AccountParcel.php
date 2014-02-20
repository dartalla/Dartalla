<?php

namespace Financial\Factory;

use Financial\Controller\AccountParcelController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class AccountParcel implements FactoryInterface {

    public function createService(ServiceLocatorInterface $controllers) {
        $services       = $controllers->getServiceLocator();
        $entitymanager  = $services->get('doctrine.entitymanager.orm_default');
        $controller     = new AccountParcelController();
        $controller->setEntityManager($entitymanager);
        $controller->setRepository('Financial\Entity\AccountParcel');
        return $controller;
    }
}
