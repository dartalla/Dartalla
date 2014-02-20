<?php

namespace Person\Form\Fieldset;

use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use Person\Entity\Address as AddressEntity;

class Address extends Fieldset implements InputFilterProviderInterface {

    public function __construct($entityManager) {
        
        parent::__construct('address');

        $this->setHydrator(new DoctrineHydrator($entityManager))
                ->setObject(new AddressEntity());

        $this->add(array(
            'name' => 'addressId',
            'type' => 'Zend\Form\Element\Hidden',
        ));

        $this->add(array(
            'name' => 'addressName',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder' => 'Endereço',
                'class' => 'form-control input-sm',
            ),
            'options' => array(
                'label' => 'Endereço'
            ),
        ));

        $this->add(array(
            'name' => 'addressNumber',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder' => 'Nº',
                'class' => 'form-control input-sm',
            ),
            'options' => array(
                'label' => 'Nº'
            ),
        ));

        $this->add(array(
            'name' => 'addressComplement',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder' => 'Complemento',
                'class' => 'form-control input-sm',
            ),
            'options' => array(
                'label' => 'Complemento'
            ),
        ));

        $this->add(array(
            'name' => 'addressQuarter',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder' => 'Bairro',
                'class' => 'form-control input-sm',
            ),
            'options' => array(
                'label' => 'Bairro'
            ),
        ));

        $this->add(array(
            'name' => 'addressPostalCode',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder' => 'CEP',
                'class' => 'form-control input-sm cep',
                'onblur' => 'javascript: fetchAddressByCep(this.value);'
            ),
            'options' => array(
                'label' => 'CEP'
            ),
        ));

        $this->add(array(
            'name' => 'addressCity',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder' => 'Cidade',
                'class' => 'form-control input-sm city',
                'id' => 'city',
                'readonly' => 'readonly',
            ),
            'options' => array(
                'label' => 'Cidade'
            ),
        ));
        
        $this->add(array(
            'name' => 'addressState',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder' => 'Estado',
                'class' => 'form-control input-sm state',
                'id' => 'state',
                'readonly' => 'readonly',
            ),
            'options' => array(
                'label' => 'Estado'
            ),
        ));
        
        $this->add(array(
            'name' => 'addressCountry',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder' => 'País',
                'class' => 'form-control input-sm country',
                'id' => 'country',
                'readonly' => 'readonly',
            ),
            'options' => array(
                'label' => 'País'
            ),
        ));
    }

    public function getInputFilterSpecification() {
        return array(
            'addressId' => array(
                'required' => false,
            ),
            'addressPostalCode' => array(
                'required' => false,
                'filters' => array(
                    array('name' => 'Digits')
                )
            ),
        );
    }
}
