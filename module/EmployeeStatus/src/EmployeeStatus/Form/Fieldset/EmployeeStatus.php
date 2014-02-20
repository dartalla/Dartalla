<?php

namespace EmployeeStatus\Form\Fieldset;

use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset as ZendFielset;
use EmployeeStatus\Entity\EmployeeStatus as EmployeeStatusEntity;

class EmployeeStatus extends ZendFielset implements InputFilterProviderInterface {

    public function __construct($entityManager) {
        
        parent::__construct('employeeStatus');
        
        $this->setHydrator(new DoctrineHydrator($entityManager))
                ->setObject(new EmployeeStatusEntity());

        $this->add(array(
            'name' => 'employeeStatusId',
            'type' => 'Zend\Form\Element\Hidden',
        ));
        
        $this->add(array(
            'name' => 'employeeStatusName',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder'   => 'Situação do Funcionário',
                'class'         => 'form-control input-sm',
                'required'      => 'required',
            ),
            'options' => array(
                'label' => 'Situação do Funcionário'
            )
        ));
    }

    public function getInputFilterSpecification() {
        return array(
            'employeeStatusName' => array(
                'required' => true,
            ),
        );
    }
}
