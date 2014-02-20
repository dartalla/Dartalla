<?php

/**
 * @author Acácio Vilela <acaciovilela@gmail.com>
 * @copyright (c) 2012, Acácio Vilela
 * 
 * Module for banks
 */
namespace Avr;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

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
    
    public function getControllerPluginConfig() {
        return array(
            'factories' => array(
                'convertToCurrency' => function($sm) {
                    $controllerPlugin = new Controller\Plugin\Currency();
                    return $controllerPlugin;
                },
                'dump' => function($sm) {
                    $controllerPlugin = new Controller\Plugin\Dump();
                    return $controllerPlugin;
                },
            ),
        );
    }
}
