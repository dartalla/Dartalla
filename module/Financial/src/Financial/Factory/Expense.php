<?php

namespace Financial\Factory;

use Financial\Controller\ExpenseController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class Expense implements FactoryInterface {

    public function createService(ServiceLocatorInterface $controllers) {
        $services       = $controllers->getServiceLocator();
        $entitymanager  = $services->get('doctrine.entitymanager.orm_default');
        $controller     = new ExpenseController();
        $controller->setEntityManager($entitymanager);
        $controller->setService($services->get('financial_expense_service'));
        return $controller;
    }
}
