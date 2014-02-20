<?php

namespace Service\Form\Fieldset;

use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset as ZendFielset;
use Service\Entity\Service as ServiceEntity;

class Service extends ZendFielset implements InputFilterProviderInterface {

    public function __construct($entityManager) {
        parent::__construct('service');

        $classMethods = new ClassMethodsHydrator(false);
        $classMethods->addStrategy('unitId', new \Unit\Strategy\Unit());
        $classMethods->addStrategy('categoryId', new \Category\Strategy\Category());

        $hydrator = new DoctrineHydrator($entityManager, $classMethods);
        
        $this->setHydrator($hydrator)
                ->setObject(new ServiceEntity());

        $this->add(array(
            'name' => 'serviceId',
            'type' => 'Zend\Form\Element\Hidden',
        ));

        $this->add(array(
            'name' => 'companyId',
            'type' => 'Zend\Form\Element\Hidden',
        ));

        $this->add(array(
            'name' => 'serviceName',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder' => 'Serviço',
                'class' => 'span4',
                'required' => 'required',
            ),
        ));

        $this->add(array(
            'name' => 'servicePrice',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder' => 'Preço',
                'class' => 'span2 currency',
            ),
        ));

        $this->add(array(
            'name' => 'servicePromotionalPrice',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder' => 'Preço Promocional',
                'class' => 'span2 currency',
            ),
        ));

        $this->add(array(
            'name' => 'serviceNotes',
            'type' => 'Zend\Form\Element\TextArea',
            'attributes' => array(
                'placeholder' => 'Observações',
                'class' => 'span6'
            ),
        ));

        $this->add(array(
            'name' => 'servicePromotional',
            'type' => 'Zend\Form\Element\Checkbox',
        ));

        $this->add(array(
            'name' => 'serviceActive',
            'type' => 'Zend\Form\Element\Checkbox',
        ));

        $this->add(array(
            'name' => 'unitId',
            'type' => 'DoctrineORMModule\Form\Element\EntitySelect',
            'options' => array(
                'object_manager' => $entityManager,
                'target_class' => 'Unit\Entity\Unit',
                'property' => 'unitSymbol',
                'empty_option' => '',
            ),
            'attributes' => array(
                'class' => 'span1',
            )
        ));

        $this->add(array(
            'name' => 'categoryId',
            'type' => 'DoctrineORMModule\Form\Element\EntitySelect',
            'options' => array(
                'empty_option' => '',
                'object_manager' => $entityManager,
                'target_class' => 'Category\Entity\Category',
                'property' => 'categoryName',
                'is_method' => true,
                'find_method' => array(
                    'name' => 'findBy',
                    'params' => array(
                        'criteria' => array('categoryIsService' => 1),
                        'orderBy' => array('categoryName' => 'ASC')
                    )
                )
            ),
            'attributes' => array(
                'class' => 'span4',
            )
        ));
    }

    public function getInputFilterSpecification() {
        return array(
            'serviceName' => array(
                'required' => true,
            ),
            'unitId' => array(
                'required' => false,
            ),
            'categoryId' => array(
                'required' => false,
            ),
            'servicePrice' => array(
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    new \Avr\Filter\Currency()
                ),
            ),
            'servicePromotionalPrice' => array(
                'required' => false,
                'filters' => array(
                    array('name' => 'StripTags'),
                    new \Avr\Filter\Currency()
                ),
            ),
        );
    }

}
