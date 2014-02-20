<?php

namespace Product\View\Helper;

use Zend\View\Helper\AbstractHelper;

class ProductStatus extends AbstractHelper {

    public function __invoke($product) {

        if ($product) {
            $stock = $product->getProductStock();
            $idealStock = $product->getProductIdealStock();
            $minStock = $product->getProductMinimumStock();
            $status = '';
            $class = '';
            if ($stock > 0) {
                if ($stock > $idealStock) {
                    $class = 'text-success';
                    $status = 'Suprido';
                }
                if (($stock >= $minStock) && ($stock <= $idealStock)) {
                    $class = 'text-info';
                    $status = 'Normal';
                }
                if ($stock < $minStock) {
                    $class = 'text-warning';
                    $status = $this->translate('Crítico');
                }
            } else {
                $class = 'text-error';
                $status = $this->translate('Esgotado');
            }
        }

        return array(
            'status' => $status,
            'class' => $class,
        );
    }

}
