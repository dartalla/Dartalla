<?php

namespace Financial\Form\Fieldset;

use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset as ZendFielset;
use Financial\Entity\Revenue as RevenueEntity;

class Revenue extends ZendFielset implements InputFilterProviderInterface {

    public function __construct($entityManager, $companyId) {
        parent::__construct('revenue');

        $this->setHydrator(new DoctrineHydrator($entityManager))
                ->setObject(new RevenueEntity());

        $this->add(array(
            'name' => 'revenueId',
            'type' => 'Zend\Form\Element\Hidden',
        ));

        $this->add(array(
            'name' => 'companyId',
            'type' => 'Zend\Form\Element\Hidden',
        ));

        $this->add(array(
            'name' => 'customerId',
            'type' => 'DoctrineORMModule\Form\Element\EntitySelect',
            'options' => array(
                'label' => 'Cliente',
                'empty_option' => 'Selecione',
                'object_manager' => $entityManager,
                'target_class' => 'Customer\Entity\Customer',
                'property' => 'customerName',
                'is_method' => true,
                'find_method' => array(
                    'name' => 'customerList',
                    'params' => array(
                        'companyId' => $companyId,
                    ),
                ),
            ),
            'attributes' => array(
                'class' => 'form-control input-sm',
            )
        ));

        $launch = new Launch($entityManager, $companyId);
        $this->add($launch);
    }

    public function getInputFilterSpecification() {
        return array(
            'customerId' => array(
                'required' => true,
            )
        );
    }

}
