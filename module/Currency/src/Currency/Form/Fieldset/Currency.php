<?php

namespace Currency\Form\Fieldset;

use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset as ZendFielset;
use Currency\Entity\Currency as CurrencyEntity;

class Currency extends ZendFielset implements InputFilterProviderInterface {

    public function __construct() {
        parent::__construct('currency');
        
        $this->setHydrator(new DoctrineHydrator($entityManager))
                ->setObject(new CurrencyEntity());

        $this->add(array(
            'name' => 'currencyId',
            'type' => 'Zend\Form\Element\Hidden',
        ));
        
        $this->add(array(
            'name' => 'currencyName',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder'   => 'Moeda',
                'class'         => 'form-control input-sm',
                'required'      => 'required',
            ),
            'options' => array(
                'label' => 'Nome da Moeda'
            ),
        ));
    }

    public function getInputFilterSpecification() {
        return array(
            'currencyName' => array(
                'required' => true,
            ),
        );
    }
}
