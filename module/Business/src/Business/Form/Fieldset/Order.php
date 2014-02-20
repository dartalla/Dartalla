<?php

namespace Business\Form\Fieldset;

use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset as ZendFielset;
use Business\Entity\Order as OrderEntity;

class Order extends ZendFielset implements InputFilterProviderInterface {

    public function __construct($entityManager, $companyId) {
        parent::__construct('order');
        
        $classMethod = new \Zend\Stdlib\Hydrator\ClassMethods(false);
        $classMethod->addStrategy('customerId', new \Customer\Strategy\Customer());
        $classMethod->addStrategy('employeeId', new \Employee\Strategy\Employee());
        
        $this->setHydrator(new DoctrineHydrator($entityManager, $classMethod))
                ->setObject(new OrderEntity());

        $this->add(array(
            'name' => 'orderId',
            'type' => 'Zend\Form\Element\Hidden',
        ));
        
        $this->add(array(
            'name' => 'orderUid',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'class' => 'span6',
                'readonly' => 'readonly'
            ),
        ));
        
        $this->add(array(
            'name' => 'orderDate',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'class' => 'span6 datepicker'
            ),
        ));
        
        $this->add(array(
            'name' => 'orderAddition',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'class' => 'span8 currency',
                'id' => 'orderAddition',
                'onblur' => 'javascript: calculateSale();'
            ),
        ));
        
        $this->add(array(
            'name' => 'orderDiscount',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'class' => 'span8 currency',
                'id' => 'orderDiscount',
                'onblur' => 'javascript: calculateSale();'
            ),
        ));
        
        $this->add(array(
            'name' => 'orderTotal',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'class' => 'span8 currency',
                'id' => 'orderTotal',
                'readonly' => 'readonly'
            ),
        ));
        
        $this->add(array(
            'name' => 'customerId',
            'type' => 'DoctrineORMModule\Form\Element\EntitySelect',
            'options' => array(
                'empty_option' => '',
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
            'orderDate' => array(
                'required' => true,
                'filters' => array(
                    new \Avr\Filter\Date()
                )
            ),
            'orderAddition' => array(
                'required' => true,
                'filters' => array(
                    new \Avr\Filter\Currency()
                )
            ),
            'orderDiscount' => array(
                'required' => true,
                'filters' => array(
                    new \Avr\Filter\Currency()
                )
            ),
            'orderTotal' => array(
                'required' => true,
                'filters' => array(
                    new \Avr\Filter\Currency()
                )
            ),
            'customerId' => array(
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
