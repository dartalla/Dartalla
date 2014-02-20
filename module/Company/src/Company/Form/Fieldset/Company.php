<?php

namespace Company\Form\Fieldset;

use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset as ZendFielset;
use Company\Entity\Company as CompanyEntity;

class Company extends ZendFielset implements InputFilterProviderInterface {

    public function __construct($entityManager) {
        
        parent::__construct('company');

        $this->setHydrator(new DoctrineHydrator($entityManager, 'Company\Entity\Company', true))
                ->setObject(new CompanyEntity());

        $this->add(array(
            'name' => 'companySelf',
            'type' => 'Zend\Form\Element\Hidden',
        ));
        
        $this->add(array(
            'name' => 'companyId',
            'type' => 'Zend\Form\Element\Hidden',
        ));

        $this->add(array(
            'name' => 'companyUid',
            'type' => 'Zend\Form\Element\Hidden',
        ));

        $this->add(array(
            'name' => 'companyName',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder' => 'Razão Social',
                'class' => 'form-control input-sm',
                'required' => 'required',
                'width' => '200px',
            ),
            'options' => array(
                'label' => 'Razão Social',
            )
        ));
        
        $this->add(array(
            'name' => 'companyIsMaster',
            'type' => 'Zend\Form\Element\Select',
            'attributes' => array(
                'class' => 'form-control input-sm',
                'readonly' => 'readonly'
            ),
            'options' => array(
                'label' => 'Tipo',
                'value_options' => array(
                    '0' => 'Filial',
                ),
            )
        ));

        $this->add(array(
            'name' => 'companyFancyName',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder' => 'Nome da Fantasia',
                'class' => 'form-control input-sm',
            ),
            'options' => array(
                'label' => 'Nome Fantasia',
            )
        ));

        $this->add(array(
            'name' => 'companyCnpj',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder' => 'CNPJ',
                'class' => 'form-control input-sm cnpj',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'CNPJ',
            )
        ));

        $this->add(array(
            'name' => 'companySubscription',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder' => 'Inscrição Estadual',
                'class' => 'form-control input-sm',
            ),
            'options' => array(
                'label' => 'Inscrição Estadual',
            )
        ));

        $this->add(array(
            'name' => 'companyRepresentativeName',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder' => 'Nome do Representante',
                'class' => 'form-control input-sm',
            ),
            'options' => array(
                'label' => 'Nome do Representante',
            )
        ));

        $this->add(array(
            'name' => 'companyRepresentativePhone',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder' => 'Tel. do Repres.',
                'class' => 'form-control input-sm phone',
            ),
            'options' => array(
                'label' => 'Telefone do Rep.',
            )
        ));

        $this->add(array(
            'name' => 'companyTimestamp',
            'type' => 'Zend\Form\Element\Hidden',
        ));

        $this->add(array(
            'name' => 'companyIsActive',
            'type' => 'Zend\Form\Element\Hidden'
        ));

        $address = new \Person\Form\Fieldset\Address($entityManager);
        $address->setLabel('Dados de Endereço')
                ->setName('address');
        $this->add($address);

        $contact = new \Person\Form\Fieldset\Contact($entityManager);
        $contact->setName('contact')
                ->setLabel('Dados de Contato');
        $this->add($contact);
        
        $user = new User($entityManager);
        $this->add($user);
    }

    public function getInputFilterSpecification() {
        return array(
            'companyName' => array(
                'required' => true
            ),
            'companyRepresentativePhone' => array(
                'required' => false,
                'filters' => array(
                    array(
                        'name' => 'Digits'
                    )
                )
            ),
            'companyCnpj' => array(
                'required' => true,
                'filters' => array(
                    array('name' => 'Digits'),
                ),
                'validators' => array(
                    new \Avr\Validator\Cnpj(),
                ),
            ),
        );
    }
}
