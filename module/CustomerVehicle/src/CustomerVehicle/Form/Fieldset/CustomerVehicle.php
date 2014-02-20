<?php

namespace CustomerVehicle\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset as ZendFielset;

class CustomerVehicle extends ZendFielset implements InputFilterProviderInterface {

    public function __construct($entityManager, $id) {
        parent::__construct('customerVehicle');
        
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
        
        $vehicle = new \Vehicle\Form\Fieldset\ShortVehicle($entityManager);
        $vehicle->setName('vehicle')
                ->setLabel('Veículo');
        $this->add($vehicle);
    }

    public function getInputFilterSpecification() {
        return array();
    }

}
