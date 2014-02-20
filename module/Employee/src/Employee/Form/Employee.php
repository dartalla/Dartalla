<?php

namespace Employee\Form;

use Employee\Entity\Employee as EmployeeEntity;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\InputFilter\InputFilter;
use Zend\Form\Form;

class Employee extends Form {

    public function __construct($entityManager) {

        parent::__construct('employee_form');

        $this->setAttribute('method', 'post')
                ->setHydrator(new DoctrineHydrator($entityManager, true))
                ->setObject(new EmployeeEntity())
                ->setInputFilter(new InputFilter());

        $employee = new Fieldset\Employee($entityManager);
        $employee->setUseAsBaseFieldset(true);
        $this->add($employee);

        $this->add(array(
            'type' => 'Zend\Form\Element\Csrf',
            'name' => 'security'
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Submit',
            'name' => 'submit',
            'attributes' => array(
                'value' => 'Salvar',
                'class' => 'btn btn-primary'
            )
        ));

        $this->add(array(
            'name' => 'cancel',
            'attributes' => array(
                'type' => 'button',
                'value' => 'Cancel',
                'class' => 'btn btn-default',
                'onclick' => "javascript: window.location.href = '/admin/employee'",
            )
        ));
    }
}
