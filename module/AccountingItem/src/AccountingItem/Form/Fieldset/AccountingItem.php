<?php

namespace AccountingItem\Form\Fieldset;

use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset as ZendFielset;
use AccountingItem\Entity\AccountingItem as AccountingItemEntity;

class AccountingItem extends ZendFielset implements InputFilterProviderInterface {

    public function __construct($entityManager) {
        
        parent::__construct('accountingItem');
        
        $this->setHydrator(new DoctrineHydrator($entityManager))
                ->setObject(new AccountingItemEntity());

        $this->add(array(
            'name' => 'accountingItemId',
            'type' => 'Zend\Form\Element\Hidden',
        ));

        $this->add(array(
            'name' => 'companyId',
            'type' => 'Zend\Form\Element\Hidden',
        ));
        
        $this->add(array(
            'name' => 'accountingItemName',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder'   => 'Item Contábil',
                'class'         => 'form-control input-sm',
                'required'      => 'required',
            ),
            'options' => array(
                'label' => 'Ítem Contábil'
            )
        ));
        
        $this->add(array(
            'name' => 'accountingItemType',
            'type' => 'Zend\Form\Element\Radio',
            'options' => array(
                'value_options' => array(
                    '1' => 'ÍTEM DE ENTRADA',
                    '0' => 'ÍTEM DE SAÍDA'
                ),
                'label' => 'Tipo',
            ),
            'attributes' => array(
                'required' => 'required',
            )
        ));
    }

    public function getInputFilterSpecification() {
        return array(
            'accountingItemName' => array(
                'required' => true,
            ),
            'accountingItemType' => array(
                'required' => true,
            )
        );
    }

}
