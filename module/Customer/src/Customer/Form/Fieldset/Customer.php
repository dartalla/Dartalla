<?php

namespace Customer\Form\Fieldset;

use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Customer\Entity\Customer as CustomerEntity;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset as ZendFielset;

class Customer extends ZendFielset implements InputFilterProviderInterface {

    public function __construct($entityManager) {
        parent::__construct('customer');

        $this->setHydrator(new DoctrineHydrator($entityManager))
                ->setObject(new CustomerEntity());

        $this->add(array(
            'name' => 'customerId',
            'type' => 'Zend\Form\Element\Hidden',
        ));
        
        $this->add(array(
            'name' => 'customerResidenceType',
            'type' => 'Zend\Form\Element\Select',
            'attributes' => array(
                'placeholder' => 'Tipo de Residência',
                'class' => 'form-control input-sm',
            ),
            'options' => array(
                'label' => 'Tipo de Residência',
                'empty_option' => 'Selecione o Tipo',
                'value_options' => array(
                    'ALUGADA' => 'ALUGADA',
                    'CEDIDA' => 'CEDIDA',
                    'EMPRESTADA' => 'EMPRESTADA',
                    'FAMILIAR' => 'FAMILIAR',
                    'PRÓPRIA' => 'PRÓPRIA',
                    'OUTRO' => 'OUTRO',
                )
            ),
        ));
        
        $this->add(array(
            'name' => 'customerResidenceTime',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder' => 'Tempo na Resid.',
                'class' => 'form-control input-sm',
            ),
            'options' => array(
                'label' => 'Tempo na Resid.',
            ),
        ));
        
        $this->add(array(
            'name' => 'customerResidenceRentValue',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder' => 'Valor do Aluguel',
                'class' => 'form-control input-sm currency',
            ),
            'options' => array(
                'label' => 'Valor do Aluguel',
            ),
        ));
        
        $this->add(array(
            'name' => 'customerNotes',
            'type' => 'Zend\Form\Element\Textarea',
            'attributes' => array(
                'placeholder' => 'Observações',
                'class' => 'form-control input-sm',
                'rows' => 6,
            ),
            'options' => array(
                'label' => 'Observações',
            ),
        ));
        
        $person = new \Person\Form\Fieldset\Person($entityManager);
        $person->setName('person')
                ->setLabel('Dados Gerais');
        $this->add($person);
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'companyId',
        ));
    }
    
    public function getInputFilterSpecification() {
        return array(
            'customerId' => array(
                'required' => false,
            ),
            'customerResidenceType' => array(
                'required' => false,
            ),
            'customerResidenceRentValue' => array(
                'required' => false,
                'filters' => array(
                    new \Zend\I18n\Filter\NumberFormat()
                )
            ),
        );
    }
}
