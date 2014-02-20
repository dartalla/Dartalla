<?php

namespace Financial\Form\Fieldset;

use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset as ZendFielset;
use Financial\Entity\AccountParcel as AccountParcelEntity;

class AccountParcel extends ZendFielset implements InputFilterProviderInterface {

    public function __construct($entityManager) {
        parent::__construct('accountParcel');

        $this->setHydrator(new DoctrineHydrator($entityManager))
                ->setObject(new AccountParcelEntity());

        $this->setLabel('Parcela');
        $this->setLabelAttributes(array(
            'class' => 'controls',
        ));
        
        $this->add(array(
            'name' => 'accountParcelId',
            'type' => 'Zend\Form\Element\Hidden',
        ));
        
        $this->add(array(
            'name' => 'accountParcelExpiration',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder' => 'Data de Vencimento',
                'class' => 'form-control input-sm',
                'readonly' => 'readonly',
                'id' => 'accountParcelExpiration',
            ),
            'options' => array(
                'label' => 'Dt. de Vencimento'
            )
        ));
        
        $this->add(array(
            'name' => 'accountParcelValue',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder' => 'Val. da Parcela',
                'class' => 'form-control input-sm currency',
                'readonly' => 'readonly',
                'id' => 'accountParcelValue',
                'value' => 0.00,
            ),
            'options' => array(
                'label' => 'Val. da Parcela'
            ),
        ));
    }

    public function getInputFilterSpecification() {
        return array(
            'accountParcelValue' => array(
                'required' => false,
                'filters' => array(
                    new \Zend\I18n\Filter\NumberFormat()
                )
            ),
            'accountParcelExpiration' => array(
                'required' => false,
                'filters' => array(
                    new \Avr\Filter\Date()
                )
            ),
        );
    }
}
