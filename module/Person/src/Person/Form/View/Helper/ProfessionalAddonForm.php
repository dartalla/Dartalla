<?php

namespace Person\Form\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Person\Form\Fieldset\ProfessionalAddon;

class ProfessionalAddonForm extends AbstractHelper {

    public function __invoke(ProfessionalAddon $professionalAddonForm) {

        if (!is_object($professionalAddonForm) || !($professionalAddonForm instanceof ProfessionalAddon)) {
            throw new \Zend\View\Exception\RuntimeException(
                    sprintf('%s is not valid instance of ProfessionalAddon fieldset.'));
        }
        
        return $this->view->render('person/professional-addon', array(
            'professionalAddonForm' => $professionalAddonForm
        ));
    }

}
