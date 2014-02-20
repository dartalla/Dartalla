<?php

namespace Financial\Form\Fieldset;

use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset as ZendFielset;
use Financial\Entity\Payable as PayableEntity;

class Payable extends ZendFielset implements InputFilterProviderInterface {

    public function __construct($entityManager, $companyId) {
        parent::__construct('payable');
        
        $this->setHydrator(new DoctrineHydrator($entityManager))
                ->setObject(new PayableEntity());

        $this->add(array(
            'name' => 'payableId',
            'type' => 'Zend\Form\Element\Hidden',
        ));
        
        $this->add(array(
            'name' => 'companyId',
            'type' => 'Zend\Form\Element\Hidden',
        ));
        
        $this->add(array(
            'name' => 'supplierId',
            'type' => 'DoctrineORMModule\Form\Element\EntitySelect',
            'options' => array(
                'label' => 'Fornecedor',
                'empty_option'      => 'Selecione',
                'object_manager'    => $entityManager,
                'target_class'      => 'Supplier\Entity\Supplier',
                'property'          => 'supplierName',
                'is_method'         => true,
                'find_method'       => array(
                    'name'  => 'supplierList',
                    'params' => array(
                        'companyId' => $companyId
                    )
                ),
            ),
            'attributes' => array(
                'class'     => 'form-control input-sm col-md-4',
            )
        ));
        
        $account = new Account($entityManager, $companyId, 0);
        $this->add($account);
    }

    public function getInputFilterSpecification() {
        return array(
            'customerId' => array(
                'required' => true,
            )
        );
    }
}
