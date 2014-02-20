<?php

namespace Person\Form\Fieldset;

use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use Person\Entity\Individual as IndividualEntity;
use Avr\Validator\Cpf;

class Individual extends Fieldset implements InputFilterProviderInterface {

    protected $stateCode = array(
        'AC' => 'AC',
        'AL' => 'AL',
        'AM' => 'AM',
        'AP' => 'AP',
        'BA' => 'BA',
        'CE' => 'CE',
        'DF' => 'DF',
        'ES' => 'ES',
        'GO' => 'GO',
        'MA' => 'MA',
        'MG' => 'MG',
        'MS' => 'MS',
        'MT' => 'MT',
        'PA' => 'PA',
        'PB' => 'PB',
        'PE' => 'PE',
        'PI' => 'PI',
        'PR' => 'PR',
        'RJ' => 'RJ',
        'RN' => 'RN',
        'RO' => 'RO',
        'RR' => 'RR',
        'RS' => 'RS',
        'SC' => 'SC',
        'SE' => 'SE',
        'SP' => 'SP',
        'TO' => 'TO',
    );


    public function __construct($entityManager) {
        
        parent::__construct('individual');

        $hydrator = new DoctrineHydrator($entityManager);
        
        $this->setHydrator($hydrator)
                ->setObject(new IndividualEntity());

        $this->add(array(
            'name' => 'individualId',
            'type' => 'Zend\Form\Element\Hidden',
        ));

        $this->add(array(
            'name' => 'individualCpf',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder' => 'CPF',
                'class' => 'form-control input-sm cpf',
            ),
            'options' => array(
                'label' => 'CPF'
            ),
        ));

