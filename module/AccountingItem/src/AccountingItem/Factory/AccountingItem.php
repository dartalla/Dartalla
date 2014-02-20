<?php

namespace AccountingItem\Factory;

use AccountingItem\Controller\AccountingItemController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class AccountingItem implements FactoryInterface {

    public function createService(ServiceLocatorInterface $controllers) {
        $services       = $controllers->getServiceLocator();
        $entitymanager  = $services->get('doctrine.entitymanager.orm_default');
        $controller     = new AccountingItemController();
        $controller->setEntityManager($entitymanager);
        $controller->setRepository('AccountingItem\Entity\AccountingItem');
        return $controller;
    }
}
