<?php

namespace Person\Form\Fieldset;

use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use Person\Entity\Professional as ProfessionalEntity;

class Professional extends Fieldset implements InputFilterProviderInterface {

    public function __construct($entityManager) {
        parent::__construct('professional');

        $hydrator = new DoctrineHydrator($entityManager);

        $this->setHydrator($hydrator)
                ->setObject(new ProfessionalEntity());

        $this->add(array(
            'name' => 'professionalId',
            'type' => 'Zend\Form\Element\Hidden',
        ));

        $this->add(array(
            'name' => 'professionalAdmissionDate',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder' => 'Data de Admissão',
                'class' => 'form-control input-sm datepicker',
            ),
            'options' => array(
                'label' => 'Data de Admissão'
            ),
        ));

        $this->add(array(
            'name' => 'professionalEnterpriseName',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder' => 'Nome da Empresa',
                'class' => 'form-control input-sm',
            ),
            'options' => array(
                'label' => 'Nome da Empresa'
            ),
        ));

        $this->add(array(
            'name' => 'professionalEnterpriseCnpj',
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
            'name' => 'professionalEnterpriseBusiness',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder' => 'Ramo de Atividade',
                'class' => 'form-control input-sm',
            ),
            'options' => array(
                'label' => 'Ramo de Atividade'
            ),
        ));

        $this->add(array(
            'name' => 'professionalEnterpriseFoundationDate',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder' => 'Data de Fundação',
                'class' => 'form-control input-sm datepicker',
            ),
            'options' => array(
                'label' => 'Data de Fundação'
            ),
        ));

        $this->add(array(
            'name' => 'professionalEnterpriseParticipation',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder' => 'Partic. nos Lucros',
                'class' => 'form-control input-sm porcent',
            ),
            'options' => array(
                'label' => 'Partic. nos Lucros'
            ),
        ));

        $this->add(array(
            'name' => 'professionalEnterprisePartnerCount',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder' => 'Nº de Sócios',
                'class' => 'form-control input-sm',
            ),
            'options' => array(
                'label' => 'Nº de Sócios'
            ),
        ));

        $this->add(array(
            'name' => 'professionalOffice',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder' => 'Cargo',
                'class' => 'form-control input-sm',
            ),
            'options' => array(
                'label' => 'Cargo'
            ),
        ));

        $this->add(array(
            'name' => 'professionalSalary',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder' => 'Salário',
                'class' => 'form-control input-sm currency',
            ),
            'options' => array(
                'label' => 'Salário'
            ),
        ));

        $this->add(array(
            'name' => 'professionalOtherRevenue',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder' => 'Outra Receita',
                'class' => 'form-control input-sm currency',
            ),
            'options' => array(
                'label' => 'Outra Receita'
            ),
        ));

        $this->add(array(
            'name' => 'professionalBenefitNumber',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder' => 'Nº do Benefício',
                'class' => 'form-control input-sm',
            ),
            'options' => array(
                'label' => 'Nº do Benefício'
            ),
        ));

        $this->add(array(
            'name' => 'professionalNotes',
            'type' => 'Zend\Form\Element\Textarea',
            'attributes' => array(
                'placeholder' => 'Observações',
                'class' => 'form-control input-sm',
            ),
            'options' => array(
                'label' => 'Observações'
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
        
        $this->add(array(
            'name' => 'business',
            'type' => 'DoctrineORMModule\Form\Element\EntitySelect',
            'attributes' => array(
                'class' => 'form-control input-sm'
            ),
            'options' => array(
                'empty_option' => 'Ramo de Atividade',
                'object_manager' => $entityManager,
                'target_class' => 'Person\Entity\Business',
                'property' => 'businessName',
                'is_method' => true,
                'find_method' => array(
                    'name' => 'findBy',
                    'params' => array(
                        'criteria' => array(),
                        'orderBy' => array('businessName' => 'ASC')
                    )
                ),
                'label' => "Ramo de Atividade"
            )
        ));
    }

    public function getInputFilterSpecification() {
        return array(
            'professionalEnterpriseParticipation' => array(
                'required' => false,
                'filters' => array(
                    new \Zend\I18n\Filter\NumberFormat()
                ),
            ),
            'professionalEnterpriseCnpj' => array(
                'required' => false,
                'filters' => array(
                    new \Zend\Filter\Digits()
                ),
            ),
            'professionalSalary' => array(
                'required' => false,
                'filters' => array(
                    new \Zend\I18n\Filter\NumberFormat()
                ),
            ),
            'professionalOtherRevenue' => array(
                'required' => false,
                'filters' => array(
                    new \Zend\I18n\Filter\NumberFormat()
                ),
            ),
            'professionalEnterpriseFoundationDate' => array(
                'required' => false,
            ),
            'professionalAdmissionDate' => array(
                'required' => false,
            ),
            'business' => array(
                'required' => false,
            ),
        );
    }

}
