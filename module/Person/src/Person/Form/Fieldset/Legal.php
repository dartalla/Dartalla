<?php

namespace Person\Form\Fieldset;

use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use Person\Entity\Legal as LegalEntity;
use Avr\Validator\Cnpj;

class Legal extends Fieldset implements InputFilterProviderInterface {

    public function __construct($entityManager) {
        
        parent::__construct('legal');

        $this->setHydrator(new DoctrineHydrator($entityManager))
                ->setObject(new LegalEntity());

        $this->add(array(
            'name' => 'legalId',
            'type' => 'Zend\Form\Element\Hidden',
        ));

        $this->add(array(
            'name' => 'legalCnpj',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder' => 'CNPJ',
                'class' => 'form-control input-sm cnpj',
            ),
            'options' => array(
                'label' => 'CNPJ'
            ),
        ));

        $this->add(array(
            'name' => 'legalSubscription',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder' => 'Inscrição Estadual',
                'class' => 'form-control input-sm',
            ),
            'options' => array(
                'label' => 'Inscrição Estadual'
            ),
        ));

        $this->add(array(
            'name' => 'legalRepresentativeName',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder' => 'Nome do Representante',
                'class' => 'form-control input-sm',
            ),
            'options' => array(
                'label' => 'Nome do Repres.'
            ),
        ));

        $this->add(array(
            'name' => 'legalRepresentativePhone',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder' => 'Telefone',
                'class' => 'form-control input-sm phone',
            ),
            'options' => array(
                'label' => 'Tel. do Repres.'
            ),
        ));
    }

    public function getInputFilterSpecification() {
        return array(
            'legalCnpj' => array(
                'required' => false,
                'filters' => array(
                    array('name' => 'Digits'),
                    array('name' => 'StringTrim'),
                    array('name' => 'StripTags'),
                ),
                'validators' => array(
                    new Cnpj(),
                ),
            ),
            'legalSubscription' => array(
                'required' => false,
                'filters' => array(
                    array('name' => 'Digits'),
                    array('name' => 'StringTrim'),
                    array('name' => 'StripTags'),
                ),
            ),
            'legalRepresentativeName' => array(
                'required' => false,
                'filters' => array(
                    array('name' => 'Alpha'),
                    array('name' => 'StringTrim'),
                    array('name' => 'StripTags'),
                ),
            ),
            'legalRepresentativePhone' => array(
                'required' => false,
                'filters' => array(
                    array('name' => 'Digits'),
                    array('name' => 'StringTrim'),
                    array('name' => 'StripTags'),
                ),
            ),
        );
    }
}
