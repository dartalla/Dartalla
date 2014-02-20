<?php

namespace BankAccount\Form\View\Helper;

use Zend\View\Helper\AbstractHelper;
use BankAccount\Form\Fieldset\BankAccount;

class BankAccountForm extends AbstractHelper {

    public function __invoke(BankAccount $bankAccount) {

        if (!is_object($bankAccount) || !($bankAccount instanceof BankAccount)) {
            throw new \Zend\View\Exception\RuntimeException(
                    sprintf('%s is not valid instance of BankAccount fieldset.'));
        }
        
        return $this->view->render('bank-account/bank-account', array(
            'bankAccount' => $bankAccount
        ));
    }

}
