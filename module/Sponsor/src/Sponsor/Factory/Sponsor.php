<?php

namespace Sponsor\Factory;

use Sponsor\Controller\SponsorController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class Sponsor implements FactoryInterface {

    public function createService(ServiceLocatorInterface $controllers) {
        $services           = $controllers->getServiceLocator();
        $entityManager      = $services->get('doctrine.entitymanager.orm_default');
        $controller         = new SponsorController();
        $controller->setEntityManager($entityManager);
        $controller->setRepository('Sponsor\Entity\Sponsor');
        return $controller;
    }

}
