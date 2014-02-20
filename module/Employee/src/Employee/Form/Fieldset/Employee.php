<?php

namespace Employee\Form\Fieldset;

use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset as ZendFielset;
use Employee\Entity\Employee as EmployeeEntity;

class Employee extends ZendFielset implements InputFilterProviderInterface {

    public function __construct($entityManager) {
        parent::__construct('employee');

        $this->setHydrator(new DoctrineHydrator($entityManager, true))
                ->setObject(new EmployeeEntity());

        $this->add(array(
            'name' => 'employeeId',
            'type' => 'Zend\Form\Element\Hidden',
        ));
        
        $this->add(array(
            'name' => 'employeeWorkTime',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder' => 'Carga Horária',
                'class' => 'form-control input-sm',
            ),
            'options' => array(
                'label' => 'Carga Horária'
            ),
        ));
        
        $this->add(array(
            'name' => 'employeeCtps',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder' => 'CTPS',
                'class' => 'form-control input-sm',
            ),
            'options' => array(
                'label' => 'CTPS'
            ),
        ));

        $this->add(array(
            'name' => 'employeeCtpsSerie',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder' => 'Série',
                'class' => 'form-control input-sm',
            ),
            'options' => array(
                'label' => 'Série'
            ),
        ));

        $this->add(array(
            'name' => 'employeePis',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder' => 'PIS',
                'class' => 'form-control input-sm',
            ),
            'options' => array(
                'label' => 'PIS'
            ),
        ));
        
        $this->add(array(
            'name' => 'employeeSalary',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder' => 'Salário',
                'class' => 'form-control input-sm currency',
            ),
            'options' => array(
                'label' => 'Salário'
            ),
        ));
        
        $this->add(array(
            'name' => 'employeeBonus',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder' => 'Bônus',
                'class' => 'form-control input-sm currency',
            ),
            'options' => array(
                'label' => 'Bônus'
            ),
        ));
        
        $this->add(array(
            'name' => 'employeeCommission',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder' => 'Comissão',
                'class' => 'form-control input-sm porcent',
            ),
            'options' => array(
                'label' => 'Comissão'
            ),
        ));
        
        $this->add(array(
            'name' => 'employeePicture',
            'type' => 'Zend\Form\Element\File',
            'attributes' => array(
                'placeholder' => 'Foto',
            ),
            'options' => array(
                'label' => 'Foto'
            ),
        ));
        
        $this->add(array(
            'name' => 'employeeStatusId',
            'type' => 'DoctrineORMModule\Form\Element\EntitySelect',
            'options' => array(
                'empty_option' => 'Selecione',
                'object_manager' => $entityManager,
                'target_class' => 'EmployeeStatus\Entity\EmployeeStatus',
                'property' => 'employeeStatusName',
                'is_method' => true,
                'find_method' => array(
                    'name' => 'findBy',
                    'params' => array(
                        'criteria'=> array(),
                        'orderBy' => array('employeeStatusName' => 'ASC')
                    )
                ),
                'label' => 'Situação do Funcionário'
            ),
            'attributes' => array(
                'class' => 'form-control input-sm',
            )
        ));
        
        $this->add(array(
            'name' => 'officeId',
            'type' => 'DoctrineORMModule\Form\Element\EntitySelect',
            'options' => array(
                'empty_option' => 'Selecione',
                'object_manager' => $entityManager,
                'target_class' => 'Office\Entity\Office',
                'property' => 'officeName',
                'is_method' => true,
                'find_method' => array(
                    'name' => 'findBy',
                    'params' => array(
                        'criteria'=> array(),
                        'orderBy' => array('officeName' => 'ASC')
                    )
                ),
                'label' => 'Cargo'
            ),
            'attributes' => array(
                'class' => 'form-control input-sm',
            )
        ));
        
        $person = new \Person\Form\Fieldset\Person($entityManager);
        $person->setName('person')
                ->setLabel('Dados Pessoais');
        $this->add($person);
                
        $this->add(array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'companyId',
        ));
    }
    
    public function getInputFilterSpecification() {
        return array(
            'employeeAdmissionDate' => array(
                'required' => false,
            ),
        );
    }
}
