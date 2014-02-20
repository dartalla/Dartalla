<?php

namespace BankAccount\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset as ZendFielset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use BankAccount\Entity\BankAccount as BankAccountEntity;

class BankAccount extends ZendFielset implements InputFilterProviderInterface {

    public function __construct($entityManager) {
        parent::__construct('bankAccount');
        
        $this->setHydrator(new DoctrineHydrator($entityManager))
                ->setObject(new BankAccountEntity());        
        
        $this->add(array(
            'name' => 'bankAccountId',
            'type' => 'Zend\Form\Element\Hidden',
        ));
        
        $this->add(array(
            'name' => 'bankAccountType',
            'type' => 'Zend\Form\Element\Select',
            'attributes' => array(
                'id' => 'bank_account_type',
                'placeholder'   => 'Tipo da Conta',
                'class'         => 'form-control input-sm',
            ),
            'options' => array(
                'empty_option' => 'Tipo da Conta',
                'value_options' => array(
                    'CONTA CORRENTE INDIVIDUAL' => 'CONTA CORRENTE INDIVIDUAL',
                    'CONTA CORRENTE CONJUNTA' => 'CONTA CORRENTE CONJUNTA',
                    'CONTA POUPANÇA INDIVIDUAL' => 'CONTA POUPANÇA INDIVIDUAL',
                    'CONTA POUPANÇA CONJUNTA' => 'CONTA POUPANÇA CONJUNTA',
                    'ORDEM DE PAGAMENTO' => 'ORDEM DE PAGAMENTO',
                ),
                'label' => 'Tipo da Conta'
            ),
        ));
        
        $this->add(array(
            'name' => 'bankAccountBank',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'bank_account_bank',
                'placeholder'   => 'Banco',
                'class'         => 'form-control input-sm',
            ),
            'options' => array(
                'label' => 'Banco'
            ),
        ));
        
        $this->add(array(
            'name' => 'bankAccountAgency',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'bank_account_agency',
                'placeholder'   => 'Agência',
                'class'         => 'form-control input-sm',
            ),
            'options' => array(
                'label' => 'Agência'
            ),
        ));
        
        $this->add(array(
            'name' => 'bankAccountAccount',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'bank_account_account',
                'placeholder'   => 'Conta',
                'class'         => 'form-control input-sm',
            ),
            'options' => array(
                'label' => 'Conta'
            ),
        ));
        
        $this->add(array(
            'name' => 'bankAccountSince',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'bank_account_since',
                'placeholder'   => 'Cliente Desde',
                'class'         => 'form-control input-sm',
            ),
            'options' => array(
                'label' => 'Cliente Desde'
            ),
        ));
    }

    public function getInputFilterSpecification() {
        return array(
            'bankAccountSince' => array(
                'required' => false,
                'filters' => array(
                    array(
                        'name' => 'Avr\Filter\Date',
                    )
                )
            ),
            'bankAccountType' => array(
                'required' => false,
            ),
        );
    }

}
