<?php

namespace Category\Strategy;

use Zend\Stdlib\Hydrator\Strategy\StrategyInterface;

class Category implements StrategyInterface {

    public function extract($value) {
        if ($value instanceof \Category\Entity\Category) {
            return $value->getCategoryId();
        }
        return $value;
    }

    public function hydrate($value) {
        return $value;
    }
}
