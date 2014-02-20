<?php

namespace Company\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Company\Entity\Company as CompanyEntity;

class Company extends Form {

    public function __construct($entityManager) {

        parent::__construct('company_form');

        $this->setAttribute('method', 'post')
                ->setHydrator(new DoctrineHydrator($entityManager, 'Company\Entity\Company', true))
                ->setObject(new CompanyEntity())
                ->setInputFilter(new InputFilter());
        
        $company = new Fieldset\Company($entityManager);
        $company->setUseAsBaseFieldset(true);
        $this->add($company);
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Csrf',
            'name' => 'csrf'
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
                'onclick' => "javascript: window.location.href = '/admin/company'",
            )
        ));
    }
}
