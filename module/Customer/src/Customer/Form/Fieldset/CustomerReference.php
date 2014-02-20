<?php

namespace Customer\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset as ZendFielset;

class CustomerReference extends ZendFielset implements InputFilterProviderInterface {

    public function __construct($entityManager, $id) {
        parent::__construct('customerReference');
        
        $this->add(array(
            'name' => 'customerId',
            'type' => 'DoctrineORMModule\Form\Element\EntitySelect',
            'options' => array(
                'object_manager' => $entityManager,
                'target_class' => 'Customer\Entity\Customer',
                'property' => 'customerName',
                'is_method' => true,
                'find_method' => array(
                    'name' => 'findBy',
                    'params' => array(
                        'criteria'=> array('customerId' => $id),
                    )
                ),
                'label' => 'Cliente'
            ),
            'attributes' => array(
                'id' => 'customer_id',
                'class' => 'form-control input-sm',
            )
        ));
        
        $reference = new \Reference\Form\Fieldset\Reference($entityManager);
        $reference->setName('reference')
                ->setLabel('Referência');
        $this->add($reference);
    }

    public function getInputFilterSpecification() {
        return array();
    }

}
