<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Person;

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

    public function getServiceConfig() {
        return array(
            'invokables' => array(
                'Person\Form\Fieldset\Individual' => 'individual_person_fieldset'
            ),
            'factories' => array(
                'individual_person_fieldset' => function($sm) {
                    $em = $sm->get('Doctrine\ORM\EntityManager');
                    $fieldset = new Form\Fieldset\Individual();
                    $fieldset->setEntityManager($em);
                    return $fieldset;
                }
            )
        );
    }

    public function getViewHelperConfig() {
        return array(
            'invokables' => array(
                'personForm' => 'Person\Form\View\Helper\PersonForm',
                'addressForm' => 'Person\Form\View\Helper\AddressForm',
                'contactForm' => 'Person\Form\View\Helper\ContactForm',
                'individualForm' => 'Person\Form\View\Helper\IndividualForm',
                'legalForm' => 'Person\Form\View\Helper\LegalForm',
                'professionalForm' => 'Person\Form\View\Helper\ProfessionalForm',
                'professionalAddonForm' => 'Person\Form\View\Helper\ProfessionalAddonForm',
            ),
        );
    }

}
