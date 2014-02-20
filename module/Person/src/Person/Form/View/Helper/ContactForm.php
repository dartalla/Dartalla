<?php

namespace Person\Form\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Person\Form\Fieldset\Contact;

class ContactForm extends AbstractHelper {

    public function __invoke(Contact $contact) {

        if (!is_object($contact) || !($contact instanceof Contact)) {
            throw new \Zend\View\Exception\RuntimeException(
            sprintf('%s is not valid instance of Contact fieldset.'));
        }

        return $this->view->render('person/contact', array(
                    'contact' => $contact
        ));
    }

}
