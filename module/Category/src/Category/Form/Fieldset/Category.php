<?php

namespace Category\Form\Fieldset;

use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset as ZendFielset;
use Category\Entity\Category as CategoryEntity;

class Category extends ZendFielset implements InputFilterProviderInterface {

    public function __construct($entityManager, $company) {
        parent::__construct('category');
        
        $classMethod = new \Zend\Stdlib\Hydrator\ClassMethods(false);
        $classMethod->addStrategy('categoryId', new \Category\Strategy\Category());
        
        $this->setHydrator(new DoctrineHydrator($entityManager, $classMethod))
                ->setObject(new CategoryEntity());

        $this->add(array(
            'name' => 'categoryId',
            'type' => 'Zend\Form\Element\Hidden',
        ));
        
        $this->add(array(
            'name' => 'companyId',
            'type' => 'Zend\Form\Element\Hidden',
        ));
        
        $this->add(array(
            'name' => 'categoryName',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder'   => 'Categoria',
                'class'         => 'span4',
                'required'      => 'required',
            ),
        ));
        
        $this->add(array(
            'name' => 'categoryIsService',
            'type' => 'Zend\Form\Element\Radio',
            'options' => array(
                'value_options' => array(
                    0 => 'Produto',
                    1 => 'Serviço'
                ),
            ),
        ));
        $this->add(array(
            'name' => 'categorySelf',
            'type' => 'DoctrineORMModule\Form\Element\EntitySelect',
            'options' => array(
                'empty_option'      => 'Categoria',
                'object_manager'    => $entityManager,
                'target_class'      => 'Category\Entity\Category',
                'property'          => 'categoryName',
                'is_method'         => true,
                'find_method'       => array(
                    'name' => 'findBy',
                    'params' => array(
                        'criteria' => array('companyId' => $company),
                        'orderBy' => array('categoryName' => 'ASC')
                    )
                )
            ),
            'attributes' => array(
                'class'     => 'span4',
            )
        ));
    }

    public function getInputFilterSpecification() {
        return array(
            'categoryName' => array(
                'required' => true,
            ),
            'categorySelf' => array(
                'required' => false,
            ),
        );
    }
}
