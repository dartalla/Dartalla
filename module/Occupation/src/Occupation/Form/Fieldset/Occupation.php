<?php

namespace Occupation\Form\Fieldset;

use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset as ZendFielset;
use Occupation\Entity\Occupation as OccupationEntity;

class Occupation extends ZendFielset implements InputFilterProviderInterface {

    public function __construct() {
        parent::__construct('occupation');
        
        $this->setHydrator(new DoctrineHydrator($entityManager))
                ->setObject(new OccupationEntity());

        $this->add(array(
            'name' => 'occupationId',
            'type' => 'Zend\Form\Element\Hidden',
        ));
        
        $this->add(array(
            'name' => 'occupationName',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder'   => 'Nome da Profissão',
                'class'         => 'form-control input-sm',
                'required'      => 'required',
            ),
            'options' => array(
                'label' => 'Nome da Profissão'
            ),
        ));
    }

    public function getInputFilterSpecification() {
        return array(
            'occupationName' => array(
                'required' => true,
            ),
        );
    }

}
