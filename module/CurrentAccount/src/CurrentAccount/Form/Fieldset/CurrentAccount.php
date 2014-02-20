<?php

namespace CurrentAccount\Form\Fieldset;

use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset as ZendFielset;
use CurrentAccount\Entity\CurrentAccount as CurrentAccountEntity;

class CurrentAccount extends ZendFielset implements InputFilterProviderInterface {

    public function __construct($entityManager) {
        parent::__construct('currentAccount');

        $hydrator = new DoctrineHydrator($entityManager);

        $this->setHydrator($hydrator)
                ->setObject(new CurrentAccountEntity());

        $this->add(array(
            'name' => 'currentAccountId',
            'type' => 'Zend\Form\Element\Hidden',
        ));

        $this->add(array(
            'name' => 'bankId',
            'type' => 'DoctrineORMModule\Form\Element\EntitySelect',
            'options' => array(
                'label' => 'Banco',
                'object_manager' => $entityManager,
                'target_class' => 'Bank\Entity\Bank',
                'property' => 'bankName',
                'empty_option' => 'Banco',
                'is_method' => false,
                'find_method' => array(
                    'name' => 'findBy',
                    'params' => array(
                        'criteria' => array(),
                        'orderBy' => array('bankName' => 'ASC')
                    )
                )
            ),
            'attributes' => array(
                'class' => 'form-control input-sm',
                'required' => 'required',
            )
        ));
        
        $this->add(array(
            'name' => 'currentAccountName',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder' => 'Nome da Conta',
                'class' => 'form-control input-sm',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Nome da Conta'
            ),
        ));

