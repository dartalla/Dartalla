<?php

namespace Financial\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;

class Discharge extends Form {

    public function __construct() {

        parent::__construct('discharge');

        $this->setAttribute('method', 'post')
                ->setAttribute('class', 'form-horizontal')
                ->setInputFilter(new InputFilter());
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Text',
            'name' => 'expiration',
            'attributes' => array(
                'class' => 'form-control input-sm col-md-3 datepicker',
            ),
            'options' => array(
                'filters' => array(
                    new \Avr\Filter\Date()
                )
            )
        ));
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Text',
            'name' => 'discharge',
            'attributes' => array(
                'class' => 'form-control input-sm col-md-3 datepicker',
            ),
            'options' => array(
                'filters' => array(
                    new \Avr\Filter\Date()
                )
            )
        ));
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Text',
            'name' => 'value',
            'attributes' => array(
                'class' => 'form-control input-sm col-md-3 currency',
            ),
            'options' => array(
                'filters' => array(
                    new \Zend\I18n\Filter\NumberFormat()
                )
            )
        ));
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Button',
            'name' => 'submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Salvar',
                'class' => 'btn btn-info'
            )
        ));
    }
}
