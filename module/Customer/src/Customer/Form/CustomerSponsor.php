<?php

namespace Customer\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;

class CustomerSponsor extends Form {

    public function __construct($entityManager, $id) {

        parent::__construct('customer_sponsor_form');

        $this->setAttribute('method', 'post')
                ->setInputFilter(new InputFilter());
        
        $customerSponsor = new \CustomerSponsor\Form\Fieldset\CustomerSponsor($entityManager, $id);
        $customerSponsor->setUseAsBaseFieldset(true);
        $this->add($customerSponsor);
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Csrf',
            'name' => 'security'
        ));

        $this->add(array(
            'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
                'value' => 'Salvar',
                'class' => 'btn btn-primary',
            ),
        ));

        $this->add(array(
            'name' => 'cancel',
            'attributes' => array(
                'type' => 'button',
                'value' => 'Voltar',
                'class' => 'btn btn-default',
                'onclick' => "javascript: window.location.href = '/admin/customer'",
            )
        ));
    }
}
