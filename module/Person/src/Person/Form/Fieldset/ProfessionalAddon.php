<?php

namespace Person\Form\Fieldset;

use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset as ZendFielset;
use Person\Entity\ProfessionalAddon as ProfessionalAddonEntity;

class ProfessionalAddon extends ZendFielset implements InputFilterProviderInterface {

    public function __construct($entityManager) {
        parent::__construct('professionalAddon');
        
        $this->setHydrator(new DoctrineHydrator($entityManager))
                ->setObject(new ProfessionalAddonEntity());

        $this->add(array(
            'name' => 'professionalAddonId',
            'type' => 'Zend\Form\Element\Hidden',
        ));
        
        $this->add(array(
            'name' => 'professionalAddonPreviousCompany',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder'   => 'Empresa Anterior',
                'class'         => 'form-control input-sm',
            ),
            'options' => array(
                'label' => 'Empresa Anterior'
            ),
        ));
        
        $this->add(array(
            'name' => 'professionalAddonPreviousPhone',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder'   => 'Telefone',
                'class'         => 'form-control input-sm phone',
            ),
            'options' => array(
                'label' => 'Telefone'
            ),
        ));
        
        $this->add(array(
            'name' => 'professionalAddonPreviousAdmission',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder'   => 'Data de Admissão',
                'class'         => 'form-control input-sm datepicker',
            ),
            'options' => array(
                'label' => 'Data de Admissão'
            ),
        ));
        
        $this->add(array(
            'name' => 'professionalAddonPreviousDemission',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder'   => 'Data de Demissão',
                'class'         => 'form-control input-sm datepicker',
            ),
            'options' => array(
                'label' => 'Data de Demissão'
            ),
        ));
        
        $this->add(array(
            'name' => 'professionalAddonPreviousOffice',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder'   => 'Cargo',
                'class'         => 'form-control input-sm',
            ),
            'options' => array(
                'label' => 'Cargo'
            ),
        ));
        
        $this->add(array(
            'name' => 'professionalAddonPreviousSalary',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder'   => 'Salário',
                'class'         => 'form-control input-sm currency',
            ),
            'options' => array(
                'label' => 'Salário'
            ),
        ));
    }

    public function getInputFilterSpecification() {
        return array(
            'professionalAddonPreviousSalary' => array(
                'required' => false,
                'filters' => array(
                    new \Zend\I18n\Filter\NumberFormat()
                )
            ),
            'professionalAddonPreviousPhone' => array(
                'required' => false,
                'filters' => array(
                   new \Zend\Filter\Digits()
                )
            ),
            'professionalAddonPreviousAdmission' => array(
                'required' => false,
                'filters' => array(
                   new \Zend\Filter\DateTimeFormatter()
                )
            ),
            'professionalAddonPreviousDemission' => array(
                'required' => false,
                'filters' => array(
                   new \Zend\Filter\DateTimeFormatter()
                )
            ),
        );
    }

}
