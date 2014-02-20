<?php

namespace Business\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Business\Entity\ServiceOrder as ServiceOrderEntity;

class ServiceOrder extends Form {

    public function __construct($entityManager, $companyId) {

        parent::__construct('service-order_form');

        $classMethod = new \Zend\Stdlib\Hydrator\ClassMethods(false);
        
        $this->setAttribute('method', 'post')
                ->setAttribute('class', 'form-horizontal')
                ->setHydrator(new DoctrineHydrator($entityManager, $classMethod))
                ->setObject(new ServiceOrderEntity())
                ->setInputFilter(new InputFilter());
        
        $serviceOrder = new Fieldset\ServiceOrder($entityManager, $companyId);
        $serviceOrder->setUseAsBaseFieldset(true);
        $this->add($serviceOrder);
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Csrf',
            'name' => 'security'
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Submit',
            'name' => 'submit',
            'attributes' => array(
                'value' => 'Salvar',
                'class' => 'btn btn-primary'
            )
        ));

        $this->add(array(
            'name' => 'cancel',
            'attributes' => array(
                'type' => 'button',
                'value' => 'Cancel',
                'class' => 'btn',
                'onclick' => "javascript: window.location.href = '/admin/financial/service-order'",
            )
        ));
    }
}