        $this->add(array(
            'name' => 'currentAccountAgency',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder' => 'Agência',
                'class' => 'form-control input-sm',
            ),
            'options' => array(
                'label' => 'Agência'
            ),
        ));

        $this->add(array(
            'name' => 'currentAccountAgencyVd',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder' => 'Dig.',
                'class' => 'form-control input-sm',
                'maxlength' => 1
            ),
            'options' => array(
                'label' => 'DV'
            ),
        ));

        $this->add(array(
            'name' => 'currentAccountAccount',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder' => 'Nº da Conta',
                'class' => 'form-control input-sm',
            ),
            'options' => array(
                'label' => 'Nº da Conta'
            ),
        ));

        $this->add(array(
            'name' => 'currentAccountAccountVd',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder' => 'Dig.',
                'class' => 'form-control input-sm',
                'maxlength' => 1
            ),
            'options' => array(
                'label' => 'DV'
            ),
        ));

        $this->add(array(
            'name' => 'currentAccountManager',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder' => 'Nome do Gerente',
                'class' => 'form-control input-sm',
            ),
            'options' => array(
                'label' => 'Gerente'
            ),
        ));

        $this->add(array(
            'name' => 'currentAccountManagerPhone',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder' => 'Tel. do Gerente',
                'class' => 'form-control input-sm phone',
            ),
            'options' => array(
                'label' => 'Telefone'
            ),
        ));

        $this->add(array(
            'name' => 'currentAccountManagerEmail',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder' => 'Email do Gerente',
                'class' => 'form-control input-sm',
            ),
            'options' => array(
                'label' => 'E-mail'
            ),
        ));

        $this->add(array(
            'name' => 'currentAccountBankHomePage',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder' => 'Site do Banco',
                'class' => 'form-control input-sm',
            ),
            'options' => array(
                'label' => 'Website'
            ),
        ));

        $this->add(array(
            'name' => 'currentAccountCreditLimit',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder' => 'Limite',
                'class' => 'form-control input-sm currency',
            ),
            'options' => array(
                'label' => 'Limite de Crédito'
            ),
        ));

        $this->add(array(
            'name' => 'currentAccountCreditExpiration',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder' => 'Venc. Limite',
                'class' => 'form-control input-sm datepicker',
            ),
            'options' => array(
                'label' => 'Data de Venc.'
            ),
        ));

        $this->add(array(
            'name' => 'currentAccountOpenDate',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder' => 'Aberta Em',
                'class' => 'form-control input-sm datepicker',
            ),
            'options' => array(
                'label' => 'Aberta em'
            ),
        ));

        $this->add(array(
            'name' => 'currentAccountOpenBalance',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder' => 'Saldo Inicial',
                'class' => 'form-control input-sm currency',
            ),
            'options' => array(
                'label' => 'Saldo Inicial'
            ),
        ));

        $this->add(array(
            'name' => 'currencyId',
            'type' => 'DoctrineORMModule\Form\Element\EntitySelect',
            'options' => array(
                'label' => 'Moeda',
                'object_manager' => $entityManager,
                'target_class' => 'Currency\Entity\Currency',
                'property' => 'currencyName',
                'empty_option' => 'Moeda',
                'is_method' => true,
                'find_method' => array(
                    'name' => 'findBy',
                    'params' => array(
                        'criteria' => array(),
                        'orderBy' => array('currencyName' => 'ASC')
                    )
                )
            ),
            'attributes' => array(
                'class' => 'form-control input-sm',
            )
        ));

        $this->add(array(
            'name' => 'currentAccountDescription',
            'type' => 'Zend\Form\Element\Textarea',
            'attributes' => array(
                'placeholder' => 'Descrição',
                'class' => 'form-control input-sm',
            ),
            'options' => array(
                'label' => 'Descrição'
            ),
        ));

        $this->add(array(
            'name' => 'companyId',
            'type' => 'Zend\Form\Element\Hidden',
        ));

        $this->add(new CreditCard($entityManager));
    }

    public function getInputFilterSpecification() {
        return array(
            'bankId' => array(
                'required' => true,
            ),
            'currentAccountName' => array(
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                )
            ),
            'currentAccountAgency' => array(
                'required' => false,
                'filters' => array(
                    array('name' => 'StringTrim'),
                    array('name' => 'StripTags'),
                    array('name' => 'Alnum'),
                )
            ),
            'currentAccountAgencyVd' => array(
                'required' => false,
                'filters' => array(
                    array('name' => 'StringTrim'),
                    array('name' => 'StripTags'),
                    array('name' => 'Alnum'),
                )
            ),
            'currentAccountAccount' => array(
                'required' => false,
                'filters' => array(
                    array('name' => 'StringTrim'),
                    array('name' => 'StripTags'),
                    array('name' => 'Alnum'),
                )
            ),
            'currentAccountAccountVd' => array(
                'required' => false,
                'filters' => array(
                    array('name' => 'StringTrim'),
                    array('name' => 'StripTags'),
                    array('name' => 'Alnum'),
                )
            ),
            'currentAccountManager' => array(
                'required' => false,
                'filters' => array(
                    array('name' => 'StringTrim'),
                    array('name' => 'StripTags'),
                    array('name' => 'Alnum'),
                )
            ),
            'currentAccountManagerPhone' => array(
                'required' => false,
                'filters' => array(
                    array('name' => 'StringTrim'),
                    array('name' => 'StripTags'),
                    array('name' => 'Digits'),
                )
            ),
            'currentAccountManagerEmail' => array(
                'required' => false,
                'filters' => array(
                    array('name' => 'StringTrim'),
                    array('name' => 'StripTags'),
                ),
                'validators' => array(
                    array('name' => 'EmailAddress')
                )
            ),
            'currentAccountBankHomePage' => array(
                'required' => false,
                'filters' => array(
                    array('name' => 'StringTrim'),
                    array('name' => 'StripTags'),
                ),
            ),
            'currentAccountCreditLimit' => array(
                'required' => false,
                'filters' => array(
                    array('name' => 'StringTrim'),
                    array('name' => 'StripTags'),
                    new \Zend\I18n\Filter\NumberFormat()
                ),
            ),
            'currentAccountCreditExpiration' => array(
                'required' => false,
                'filters' => array(
                    array('name' => 'StringTrim'),
                    array('name' => 'StripTags'),
                    new \Avr\Filter\Date()
                ),
            ),
            'currentAccountOpenDate' => array(
                'required' => false,
                'filters' => array(
                    array('name' => 'StringTrim'),
                    array('name' => 'StripTags'),
                    new \Avr\Filter\Date()
                ),
            ),
            'currentAccountOpenBalance' => array(
                'required' => false,
                'filters' => array(
                    array('name' => 'StringTrim'),
                    array('name' => 'StripTags'),
                    new \Zend\I18n\Filter\NumberFormat()
                ),
            ),
        );
    }

}
