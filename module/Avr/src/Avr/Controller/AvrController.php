<?php

namespace Avr\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Json\Json;

class AvrController extends AbstractActionController {

    public function indexAction() {
        return array();
    }

    public function priceAction() {
        $cost = $this->params()->fromQuery('cost');
        $markup = $this->params()->fromQuery('markup');
        if (is_numeric($cost) && is_numeric($markup)) {
            $porcent = ($cost * $markup) / 100;
            $total = $porcent + $cost;
        }
        $price = number_format($total, 2, ',', '.');
        return $this->getResponse()->setContent(Json::encode(array('price' => $price)));
    }

}
