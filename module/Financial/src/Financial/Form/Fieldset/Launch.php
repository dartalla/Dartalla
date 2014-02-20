<?php

namespace Financial\Form\Fieldset;

use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset as ZendFielset;
use Financial\Entity\Launch as LaunchEntity;

class Launch extends ZendFielset implements InputFilterProviderInterface {

    public function __construct($entityManager, $companyId, $true = 1) {
        parent::__construct('launch');

        $this->setHydrator(new DoctrineHydrator($entityManager))
                ->setObject(new LaunchEntity());

        $this->add(array(
            'name' => 'launchId',
            'type' => 'Zend\Form\Element\Hidden',
        ));

        $this->add(array(
            'name' => 'launchDate',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'class' => 'form-control input-sm datepicker',
            ),
            'options' => array(
                'label' => 'Data de Lançamento'
            ),
        ));

        $this->add(array(
            'name' => 'launchNumber',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'class' => 'form-control input-sm',
            ),
            'options' => array(
                'label' => 'Número',
            )
        ));

        $this->add(array(
            'name' => 'launchValue',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'class' => 'form-control input-sm currency',
            ),
            'options' => array(
                'label' => 'Valor',
            )
        ));

        $this->add(array(
            'name' => 'launchDescription',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'class' => 'form-control input-sm',
            ),
            'options' => array(
                'label' => 'Descrição',
            )
        ));

        $this->add(array(
            'name' => 'currentAccountId',
            'type' => 'DoctrineORMModule\Form\Element\EntitySelect',
            'options' => array(
                'label' => 'Conta Corrente',
                'empty_option' => 'Selecione',
                'object_manager' => $entityManager,
                'target_class' => 'CurrentAccount\Entity\CurrentAccount',
                'property' => 'currentAccountName',
                'is_method' => true,
                'find_method' => array(
                    'name' => 'findBy',
                    'params' => array(
                        'criteria' => array('companyId' => $companyId),
                        'orderBy' => array('currentAccountName' => 'ASC'),
                    ),
                ),
            ),
            'attributes' => array(
                'class' => 'form-control input-sm',
            )
        ));

        $this->add(array(
            'name' => 'departmentId',
            'type' => 'DoctrineORMModule\Form\Element\EntitySelect',
            'options' => array(
                'label' => 'Departamento',
                'empty_option' => 'Selecione',
                'object_manager' => $entityManager,
                'target_class' => 'Department\Entity\Department',
                'property' => 'departmentName',
                'is_method' => true,
                'find_method' => array(
                    'name' => 'findBy',
                    'params' => array(
                        'criteria' => array('company' => $companyId),
                        'orderBy' => array('departmentName' => 'ASC')
                    )
                )
            ),
            'attributes' => array(
                'class' => 'form-control input-sm',
            )
        ));

        $this->add(array(
            'name' => 'accountingItemId',
            'type' => 'DoctrineORMModule\Form\Element\EntitySelect',
            'options' => array(
                'label' => 'Ítem Contábil',
                'empty_option' => 'Selecione',
                'object_manager' => $entityManager,
                'target_class' => 'AccountingItem\Entity\AccountingItem',
                'property' => 'accountingItemName',
                'is_method' => true,
                'find_method' => array(
                    'name' => 'findBy',
                    'params' => array(
                        'criteria' => array(
                            'companyId' => $companyId,
                            'accountingItemType' => $true,
                        ),
                    ),
                ),
            ),
            'attributes' => array(
                'class' => 'form-control input-sm',
                'required' => 'required',
            )
        ));
    }

    public function getInputFilterSpecification() {
        return array(
            'launchValue' => array(
                'required' => true,
                'filters' => array(
                    new \Zend\I18n\Filter\NumberFormat()
                ),
            ),
            'launchDate' => array(
                'required' => false,
                'filters' => array(
                    new \Avr\Filter\Date()
                ),
            ),
            'currentAccountId' => array(
                'required' => true,
            ),
            'accountingItemId' => array(
                'required' => true,
            ),
        );
    }

}
