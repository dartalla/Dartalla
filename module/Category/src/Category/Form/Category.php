<?php

namespace Category\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Category\Entity\Category as CategoryEntity;
use Category\Form\Fieldset\Category as CategoryFieldset;

class Category extends Form {

    public function __construct($entityManager, $company) {

        parent::__construct('category_form');

        $classMethod = new \Zend\Stdlib\Hydrator\ClassMethods(false);
        $classMethod->addStrategy('categoryId', new \Category\Strategy\Category());

        $this->setHydrator(new DoctrineHydrator($entityManager, $classMethod))
                ->setObject(new CategoryEntity())
                ->setInputFilter(new InputFilter())
                ->setAttribute('method', 'post');

        $category = new CategoryFieldset($entityManager, $company);
        $category->setUseAsBaseFieldset(true);
        $this->add($category);

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
                'class' => 'btn',
                'onclick' => "javascript: window.location.href = '/admin/category'",
            )
        ));
    }

}
