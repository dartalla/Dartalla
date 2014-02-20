<?php

namespace Customer\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;

class CustomerBankAccount extends Form {

    public function __construct($entityManager, $id) {

        parent::__construct('customer_bank_account_form');

        $this->setAttribute('method', 'post')
                ->setInputFilter(new InputFilter());
        
        $customerBankAccount = new \Customer\Form\Fieldset\CustomerBankAccount($entityManager, $id);
        $customerBankAccount->setUseAsBaseFieldset(true);
        $this->add($customerBankAccount);
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Csrf',
            'name' => 'security'
        ));

        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type' => 'button',
                'value' => 'Salvar',
                'class' => 'btn btn-primary',
                'onclick' => 'javascript: customerBankAccountPost();'
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
