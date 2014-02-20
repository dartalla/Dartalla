<?php

namespace Patrimony\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset as ZendFielset;

class Patrimony extends ZendFielset implements InputFilterProviderInterface {

    public function __construct() {
        parent::__construct('patrimony');
        
        $this->add(array(
            'name' => 'patrimonyId',
            'type' => 'Zend\Form\Element\Hidden',
        ));
        
        $this->add(array(
            'name' => 'patrimonyName',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'patrimony_name',
                'placeholder'   => 'Patrimônio',
                'class'         => 'form-control input-sm',
            ),
            'options' => array(
                'label' => 'Patrimônio'
            ),
        ));
        
        $this->add(array(
            'name' => 'patrimonyValue',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'patrimony_value',
                'placeholder'   => 'Valor',
                'class'         => 'form-control input-sm currency',
            ),
            'options' => array(
                'label' => 'Valor'
            ),
        ));
    }

    public function getInputFilterSpecification() {
        return array();
    }

}
