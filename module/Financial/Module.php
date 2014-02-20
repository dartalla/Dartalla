<?php

/**
 * @author Acácio Vilela <acaciovilela@gmail.com>
 * @copyright (c) 2012, Acácio Vilela
 * 
 * Module for Financial
 */
namespace Financial;

class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    
    public function getServiceConfig() {
        return array(
            'factories' => array(
                'financial_expense_service' => function($sm) {
                    $entityManager = $sm->get('Doctrine\ORM\EntityManager');
                    $repository = 'Financial\Entity\Expense';
                    $service = new \Financial\Service\Expense();
                    $service->setEntityManager($entityManager);
                    $service->setRepository($repository);
                    return $service;
                },
                'financial_revenue_service' => function($sm) {
                    $entityManager = $sm->get('Doctrine\ORM\EntityManager');
                    $repository = 'Financial\Entity\Revenue';
                    $service = new \Financial\Service\Revenue();
                    $service->setEntityManager($entityManager);
                    $service->setRepository($repository);
                    return $service;
                },
                'financial_cash_service' => function($sm) {
                    $entityManager = $sm->get('Doctrine\ORM\EntityManager');
                    $revenue = 'Financial\Entity\Revenue';
                    $expense = 'Financial\Entity\Expense';
                    $service = new \Financial\Service\Cash();
                    $service->setEntityManager($entityManager);
                    $service->setRevenue($revenue);
                    $service->setExpense($expense);
                    return $service;
                },
            ),
        );
    }
    
    public function getViewHelperConfig() {
        return array(
            'factories' => array(
                'launch' => function($sm) {
                    $serviceLocator = $sm->getServiceLocator();
                    $viewHelper = new View\Helper\Launch();
                    $viewHelper->setEntityManager($serviceLocator->get('doctrine.entitymanager.orm_default'));
                    $viewHelper->setEntity('Financial\Entity\Launch');
                    return $viewHelper;
                }
            )
        );
    }
}
