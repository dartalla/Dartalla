<?php

namespace Reference\Form\Fieldset;

use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset as ZendFielset;
use Reference\Entity\Reference as ReferenceEntity;

class Reference extends ZendFielset implements InputFilterProviderInterface {

    public function __construct($entityManager) {
        
        parent::__construct('reference');

        $this->setHydrator(new DoctrineHydrator($entityManager))
                ->setObject(new ReferenceEntity());

        $this->add(array(
            'name' => 'referenceId',
            'type' => 'Zend\Form\Element\Hidden',
        ));

        $this->add(array(
            'name' => 'referenceType',
            'type' => 'Zend\Form\Element\Select',
            'attributes' => array(
                'id' => 'reference_type',
                'placeholder' => 'Tipo',
                'class' => 'form-control input-sm',
            ),
            'options' => array(
                'label' => 'Tipo',
                'empty_option' => 'Tipo',
                'value_options' => array(
                    'COMERCIAL' => 'COMERCIAL',
                    'CONTADOR' => 'CONTADOR',
                    'EXECUTIVA' => 'EXECUTIVA',
                    'PESSOAL' => 'PESSOAL',
                )
            ),
        ));

        $this->add(array(
            'name' => 'referenceName',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'reference_name',
                'placeholder' => 'Referência',
                'class' => 'form-control input-sm',
            ),
            'options' => array(
                'label' => 'Referência'
            ),
        ));

        $this->add(array(
            'name' => 'referencePhone',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'reference_phone',
                'placeholder' => 'Telefone',
                'class' => 'form-control input-sm phone',
            ),
            'options' => array(
                'label' => 'Telefone'
            ),
        ));
    }

    public function getInputFilterSpecification() {
        return array();
    }

}
