<?php

namespace Department\Form\Fieldset;

use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset as ZendFielset;
use Department\Entity\Department as DepartmentEntity;

class Department extends ZendFielset implements InputFilterProviderInterface {

    public function __construct() {
        parent::__construct('department');
        
        $this->setHydrator(new DoctrineHydrator($entityManager))
                ->setObject(new DepartmentEntity());

        $this->add(array(
            'name' => 'company',
            'type' => 'Zend\Form\Element\Hidden',
        ));
       
        $this->add(array(
            'name' => 'departmentId',
            'type' => 'Zend\Form\Element\Hidden',
        ));
        
        $this->add(array(
            'name' => 'departmentName',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder'   => 'Departamento',
                'class'         => 'form-control input-sm',
                'required'      => 'required',
            ),
            'options' => array(
                'label' => 'Departamento'
            )
        ));
    }

    public function getInputFilterSpecification() {
        return array(
            'departmentName' => array(
                'required' => true,
            ),
        );
    }
}
