<?php

namespace PaymentType\Form\Fieldset;

use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset as ZendFielset;
use PaymentType\Entity\PaymentType as PaymentTypeEntity;

class PaymentType extends ZendFielset implements InputFilterProviderInterface {

    public function __construct($entityManager) {
        parent::__construct('paymentType');
        
        $this->setHydrator(new DoctrineHydrator($entityManager))
                ->setObject(new PaymentTypeEntity());

        $this->add(array(
            'name' => 'paymentTypeId',
            'type' => 'Zend\Form\Element\Hidden',
        ));
        
        $this->add(array(
            'name' => 'paymentTypeName',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder'   => 'Forma de Pagamento',
                'class'         => 'form-control input-sm',
                'required'      => 'required',
            ),
            'options' => array(
                'label' => 'Forma de Pagamento'
            )
        ));
        
        $this->add(array(
            'name' => 'companyId',
            'type' => 'Zend\Form\Element\Hidden',
        ));
    }

    public function getInputFilterSpecification() {
        return array(
            'paymentTypeName' => array(
                'required' => true
            ),
        );
    }

}
