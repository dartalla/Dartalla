<?php

namespace Person\Form\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Person\Form\Fieldset\Individual;

class IndividualForm extends AbstractHelper {

    public function __invoke(Individual $individual) {

        if (!is_object($individual) || !($individual instanceof Individual)) {
            throw new \Zend\View\Exception\RuntimeException(
            sprintf('%s is not valid instance of Individual fieldset.'));
        }

        return $this->view->render('person/individual', array(
                    'individual' => $individual
        ));
    }

}
