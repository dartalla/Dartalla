<?php

namespace Company;

class Module {

    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig() {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__
                )
            )
        );
    }

    public function getControllerPluginConfig() {
        return array(
            'factories' => array(
                'companyAuth' => function($sm) {
                    $serviceLocator = $sm->getServiceLocator();
                    $controllerPlugin = new Controller\Plugin\CompanyAuth();
                    $controllerPlugin->setAuthService($serviceLocator->get('zfcuser_user_service')->getAuthService());
                    $controllerPlugin->setEntityManager($serviceLocator->get('doctrine.entitymanager.orm_default'));
                    $controllerPlugin->setEntity('Company\Entity\Company');
                    return $controllerPlugin;
                }
            ),
        );
    }

    public function getServiceConfig() {
        return array(
            'invokables' => array(
                'zfcuser_user_service'              => 'ZfcUser\Service\User',
            ),
        );
    }
    
    public function getViewHelperConfig() {
        return array(
            'factories' => array(
                'companyAuth' => function($sm) {
                    $serviceLocator = $sm->getServiceLocator();
                    $viewHelper = new View\Helper\CompanyAuth();
                    $viewHelper->setAuthService($serviceLocator->get('zfcuser_user_service')->getAuthService());
                    $viewHelper->setEntityManager($serviceLocator->get('doctrine.entitymanager.orm_default'));
                    $viewHelper->setEntity('Company\Entity\Company');
                    return $viewHelper;
                }
            )
        );
    }
}
