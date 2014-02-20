<?php

namespace Office\Form\Fieldset;

use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset as ZendFielset;
use Office\Entity\Office as OfficeEntity;

class Office extends ZendFielset implements InputFilterProviderInterface {

    public function __construct() {
        parent::__construct('office');
        
        $this->setHydrator(new DoctrineHydrator($entityManager))
                ->setObject(new OfficeEntity());

        $this->add(array(
            'name' => 'officeId',
            'type' => 'Zend\Form\Element\Hidden',
        ));
        
        $this->add(array(
            'name' => 'officeName',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder'   => 'Cargo',
                'class'         => 'form-control input-sm',
                'required'      => 'required',
            ),
            'options' => array(
                'label' => 'Cargo'
            )
        ));
    }

    public function getInputFilterSpecification() {
        return array(
            'officeName' => array(
                'required' => true,
            ),
        );
    }
}
