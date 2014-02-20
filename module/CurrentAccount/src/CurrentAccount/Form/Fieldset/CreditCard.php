<?php

namespace CurrentAccount\Form\Fieldset;

use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset as ZendFielset;
use CurrentAccount\Entity\CreditCard as CreditCardEntity;

class CreditCard extends ZendFielset implements InputFilterProviderInterface {

    private $brands = array(
        'americanexpress' => 'AMERICAN EXPRESS',
        'dinersclub' => 'DINERS CLUB',
        'greencard' => 'GREENCARD',
        'maestro' => 'MAESTRO',
        'mastercard' => 'MASTERCARD',
        'redeshop' => 'REDE SHOP',
        'visa' => 'VISA',
        'visaelectron' => 'VISA ELECTRON',
    );

    public function __construct($entityManager) {
        parent::__construct('creditCard');

        

        $hydrator = new DoctrineHydrator($entityManager);

        $this->setHydrator($hydrator)
                ->setObject(new CreditCardEntity());

        $this->add(array(
            'name' => 'creditCardId',
            'type' => 'Zend\Form\Element\Hidden',
        ));

        $this->add(array(
            'name' => 'creditCardNumber',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder' => 'Número do Cartão',
                'class' => 'form-control input-sm creditcard',
            ),
            'options' => array(
                'label' => 'Número do Cartão'
            )
        ));

        $this->add(array(
            'name' => 'creditCardBrand',
            'type' => 'Zend\Form\Element\Select',
            'attributes' => array(
                'placeholder' => 'Bandeira',
                'class' => 'form-control input-sm',
            ),
            'options' => array(
                'empty_option' => '',
                'value_options' => $this->brands,
                'label' => 'Bandeira'
            ),
        ));

        $this->add(array(
            'name' => 'creditCardClosing',
            'type' => 'Zend\Form\Element\Select',
            'attributes' => array(
                'placeholder' => 'Fechamento',
                'class' => 'form-control input-sm',
            ),
            'options' => array(
                'empty_option' => '',
                'value_options' => range(1, 28),
                'label' => 'Fechamento'
            )
        ));

        $this->add(array(
            'name' => 'creditCardExpiration',
            'type' => 'Zend\Form\Element\Select',
            'attributes' => array(
                'placeholder' => 'Vencimento',
                'class' => 'form-control input-sm',
            ),
            'options' => array(
                'empty_option' => '',
                'value_options' => range(1, 28),
                'label' => 'Vencimento'
            )
        ));

        $this->add(array(
            'name' => 'creditCardValidity',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'class' => 'form-control input-sm validity',
            ),
            'options' => array(
                'label' => 'Dt. de Validade'
            )
        ));
    }

    public function getInputFilterSpecification() {
        return array(
            'creditCardNumber' => array(
                'required' => false,
                'filters' => array(
                    array('name' => 'StringTrim'),
                    array('name' => 'StripTags'),
                    array('name' => 'Digits'),
                ),
                'validators' => array(
                    array('name' => 'CreditCard')
                )
            ),
            'creditCardValidity' => array(
                'required' => false,
                'filters' => array(
                    array('name' => 'StringTrim'),
                    array('name' => 'StripTags'),
                    array('name' => 'Digits'),
                ),
            ),
            'creditCardBrand' => array(
                'required' => false,
            ),
            'creditCardClosing' => array(
                'required' => false,
            ),
            'creditCardExpiration' => array(
                'required' => false,
            ),
        );
    }

}
