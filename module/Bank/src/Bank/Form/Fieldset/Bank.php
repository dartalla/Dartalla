<?php

namespace Bank\Form\Fieldset;

use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset as ZendFielset;
use Bank\Entity\Bank as BankEntity;

class Bank extends ZendFielset implements InputFilterProviderInterface {

    public function __construct($entityManager) {
        parent::__construct('bank');
        
        $this->setHydrator(new DoctrineHydrator($entityManager))
                ->setObject(new BankEntity());

        $this->add(array(
            'name' => 'bankId',
            'type' => 'Zend\Form\Element\Hidden',
        ));
        
        $this->add(array(
            'name' => 'bankCode',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder'   => 'Número',
                'class'         => 'form-control input-sm',
                'required'      => 'required',
            ),
            'options' => array(
                'label' => 'Código'
            ),
        ));
        
        $this->add(array(
            'name' => 'bankName',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder'   => 'Nome do Banco',
                'class'         => 'form-control input-sm',
                'required'      => 'required',
            ),
            'options' => array(
                'label' => 'Nome do Banco'
            ),
        ));
        
        $this->add(array(
            'name' => 'bankWebsite',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder'   => 'Site do Banco',
                'class'         => 'form-control input-sm',
            ),
            'options' => array(
                'label' => 'Site do Banco'
            ),
        ));
    }

    public function getInputFilterSpecification() {
        return array(
            'bankCode' => array(
                'required' => true,
                'filters' => array(
                    array('name' => 'Digits'),
                )
            ),
            'bankName' => array(
                'required' => true,
            ),
            'bankWebsite' => array(
                'required' => false,
            ),
        );
    }

}
