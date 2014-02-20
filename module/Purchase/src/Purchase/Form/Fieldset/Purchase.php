<?php

namespace Purchase\Form\Fieldset;

use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset as ZendFielset;
use Purchase\Entity\Purchase as PurchaseEntity;

class Purchase extends ZendFielset implements InputFilterProviderInterface {

    public function __construct($entityManager, $companyId) {
        parent::__construct('purchase');
        
        $classMethod = new \Zend\Stdlib\Hydrator\ClassMethods(false);
        $classMethod->addStrategy('supplierId', new \Supplier\Strategy\Supplier());
        $classMethod->addStrategy('employeeId', new \Employee\Strategy\Employee());
        
        $this->setHydrator(new DoctrineHydrator($entityManager, $classMethod))
                ->setObject(new PurchaseEntity());

        $this->add(array(
            'name' => 'purchaseId',
            'type' => 'Zend\Form\Element\Hidden',
        ));
        
        $this->add(array(
            'name' => 'purchaseUid',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'class' => 'span6',
                'readonly' => 'readonly'
            ),
        ));
        
        $this->add(array(
            'name' => 'purchaseDate',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'class' => 'span6 datepicker'
            ),
        ));
        
        $this->add(array(
            'name' => 'purchaseDiscount',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'class' => 'span8 currency',
                'id' => 'purchaseDiscount',
                'onblur' => 'javascript: calculatePurchase();'
            ),
        ));
        
        $this->add(array(
            'name' => 'purchaseTotal',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'class' => 'span8 currency',
                'id' => 'purchaseTotal',
                'readonly' => 'readonly'
            ),
        ));
        
        $this->add(array(
            'name' => 'supplierId',
            'type' => 'DoctrineORMModule\Form\Element\EntitySelect',
            'options' => array(
                'empty_option' => '',
                'object_manager' => $entityManager,
                'target_class' => 'Supplier\Entity\Supplier',
                'property' => 'supplierName',
                'is_method' => true,
                'find_method' => array(
                    'name' => 'supplierList',
                    'params' => array(
                        'companyId' => $companyId,
                    ),
                ),
            ),
            'attributes' => array(
                'class' => 'span12',
            )
        ));
        
        $this->add(array(
            'name' => 'employeeId',
            'type' => 'DoctrineORMModule\Form\Element\EntitySelect',
            'options' => array(
                'empty_option' => '',
                'object_manager' => $entityManager,
                'target_class' => 'Employee\Entity\Employee',
                'property' => 'employeeName',
                'is_method' => true,
                'find_method' => array(
                    'name' => 'employeeList',
                    'params' => array(
                        'companyId' => $companyId,
                    ),
                ),
            ),
            'attributes' => array(
                'class' => 'span12',
            )
        ));
        
        $this->add(array(
            'name' => 'companyId',
            'type' => 'Zend\Form\Element\Hidden',
        ));
    }

    public function getInputFilterSpecification() {
        return array(
            'purchaseDate' => array(
                'required' => true,
                'filters' => array(
                    new \Avr\Filter\Date()
                )
            ),
            'purchaseDiscount' => array(
                'required' => true,
                'filters' => array(
                    new \Avr\Filter\Currency()
                )
            ),
            'purchaseTotal' => array(
                'required' => true,
                'filters' => array(
                    new \Avr\Filter\Currency()
                )
            ),
            'supplierId' => array(
                'required' => true,
            ),
            'employeeId' => array(
                'required' => true,
            ),
            'companyId' => array(
                'required' => true,
            ),
        );
    }
}
