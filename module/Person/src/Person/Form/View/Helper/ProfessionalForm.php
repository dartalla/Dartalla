<?php

namespace Person\Form\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Person\Form\Fieldset\Professional;

class ProfessionalForm extends AbstractHelper {

    public function __invoke(Professional $professional) {

        if (!is_object($professional) || !($professional instanceof Professional)) {
            throw new \Zend\View\Exception\RuntimeException(
            sprintf('%s is not valid instance of Professional fieldset.'));
        }

        return $this->view->render('person/professional', array(
                    'professional' => $professional
        ));
    }

}
