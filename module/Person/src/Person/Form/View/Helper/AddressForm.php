<?php

namespace Person\Form\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Person\Form\Fieldset\Address;

class AddressForm extends AbstractHelper {

    public function __invoke(Address $address) {

        if (!is_object($address) || !($address instanceof Address)) {
            throw new \Zend\View\Exception\RuntimeException(
                    sprintf('%s is not valid instance of Address fieldset.'));
        }
        
        return $this->view->render('person/address', array(
            'address' => $address
        ));
    }
}
