<?php

namespace Unit\Form\Fieldset;

use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset as ZendFielset;
use Unit\Entity\Unit as UnitEntity;

class Unit extends ZendFielset implements InputFilterProviderInterface {

    public function __construct() {
        parent::__construct('unit');
        
        $this->setHydrator(new ClassMethodsHydrator(false))
                ->setObject(new UnitEntity());

        $this->add(array(
            'name' => 'unitId',
            'type' => 'Zend\Form\Element\Hidden',
        ));
        
        $this->add(array(
            'name' => 'unitName',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder'   => 'Unidade',
                'class'         => 'span4',
                'required'      => 'required',
            ),
        ));
        
        $this->add(array(
            'name' => 'unitSymbol',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder' => 'Sigla',
                'class' => 'span2',
                'required' => 'required',
                'maxlength' => 2,
            ),
        ));
    }

    public function getInputFilterSpecification() {
        return array(
            'unitName' => array(
                'required' => true,
                'filters' => array(
                    array('name' => 'StringTrim'),
                    array('name' => 'StripTags'),
                )
            ),
            'unitSymbol' => array(
                'required' => true,
                'filters' => array(
                    array('name' => 'StringTrim'),
                    array('name' => 'StripTags'),
                    array('name' => 'Alnum'),
                    array('name' => 'StringToUpper'),
                )
            ),
        );
    }
}
