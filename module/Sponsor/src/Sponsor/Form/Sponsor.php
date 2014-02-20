<?php

namespace Sponsor\Form;

use Sponsor\Entity\Sponsor as SponsorEntity;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\InputFilter\InputFilter;
use Zend\Form\Form;

class Sponsor extends Form {

    public function __construct($entityManager) {

        parent::__construct('sponsor_form');
        
        $this->setAttribute('method', 'post')
                ->setHydrator(new DoctrineHydrator($entityManager))
                ->setObject(new SponsorEntity())
                ->setInputFilter(new InputFilter());

        $sponsor = new Fieldset\Sponsor($entityManager);
        $sponsor->setUseAsBaseFieldset(true)
                ->setName('sponsor');
        $this->add($sponsor);
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Csrf',
            'name' => 'security'
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Submit',
            'name' => 'submit',
            'attributes' => array(
                'value' => 'Salvar',
                'class' => 'btn btn-primary'
            )
        ));

        $this->add(array(
            'name' => 'cancel',
            'attributes' => array(
                'type' => 'button',
                'value' => 'Cancel',
                'class' => 'btn btn-default',
                'onclick' => "javascript: window.location.href = '/admin/customer'",
            )
        ));
    }
}
