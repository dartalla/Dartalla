<?php

namespace Business\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;

class Search extends Form {

    public function __construct() {

        parent::__construct('searchForm');

        $this->setAttribute('method', 'post')
                ->setInputFilter(new InputFilter());
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Text',
            'name' => 'date',
            'attributes' => array(
                'class' => 'span8 datepicker',
            ),
            'options' => array(
                'value' => date('d/m/Y'),
                'filters' => array(
                    new \Avr\Filter\Date()
                )
            )
        ));
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Csrf',
            'name' => 'security'
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
