<?php

namespace Business\Form\Fieldset;

use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset as ZendFielset;
use Business\Entity\ServiceOrder as ServiceOrderEntity;

class ServiceOrder extends ZendFielset implements InputFilterProviderInterface {

    public function __construct($entityManager, $companyId) {
        parent::__construct('service-order');
        
        $classMethod = new \Zend\Stdlib\Hydrator\ClassMethods(false);
        $classMethod->addStrategy('supplierId', new \Supplier\Strategy\Supplier());
        
        $this->setHydrator(new DoctrineHydrator($entityManager, $classMethod))
                ->setObject(new ServiceOrderEntity());

        $this->add(array(
            'name' => 'service-orderId',
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
                'empty_option'      => '',
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
                'class'     => 'span4',
            )
        ));
        
        $account = new Account($entityManager, $companyId);
        $this->add($account);
    }

    public function getInputFilterSpecification() {
        return array();
    }
}
