<?php

namespace Unit\Strategy;

use Zend\Stdlib\Hydrator\Strategy\StrategyInterface;

class Unit implements StrategyInterface {

    public function extract($value) {
        if ($value instanceof \Unit\Entity\Unit) {
            return $value->getUnitId();
        }
        return $value;
    }

    public function hydrate($value) {
        return $value;
    }
}
