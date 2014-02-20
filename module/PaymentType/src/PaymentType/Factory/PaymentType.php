<?php

namespace PaymentType\Factory;

use PaymentType\Controller\PaymentTypeController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class PaymentType implements FactoryInterface {

    public function createService(ServiceLocatorInterface $controllers) {
        $services       = $controllers->getServiceLocator();
        $entitymanager  = $services->get('doctrine.entitymanager.orm_default');
        $controller     = new PaymentTypeController();
        $controller->setEntityManager($entitymanager);
        $controller->setRepository('PaymentType\Entity\PaymentType');
        return $controller;
    }
}
