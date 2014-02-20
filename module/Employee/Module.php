<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Employee;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module {

    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig() {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getControllerPluginConfig() {
        return array(
            'factories' => array(
                'employee' => function($sm) {
                    $serviceLocator = $sm->getServiceLocator();
                    $controllerPlugin = new Controller\Plugin\Employee();
                    $controllerPlugin->setAuthService($serviceLocator->get('zfcuser_user_service')->getAuthService());
                    $controllerPlugin->setEntityManager($serviceLocator->get('doctrine.entitymanager.orm_default'));
                    $controllerPlugin->setEntity('Employee\Entity\Employee');
                    return $controllerPlugin;
                }
            ),
        );
    }

    public function getServiceConfig() {
        return array(
            'invokables' => array(
                'zfcuser_user_service' => 'ZfcUser\Service\User',
            ),
        );
    }

    public function getViewHelperConfig() {
        return array(
            'factories' => array(
                'employee' => function($sm) {
                    $serviceLocator = $sm->getServiceLocator();
                    $viewHelper = new View\Helper\Employee();
                    $viewHelper->setAuthService($serviceLocator->get('zfcuser_user_service')->getAuthService());
                    $viewHelper->setEntityManager($serviceLocator->get('doctrine.entitymanager.orm_default'));
                    $viewHelper->setEntity('Employee\Entity\Employee');
                    return $viewHelper;
                }
            )
        );
    }
}
