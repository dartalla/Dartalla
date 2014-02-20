<?php

namespace Service\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Service\Entity\Service as ServiceEntity;
use Service\Form\Fieldset\Service as ServiceFieldset;

class Service extends Form {

    public function __construct($entityManager) {
        parent::__construct('service_form');

        $classMethods = new ClassMethodsHydrator(false);
        $classMethods->addStrategy('unitId', new \Unit\Strategy\Unit());
        $classMethods->addStrategy('categoryId', new \Category\Strategy\Category());

        $hydrator = new DoctrineHydrator($entityManager, $classMethods);

        $this->setHydrator($hydrator)
                ->setObject(new ServiceEntity())
                ->setInputFilter(new InputFilter())
                ->setAttribute('method', 'post')
                ->setAttribute('class', 'form-horizontal');

        $fieldset = new ServiceFieldset($entityManager);
        $fieldset->setUseAsBaseFieldset(true);
        $this->add($fieldset);

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
                'onclick' => "javascript: window.location.href = '/admin/service'",
            )
        ));
    }

}
