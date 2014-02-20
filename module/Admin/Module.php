<?php

namespace Admin;

use Zend\ModuleManager\Feature;
use Zend\Loader;
use Zend\EventManager\EventInterface;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\Router\RouteMatch;

/**
 * Module class for Admin
 *
 * @package Admin
 */
class Module implements
Feature\AutoloaderProviderInterface, Feature\ConfigProviderInterface, Feature\ServiceProviderInterface, Feature\BootstrapListenerInterface {

    /**
     * @{inheritdoc}
     */
    public function getAutoloaderConfig() {
        return array(
            Loader\AutoloaderFactory::STANDARD_AUTOLOADER => array(
                Loader\StandardAutoloader::LOAD_NS => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    /**
     * @{inheritdoc}
     */
    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
    }

    /**
     * @{inheritdoc}
     */
    public function getServiceConfig() {
        return array(
            'factories' => array(
                'admin_navigation' => 'Admin\Navigation\Service\AdminNavigationFactory',
            ),
        );
    }

    /**
     * @{inheritdoc}
     */
    public function onBootstrap(EventInterface $e) {
        $app = $e->getParam('application');
        $em = $app->getEventManager();

        $em->attach(MvcEvent::EVENT_DISPATCH, array($this, 'selectLayoutBasedOnRoute'));
    }

    /**
     * Select the admin layout based on route name
     *
     * @param  MvcEvent $e
     * @return void
     */
    public function selectLayoutBasedOnRoute(MvcEvent $e) {
        $app = $e->getParam('application');
        $sm = $app->getServiceManager();
        $config = $sm->get('config');

        if (false === $config['admin']['use_admin_layout']) {
            return;
        }
        
        $match = $e->getRouteMatch();
        if (!$match instanceof RouteMatch || 0 !== strpos($match->getMatchedRouteName(), 'admin')) {
            return;
        }
        if ($app->getRequest()->isXmlHttpRequest()) {
            $layout = $app->getMvcEvent()->getViewModel();
            $controller = $e->getTarget();
            $controller->layout('layout/blank');
            $layout->setTerminal(true);
        } else {
            $layout = $config['admin']['admin_layout_template'];
            $controller = $e->getTarget();
            $controller->layout($layout);
        }
    }

}