        $this->add(array(
            'name' => 'individualRg',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder' => 'RG',
                'class' => 'form-control input-sm',
            ),
            'options' => array(
                'label' => 'RG'
            ),
        ));

        $this->add(array(
            'name' => 'individualRgOrgan',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder' => 'Org. Expedidor',
                'class' => 'form-control input-sm',
            ),
            'options' => array(
                'label' => 'Org. Exp.'
            ),
        ));

        $this->add(array(
            'name' => 'individualRgUf',
            'type' => 'Zend\Form\Element\Select',
            'attributes' => array(
                'placeholder' => 'UF',
                'class' => 'form-control input-sm',
            ),
            'options' => array(
                'label' => 'UF',
                'empty_option' => 'UF',
                'value_options' => $this->stateCode,
            ),
        ));

        $this->add(array(
            'name' => 'individualRgDate',
            'type' => 'Zend\Form\Element\Date',
            'attributes' => array(
                'placeholder' => 'Dt. de Expedição',
                'class' => 'form-control input-sm',
            ),
            'options' => array(
                'label' => 'Data de Expedição'
            ),
        ));

        $this->add(array(
            'name' => 'individualBirthDay',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder' => 'Dia',
                'class' => 'form-control input-sm',
                'maxlength' => 2,
            ),
            'options' => array(
                'label' => 'Dia'
            ),
        ));
        
        $this->add(array(
            'name' => 'individualBirthMonth',
            'type' => 'Zend\Form\Element\Select',
            'attributes' => array(
                'class' => 'form-control input-sm',
            ),
            'options' => array(
                'empty_option' => 'Mês',
                'value_options' => array(
                    '01' => 'JANEIRO',
                    '02' => 'FEVEREIRO',
                    '03' => 'MARÇO',
                    '04' => 'ABRIL',
                    '05' => 'MAIO',
                    '06' => 'JUNHO',
                    '07' => 'JULHO',
                    '08' => 'AGOSTO',
                    '09' => 'SETEMBRO',
                    '10' => 'OUTUBRO',
                    '11' => 'NOVEMBRO',
                    '12' => 'DEZEMBRO',
                ),
                'label' => 'Mês'
            )
        ));
        
        $this->add(array(
            'name' => 'individualBirthYear',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder'   => 'Ano',
                'class'         => 'form-control input-sm',
                'maxlength'     => 4,
            ),
            'options' => array(
                'label' => 'Ano'
            ),
        ));
        
        $this->add(array(
            'name' => 'individualBirthPlace',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder'   => 'Naturalidade',
                'class'         => 'form-control input-sm',
            ),
            'options' => array(
                'label' => 'Naturalidade'
            ),
        ));
        
        $this->add(array(
            'name' => 'individualBirthUf',
            'type' => 'Zend\Form\Element\Select',
            'attributes' => array(
                'placeholder'   => 'UF',
                'class'         => 'form-control input-sm',
            ),
            'options' => array(
                'label' => 'UF',
                'empty_option' => 'UF',
                'value_options' => $this->stateCode,
            ),
        ));
       
        $this->add(array(
            'name' => 'individualMother',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder'   => 'Nome da Mãe',
                'class'         => 'form-control input-sm',
            ),
            'options' => array(
                'label' => 'Nome da Mãe'
            ),
        ));
        
        $this->add(array(
            'name' => 'individualFather',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder'   => 'Nome do Pai',
                'class'         => 'form-control input-sm',
            ),
            'options' => array(
                'label' => 'Nome do Pai'
            ),
        ));
        
        $this->add(array(
            'name' => 'individualNationality',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder'   => 'Nacionalidade',
                'class'         => 'form-control input-sm',
            ),
            'options' => array(
                'label' => 'Nacionalidade'
            ),
        ));
        
        $this->add(array(
            'name' => 'individualGender',
            'type' => 'Zend\Form\Element\Select',
            'attributes' => array(
                'class' => 'form-control input-sm'
            ),
            'options' => array(
                'empty_option' => 'Sexo',
                'value_options' => array(
                    '0' => 'FEMININO',
                    '1' => 'MASCULINO'
                ),
                'label' => 'Sexo'
            ),
        ));
        
        $this->add(array(
            'name' => 'occupationId',
            'type' => 'DoctrineORMModule\Form\Element\EntitySelect',
            'attributes' => array(
                'class' => 'form-control input-sm'
            ),
            'options' => array(
                'empty_option' => 'Profissão/Formação',
                'object_manager' => $entityManager,
                'target_class' => 'Occupation\Entity\Occupation',
                'property' => 'occupationName',
                'is_method' => true,
                'find_method' => array(
                    'name' => 'findBy',
                    'params' => array(
                        'criteria' => array(),
                        'orderBy' => array('occupationName' => 'ASC')
                    )
                ),
                'label' => "Profissão/Formação"
            )
        ));
        
        $professional = new \Person\Form\Fieldset\Professional($entityManager);
        $professional->setName('professional')
                ->setLabel('Dados Profissionais');
        $this->add($professional);
        
        $professional_addon = new \Person\Form\Fieldset\ProfessionalAddon($entityManager);
        $professional_addon->setName('professionalAddon')
                ->setLabel('Dados Profissionais Adicionais');
        $this->add($professional_addon);
    }

    public function getInputFilterSpecification() {
        return array(
            'individualBirthDay' => array(
                'required' => false,
                'filters' => array(
                    array('name' => 'Digits'),
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array('name' => 'Between', 'options' => array(
                        'min' => 1,
                        'max' => 31,
                    )),
                ),
            ),
            'individualBirthMonth' => array(
                'required' => false,
            ),
            'individualBirthYear' => array(
                'required' => false,
                'filters' => array(
                    array('name' => 'Digits'),
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array('name' => 'Between', 'options' => array(
                        'min' => 1900,
                        'max' => date('Y') - 5,
                    )),
                ),
            ),
            'individualRgDate' => array(
                'required' => false,
            ),
            'individualGender' => array(
                'required' => false,
            ),
            'individualCpf' => array(
                'required' => false,
                'filters' => array(
                    array('name' => 'Digits'),
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    new Cpf(),
                )
            ),
            'individualRg' => array(
                'required' => false,
                'filters' => array(
                    array('name' => 'Alnum'),
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
            ),
            'individualRgUf' => array(
                'required' => false,
            ),
            'individualBirthUf' => array(
                'required' => false,
            ),
            'occupationId' => array(
                'required' => false,
            )
        );
    }
}
