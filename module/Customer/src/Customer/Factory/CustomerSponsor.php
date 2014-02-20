<?php

namespace Customer\Factory;

use Customer\Controller\CustomerSponsorController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class CustomerSponsor implements FactoryInterface {

    public function createService(ServiceLocatorInterface $controllers) {
        $services       = $controllers->getServiceLocator();
        $entitymanager  = $services->get('doctrine.entitymanager.orm_default');
        $controller     = new CustomerSponsorController();
        $controller->setEntityManager($entitymanager);
        $controller->setRepository('Sponsor\Entity\Sponsor');
        return $controller;
    }
}
