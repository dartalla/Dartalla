<?php

namespace Person\Form\Fieldset;

use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use Person\Entity\Contact as ContactEntity;

class Contact extends Fieldset implements InputFilterProviderInterface {

    public function __construct($entityManager) {
        
        parent::__construct('contact');

        $this->setHydrator(new DoctrineHydrator($entityManager))
                ->setObject(new ContactEntity());

        $this->add(array(
            'name' => 'contactId',
            'type' => 'Zend\Form\Element\Hidden',
        ));

        $this->add(array(
            'name' => 'contactEmail',
            'type' => 'Zend\Form\Element\Email',
            'attributes' => array(
                'placeholder' => 'E-mail',
                'class' => 'form-control input-sm',
            ),
            'options' => array(
                'label' => 'E-mail'
            ),
        ));

        $this->add(array(
            'name' => 'contactWebsite',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder' => 'Website',
                'class' => 'form-control input-sm',
            ),
            'options' => array(
                'label' => 'Website'
            ),
        ));

        $this->add(array(
            'name' => 'contactPhone',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder' => 'Telefone',
                'class' => 'form-control input-sm phone',
            ),
            'options' => array(
                'label' => 'Telefone'
            ),
        ));

        $this->add(array(
            'name' => 'contactCell',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder' => 'Celular',
                'class' => 'form-control input-sm phone',
            ),
            'options' => array(
                'label' => 'Celular'
            ),
        ));

        $this->add(array(
            'name' => 'contactFax',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder' => 'FAX',
                'class' => 'form-control input-sm phone',
            ),
            'options' => array(
                'label' => 'Fax'
            ),
        ));
    }

    public function getInputFilterSpecification() {
        return array(
            'contactEmail' => array(
                'required' => false,
                'validators' => array(
                    array('name' => 'EmailAddress'),
                ),
                'filters' => array(
                    array('name' => 'StringToLower')
                )
            ),
            'contactWebsite' => array(
                'required' => false,
                'filters' => array(
                    array('name' => 'StringToLower') 
                ),
            ),
            'contactPhone' => array(
                'required' => false,
                'filters' => array(
                    array('name' => 'Digits'),
                )
            ),
            'contactCell' => array(
                'required' => false,
                'filters' => array(
                    array('name' => 'Digits'),
                )
            ),
            'contactFax' => array(
                'required' => false,
                'filters' => array(
                    array('name' => 'Digits'),
                )
            ),
        );
    }
}
