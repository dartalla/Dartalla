<?php

namespace Product\Factory;

use Product\Controller\ProductController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class Product implements FactoryInterface {

    public function createService(ServiceLocatorInterface $controllers) {
        $products       = $controllers->getServiceLocator();
        $entitymanager  = $products->get('doctrine.entitymanager.orm_default');
        $controller     = new ProductController();
        $controller->setEntityManager($entitymanager);
        $controller->setRepository('Product\Entity\Product');
        return $controller;
    }
}
