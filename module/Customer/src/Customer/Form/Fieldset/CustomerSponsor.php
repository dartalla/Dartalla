<?php

namespace Customer\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset as ZendFielset;

class CustomerSponsor extends ZendFielset implements InputFilterProviderInterface {

    public function __construct($entityManager, $id) {
        
        parent::__construct('customerSponsor');
        
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
        
        $sponsor = new \Sponsor\Form\Fieldset\Sponsor($entityManager);
        $sponsor->setName('sponsor')
                ->setLabel('Cônjuge & Avalista');
        $this->add($sponsor);
    }

    public function getInputFilterSpecification() {
        return array();
    }

}
