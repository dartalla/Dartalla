<?php

namespace Financial\Form\Fieldset;

use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset as ZendFielset;
use Financial\Entity\Account as AccountEntity;

class Account extends ZendFielset implements InputFilterProviderInterface {

    public function __construct($entityManager, $companyId, $true = 1) {
        parent::__construct('account');

        $this->setHydrator(new DoctrineHydrator($entityManager))
                ->setObject(new AccountEntity());

        $this->add(array(
            'name' => 'accountId',
            'type' => 'Zend\Form\Element\Hidden',
        ));

        $this->add(array(
            'name' => 'accountAutoId',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'class' => 'form-control input-sm',
                'readonly' => 'readonly'
            ),
            'options' => array(
                'label' => 'Código'
            )
        ));

        $this->add(array(
            'name' => 'accountDescription',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'class' => 'form-control input-sm',
            ),
            'options' => array(
                'label' => 'Descrição',
            ),
        ));

        $this->add(array(
            'name' => 'accountNumber',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'class' => 'form-control input-sm',
            ),
            'options' => array(
                'label' => 'Número'
            ),
        ));

        $this->add(array(
            'name' => 'accountEmissionDate',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'class' => 'form-control input-sm datepicker',
            ),
            'options' => array(
                'label' => 'Dt. de Emissão'
            ),
        ));

        $this->add(array(
            'name' => 'accountExpirationDate',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'class' => 'form-control input-sm datepicker',
                'id' => 'firstExpiration',
                'onblur' => 'javascript: $("#accountParcelExpiration").val(this.value);'
            ),
            'options' => array(
                'label' => 'Dt. de Vencimento'
            ),
        ));

        $this->add(array(
            'name' => 'accountCompetencyDate',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'class' => 'form-control input-sm datepicker',
            ),
            'options' => array(
                'label' => 'Dt. de Competência'
            ),
        ));

        $this->add(array(
            'name' => 'accountValue',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'class' => 'form-control input-sm currency',
                'id' => 'accountValue',
                'onblur' => 'javascript: $("#accountParcelValue").val(this.value);'
            ),
            'options' => array(
                'label' => 'Valor'
            ),
        ));

        $this->add(array(
            'name' => 'accountParcels',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'class' => 'form-control input-sm',
                'maxlength' => 2,
                'id' => 'parcelValue',
            ),
            'options' => array(
                'label' => 'Qtd. de Parcelas'
            ),
        ));

        $this->add(array(
            'name' => 'accountCarrier',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'class' => 'form-control input-sm',
            ),
            'options' => array(
                'label' => 'Portador'
            ),
        ));

        $this->add(array(
            'name' => 'accountBarcode',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'class' => 'form-control input-sm',
            ),
            'options' => array(
                'label' => 'Código de Barras'
            ),
        ));

        $this->add(array(
            'name' => 'accountAutoLaunch',
            'type' => 'Zend\Form\Element\Select',
            'options' => array(
                'value_options' => array(
                    0 => 'MANUAL',
                    1 => 'AUTOMÁTICO',
                ),
                'label' => 'Tipo de Lançamento'
            ),
            'attributes' => array(
                'class' => 'form-control input-sm'
            )
        ));

        $this->add(array(
            'name' => 'accountFine',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'class' => 'form-control input-sm porcent'
            ),
            'options' => array(
                'value' => '0',
                'label' => 'Multa'
            )
        ));

        $this->add(array(
            'name' => 'accountInterest',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'class' => 'form-control input-sm porcent'
            ),
            'options' => array(
                'label' => 'Juros'
            ),
        ));

        $this->add(array(
            'name' => 'accountInterestInterval',
            'type' => 'Zend\Form\Element\Select',
            'attributes' => array(
                'class' => 'form-control input-sm',
            ),
            'options' => array(
                'value_options' => array(
                    1 => 'DIARIAMENTE',
                    30 => 'MENSALMENTE',
                ),
                'label' => 'Interv. dos Juros'
            ),
        ));

        $this->add(array(
            'name' => 'accountNotes',
            'type' => 'Zend\Form\Element\Textarea',
            'attributes' => array(
                'class' => 'form-control input-sm',
                'rows' => 4,
            ),
            'options' => array(
                'label' => 'Observações'
            ),
        ));

        $this->add(array(
            'name' => 'currentAccountId',
            'type' => 'DoctrineORMModule\Form\Element\EntitySelect',
            'options' => array(
                'label' => 'Conta',
                'empty_option' => 'Selecione',
                'object_manager' => $entityManager,
                'target_class' => 'CurrentAccount\Entity\CurrentAccount',
                'property' => 'currentAccountName',
                'is_method' => true,
                'find_method' => array(
                    'name' => 'findBy',
                    'params' => array(
                        'criteria' => array(
                            'companyId' => $companyId,
                        ),
                        'orderBy' => array('currentAccountName' => 'ASC'),
                    ),
                ),
            ),
            'attributes' => array(
                'class' => 'form-control input-sm',
            )
        ));

        $this->add(array(
            'name' => 'paymentTypeId',
            'type' => 'DoctrineORMModule\Form\Element\EntitySelect',
            'options' => array(
                'label' => 'Forma de Pagamento',
                'empty_option' => 'Selecione',
                'object_manager' => $entityManager,
                'target_class' => 'PaymentType\Entity\PaymentType',
                'property' => 'paymentTypeName',
                'is_method' => true,
                'find_method' => array(
                    'name' => 'findBy',
                    'params' => array(
                        'criteria' => array(),
                        'orderBy' => array('paymentTypeName' => 'ASC')
                    )
                )
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
            'name' => 'documentTypeId',
            'type' => 'DoctrineORMModule\Form\Element\EntitySelect',
            'options' => array(
                'label' => 'Tipo de Documento',
                'empty_option' => 'Selecione',
                'object_manager' => $entityManager,
                'target_class' => 'DocumentType\Entity\DocumentType',
                'property' => 'documentTypeName',
                'is_method' => true,
                'find_method' => array(
                    'name' => 'findBy',
                    'params' => array(
                        'criteria' => array(),
                        'orderBy' => array(
                            'documentTypeName' => 'ASC'
                        )
                    )
                )
            ),
            'attributes' => array(
                'class' => 'form-control input-sm',
            )
        ));

        $this->add(array(
            'name' => 'accountingItemId',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Ítem Contábil',
                'empty_option' => 'Selecione',
                'object_manager' => $entityManager,
                'target_class' => 'AccountingItem\Entity\AccountingItem',
                'property' => 'accountingItemName',
                'is_method' => false,
                'find_method' => array(
                    'name' => 'findBy',
                    'params' => array(
                        'criteria' => array(
                            'accountingItemType' => $true,
                            'companyId' => $companyId,
                        ),
                        'orderBy' => array('accountingItemType' => 'ASC', 'accountingItemName' => 'ASC')
                    )
                )
            ),
            'attributes' => array(
                'class' => 'form-control input-sm',
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Collection',
            'name' => 'parcels',
            'options' => array(
                'count' => 1,
                'should_create_template' => true,
                'allow_add' => true,
                'allow_remove' => true,
                'target_element' => new \Financial\Form\Fieldset\AccountParcel($entityManager),
            )
        ));
    }

    public function getInputFilterSpecification() {
        return array(
            'accountValue' => array(
                'required' => true,
                'filters' => array(
                    new \Zend\I18n\Filter\NumberFormat()
                ),
            ),
            'accountFine' => array(
                'required' => false,
                'filters' => array(
                    new \Avr\Filter\Porcent()
                ),
            ),
            'accountInterest' => array(
                'required' => false,
                'filters' => array(
                    new \Avr\Filter\Porcent()
                ),
            ),
            'accountEmissionDate' => array(
                'required' => false,
                'filters' => array(
                    new \Avr\Filter\Date()
                ),
            ),
            'accountExpirationDate' => array(
                'required' => true,
                'filters' => array(
                    new \Avr\Filter\Date()
                ),
            ),
            'accountCompetencyDate' => array(
                'required' => false,
                'filters' => array(
                    new \Avr\Filter\Date()
                ),
            ),
        );
    }

}
