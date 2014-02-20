<?php

namespace Person\Form\Fieldset;

use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use Person\Entity\Person as PersonEntity;

class Person extends Fieldset implements InputFilterProviderInterface {

    public function __construct($entityManager) {
        
        parent::__construct('person');

        $this->setHydrator(new DoctrineHydrator($entityManager))
                ->setObject(new PersonEntity());

        $this->add(array(
            'name' => 'personId',
            'type' => 'Zend\Form\Element\Hidden',
        ));
        
        $this->add(array(
            'name' => 'personType',
            'type' => 'Zend\Form\Element\Hidden',
        ));

        $this->add(array(
            'name' => 'personName',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'required' => 'required',
                'placeholder' => 'Nome',
                'class' => 'form-control input-sm',
            ),
            'options' => array(
               'label' => 'Nome'
            ),
        ));
        
        $address = new \Person\Form\Fieldset\Address($entityManager);
        $address->setLabel('Dados de Endereço')
                ->setName('address');
        $this->add($address);

        $contact = new Contact($entityManager);
        $contact->setName('contact')
                ->setLabel('Dados de Contato');
        $this->add($contact);
        
        $individual = new Individual($entityManager);
        $individual->setName('individual')
                ->setLabel('Dados de Pessoa Física');
        $this->add($individual);
        
        $legal = new Legal($entityManager);
        $legal->setName('legal')
                ->setLabel('Dados de Pessoa Jurídica');
        $this->add($legal);
    }

    public function getInputFilterSpecification() {
        return array(
            'personName' => array(
                'required' => true
            ),
        );
    }
}
