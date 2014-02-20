<?php

namespace Product\Form\Fieldset;

use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset as ZendFielset;
use Product\Entity\Product as ProductEntity;
use Avr\Filter\Currency;
use Avr\Filter\Porcent;

class Product extends ZendFielset implements InputFilterProviderInterface {

    public function __construct($entityManager) {
        parent::__construct('product');

        $classMethods = new ClassMethodsHydrator(false);
        $classMethods->addStrategy('unitId', new \Unit\Strategy\Unit());
        $classMethods->addStrategy('categoryId', new \Category\Strategy\Category());
        $classMethods->addStrategy('supplierId', new \Supplier\Strategy\Supplier());

        $hydrator = new DoctrineHydrator($entityManager, $classMethods);

        $this->setHydrator($hydrator)
                ->setObject(new ProductEntity());

        $this->add(array(
            'name' => 'productId',
            'type' => 'Zend\Form\Element\Hidden',
        ));

        $this->add(array(
            'name' => 'companyId',
            'type' => 'Zend\Form\Element\Hidden',
        ));

        $this->add(array(
            'name' => 'productUid',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'class' => 'span4',
            ),
        ));

        $this->add(array(
            'name' => 'productBarcode',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'class' => 'span4',
            ),
        ));

        $this->add(array(
            'name' => 'productName',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'class' => 'span4',
                'required' => 'required',
            ),
        ));

        $this->add(array(
            'name' => 'productBrand',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'class' => 'span4',
            ),
        ));

        $this->add(array(
            'name' => 'productModel',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'class' => 'span4',
            ),
        ));

        $this->add(array(
            'name' => 'productCost',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'class' => 'span2 currency',
                'id' => 'productCost',
                'onblur' => 'javascript: calculatePrice(this.value, $("#productMarkup").val(), $("#productPrice"));'
            ),
        ));

        $this->add(array(
            'name' => 'productMarkup',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'class' => 'span1 porcent',
                'id' => 'productMarkup',
                'onblur' => 'javascript: calculatePrice($("#productCost").val(), this.value, $("#productPrice"));'
            ),
        ));

        $this->add(array(
            'name' => 'productPrice',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'class' => 'span2 currency',
                'id' => 'productPrice',
                'readonly' => 'readonly'
            ),
        ));

        $this->add(array(
            'name' => 'productPromotionalMarkup',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'class' => 'span1 porcent',
                'id' => 'productPromotionalMarkup',
                'onblur' => 'javascript: calculatePrice($("#productCost").val(), this.value, $("#productPromotionalPrice"));'
            ),
        ));

        $this->add(array(
            'name' => 'productPromotionalPrice',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'class' => 'span2 currency',
                'readonly' => 'readonly',
                'id' => 'productPromotionalPrice'
            ),
        ));

        $this->add(array(
            'name' => 'productWholesaleMarkup',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'class' => 'span1 porcent',
                'id' => 'productWholesaleMarkup',
                'onblur' => 'javascript: calculatePrice($("#productCost").val(), this.value, $("#productWholesalePrice"));'
            ),
        ));

        $this->add(array(
            'name' => 'productWholesalePrice',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'class' => 'span2 currency',
                'readonly' => 'readonly',
                'id' => 'productWholesalePrice'
            ),
        ));

        $this->add(array(
            'name' => 'productMinimumStock',
            'type' => 'Zend\Form\Element\Number',
            'attributes' => array(
                'class' => 'span1',
                'min' => 0,
                'max' => 9999,
                'step' => 1
            ),
            'value' => 0
        ));

        $this->add(array(
            'name' => 'productIdealStock',
            'type' => 'Zend\Form\Element\Number',
            'attributes' => array(
                'class' => 'span1',
                'min' => 0,
                'max' => 9999,
                'step' => 1
            ),
            'value' => 0
        ));

        $this->add(array(
            'name' => 'productNotes',
            'type' => 'Zend\Form\Element\TextArea',
            'attributes' => array(
                'class' => 'span4'
            ),
        ));

        $this->add(array(
            'name' => 'productImage',
            'type' => 'Zend\Form\Element\File',
            'attributes' => array(
                'class' => 'span4'
            ),
        ));

        $this->add(array(
            'name' => 'productPromotion',
            'type' => 'Zend\Form\Element\Checkbox',
        ));

        $this->add(array(
            'name' => 'productActive',
            'type' => 'Zend\Form\Element\Checkbox',
            'attributes' => array(
            ),
        ));

        $this->add(array(
            'name' => 'supplierId',
            'type' => 'DoctrineORMModule\Form\Element\EntitySelect',
            'options' => array(
                'empty_option' => '',
                'object_manager' => $entityManager,
                'target_class' => 'Supplier\Entity\Supplier',
                'property' => 'supplierName',
                'is_method' => true,
                'find_method' => array(
                    'name' => 'findAll',
                    'params' => array()
                )
            ),
            'attributes' => array(
                'class' => 'span4',
            )
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
                'object_manager' => $entityManager,
                'target_class' => 'Category\Entity\Category',
                'property' => 'categoryName',
                'empty_option' => '',
                'is_method' => true,
                'find_method' => array(
                    'name' => 'findBy',
                    'params' => array(
                        'criteria' => array('categoryIsService' => 0),
                        'orderBy' => array('categoryName' => 'ASC'),
                    ),
                ),
            ),
            'attributes' => array(
                'class' => 'span4',
            )
        ));
    }

    public function getInputFilterSpecification() {
        return array(
            'productName' => array(
                'required' => true,
            ),
            'unitId' => array(
                'required' => false,
            ),
            'productMarkup' => array(
                'required' => false,
                'filters' => array(
                    new Porcent()
                ),
            ),
            'productCost' => array(
                'required' => false,
                'filters' => array(
                    new Currency()
                ),
            ),
            'productPrice' => array(
                'required' => false,
                'filters' => array(
                    array('name' => 'StripTags'),
                    new Currency()
                ),
            ),
            'productPromotionalPrice' => array(
                'required' => false,
                'filters' => array(
                    array('name' => 'StripTags'),
                    new Currency()
                ),
            ),
            'productWholesalePrice' => array(
                'required' => false,
                'filters' => array(
                    array('name' => 'StripTags'),
                    new Currency()
                ),
            ),
            'productPromotion' => array(
                'required' => false,
            ),
        );
    }

}
