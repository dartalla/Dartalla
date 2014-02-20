<?php

namespace Unit\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;
use Unit\Entity\Unit as UnitEntity;
use Unit\Form\Fieldset\Unit as UnitFieldset;

class Unit extends Form {

    public function __construct($entityManager = null) {

        parent::__construct('unit_form');

        $this->setAttribute('method', 'post')
                ->setHydrator(new ClassMethodsHydrator(false))
                ->setObject(new UnitEntity())
                ->setInputFilter(new InputFilter());
        
        $unit = new UnitFieldset($entityManager);
        $unit->setUseAsBaseFieldset(true);
        $this->add($unit);
        
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
                'onclick' => "javascript: window.location.href = '/admin/unit'",
            )
        ));
    }
}
