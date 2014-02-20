<?php

namespace DocumentType\Form\Fieldset;

use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset as ZendFielset;
use DocumentType\Entity\DocumentType as DocumentTypeEntity;

class DocumentType extends ZendFielset implements InputFilterProviderInterface {

    public function __construct($entityManager) {
        parent::__construct('documentType');
        
        $this->setHydrator(new DoctrineHydrator($entityManager))
                ->setObject(new DocumentTypeEntity());

        $this->add(array(
            'name' => 'company',
            'type' => 'Zend\Form\Element\Hidden',
        ));
        
        $this->add(array(
            'name' => 'documentTypeId',
            'type' => 'Zend\Form\Element\Hidden',
        ));
        
        $this->add(array(
            'name' => 'documentTypeName',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder'   => 'Tipo de Documento',
                'class'         => 'form-control input-sm',
                'required'      => 'required',
            ),
            'options' => array(
                'label' => 'Tipo de Documento'
            )
        ));
    }

    public function getInputFilterSpecification() {
        return array(
            'documentTypeName' => array(
                'required' => true,
            ),
        );
    }
}
