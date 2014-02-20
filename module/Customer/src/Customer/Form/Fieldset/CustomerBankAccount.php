<?php

namespace Customer\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset as ZendFielset;

class CustomerBankAccount extends ZendFielset implements InputFilterProviderInterface {

    public function __construct($entityManager, $id) {
        parent::__construct('customerBankAccount');
        
        $this->add(array(
            'name' => 'customerBankAccountId',
            'type' => 'Zend\Form\Element\Hidden',
        ));
        
        $this->add(array(
            'name' => 'customerId',
            'type' => 'DoctrineORMModule\Form\Element\EntitySelect',
            'options' => array(
                'object_manager' => $entityManager,
                'target_class' => 'Customer\Entity\Customer',
                'property' => 'customerName',
                'is_method' => true,
                'find_method' => array(
                    'name' => 'findBy',
                    'params' => array(
                        'criteria'=> array('customerId' => $id),
                    )
                ),
                'label' => 'Cliente'
            ),
            'attributes' => array(
                'id' => 'customer_id',
                'class' => 'form-control input-sm',
            )
        ));
        
        $bankAccount = new \BankAccount\Form\Fieldset\BankAccount($entityManager);
        $bankAccount->setName('bankAccount')
                ->setLabel('Conta Bancária');
        $this->add($bankAccount);
    }

    public function getInputFilterSpecification() {
        return array(
            'customerBankAccountSince' => array(
                'filters' => array(
                    array(
                        'name' => 'Avr\Filter\Date',
                    )
                )
            )
        );
    }

}
