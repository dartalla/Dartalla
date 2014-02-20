<?php

namespace Seller\Factory;

use Seller\Controller\SellerController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class Seller implements FactoryInterface {

    public function createService(ServiceLocatorInterface $controllers) {
        $services           = $controllers->getServiceLocator();
        $entityManager      = $services->get('doctrine.entitymanager.orm_default');
        $controller         = new SellerController();
        $controller->setEntityManager($entityManager);
        $controller->setRepository('Seller\Entity\Seller');
        return $controller;
    }

}
