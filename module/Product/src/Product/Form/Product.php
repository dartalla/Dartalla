<?php

namespace Product\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Product\Entity\Product as ProductEntity;
use Product\Form\Fieldset\Product as ProductFieldset;

class Product extends Form {

    public function __construct($entityManager) {
        parent::__construct('product_form');

        $classMethods = new ClassMethodsHydrator(false);
        $classMethods->addStrategy('unitId', new \Unit\Strategy\Unit());
        $classMethods->addStrategy('categoryId', new \Category\Strategy\Category());
        $classMethods->addStrategy('supplierId', new \Supplier\Strategy\Supplier());

        $hydrator = new DoctrineHydrator($entityManager, $classMethods);

        $this->setHydrator($hydrator)
                ->setObject(new ProductEntity())
                ->setInputFilter(new InputFilter())
                ->setAttribute('method', 'post')
                ->setAttribute('class', 'form-horizontal');

        $fieldset = new ProductFieldset($entityManager);
        $fieldset->setUseAsBaseFieldset(true);
        $this->add($fieldset);

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
                'onclick' => "javascript: window.location.href = '/admin/product'",
            )
        ));
    }

}
