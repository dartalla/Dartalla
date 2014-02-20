<?php

namespace Admin\Factory;

use Admin\Controller\IndexController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class Index implements FactoryInterface {

    public function createService(ServiceLocatorInterface $controllers) {
        $services       = $controllers->getServiceLocator();
        $entitymanager  = $services->get('Doctrine\ORM\EntityManager');
        $controller     = new IndexController();
        $controller->setEntityManager($entitymanager);
        return $controller;
    }
}
