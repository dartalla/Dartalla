<?php

namespace Sponsor\Form\Fieldset;

use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset as ZendFielset;
use Sponsor\Entity\Sponsor as SponsorEntity;

class Sponsor extends ZendFielset implements InputFilterProviderInterface {

    public function __construct($entityManager) {
        parent::__construct('sponsor');

        $this->setHydrator(new DoctrineHydrator($entityManager))
                ->setObject(new SponsorEntity());

        $this->add(array(
            'name' => 'sponsorId',
            'type' => 'Zend\Form\Element\Hidden',
        ));
        
        $person = new \Person\Form\Fieldset\Person($entityManager);
        $person->setName('person')
                ->get('personName')->setAttribute('required', false)
                ->setLabel('Dados Gerais');
        $this->add($person);
        
        $bankAccount = new \BankAccount\Form\Fieldset\BankAccount($entityManager);
        $bankAccount->setName('bankAccount')
                ->setLabel('Conta Bancária');
        $this->add($bankAccount);
        
        $this->add(array(
            'name' => 'sponsorResidenceType',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'class' => 'form-control input-sm',
                'placeholder' => 'Tipo de Residência'
            ),
            'options' => array(
                'label' => 'Tipo de Residência'
            ),
        ));
        
        $this->add(array(
            'name' => 'sponsorResidenceTime',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'class' => 'form-control input-sm',
                'placeholder' => 'Tempo na Residência'
            ),
            'options' => array(
                'label' => 'Tempo na Residência'
            ),
        ));
        
        $this->add(array(
            'name' => 'sponsorResidenceRentValue',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'class' => 'form-control input-sm currency',
                'placeholder' => 'Valor do Aluguel'
            ),
            'options' => array(
                'label' => 'Valor do Aluguel'
            ),
        ));
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'companyId',
        ));
    }
    
    public function getInputFilterSpecification() {
        return array(
            'sponsorId' => array(
                'required' => false,
            ),
        );
    }
}
