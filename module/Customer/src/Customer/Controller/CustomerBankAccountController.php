<?php

namespace Customer\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Customer\Form\CustomerBankAccount as CustomerBankAccountForm;
use BankAccount\Entity\BankAccount as BankAccountEntity;
use Doctrine\ORM\EntityManager;
use Zend\Json\Json;

class CustomerBankAccountController extends AbstractActionController {

    /**
     * @var CustomerBankAccount\Entity\CustomerBankAccountEntity
     */
    protected $repository;

    /**
     * @
     * @var Doctrine\ORM\EntityManager
     */
    protected $entityManager;

    public function indexAction() {
        $this->redirect()->toRoute('admin/customer');
    }

    public function addAction() {
        $id = $this->params()->fromRoute('id');
        $form = new CustomerBankAccountForm($this->getEntityManager(), $id);
        return array(
            'form' => $form,
            'customerId' => $id,
        );
    }

    public function listAction() {
        $customer_id = $this->params()->fromRoute('id');
        $em = $this->getEntityManager();
        $customer = $em->find('Customer\Entity\Customer', $customer_id);
        return array(
            'customerId' => $customer_id,
            'customerBankAccount' => $customer->getCustomerBankAccount(),
        );
    }

    public function postAction() {
        $em = $this->getEntityManager();
        $filter = new \Avr\Filter\Date();
        $customer_id = $this->params()->fromQuery('customer_id');
        $bank_account_type = $this->params()->fromQuery('bank_account_type');
        $bank_account_bank = $this->params()->fromQuery('bank_account_bank');
        $bank_account_agency = $this->params()->fromQuery('bank_account_agency');
        $bank_account_account = $this->params()->fromQuery('bank_account_account');
        $bank_account_since = $this->params()->fromQuery('bank_account_since');
        
        $bankAccount = new BankAccountEntity();
        $bankAccount->setBankAccountType($bank_account_type);
        $bankAccount->setBankAccountBank($bank_account_bank);
        $bankAccount->setBankAccountAgency($bank_account_agency);
        $bankAccount->setBankAccountAccount($bank_account_account);
        $bankAccount->setBankAccountSince($filter->filter($bank_account_since));
        
        $customer = $em->find('Customer\Entity\Customer', $customer_id);
        $customer->addCustomerBankAccount($bankAccount);
        
        $em->persist($customer);
        $em->flush();
        return $this->getResponse()->setContent(Json::encode(array('result' => true)));
    }

    public function deleteAction() {
        $em = $this->getEntityManager();
        $id = $this->params()->fromQuery('bank_account_id', 0);
        $em->remove($em->find('BankAccount\Entity\BankAccount', $id));
        $em->flush();
        return $this->getResponse()->setContent(Json::encode(array('result' => true)));
    }

    /**
     * @return the $entityManager
     */
    public function getEntityManager() {
        return $this->entityManager;
    }

    /**
     * @param field_type $entityManager
     */
    public function setEntityManager(EntityManager $entityManager) {
        $this->entityManager = $entityManager;
    }

    /**
     * @return the $repository
     */
    public function getRepository() {
        return $this->repository;
    }

    /**
     * @param field_type $repository
     */
    public function setRepository($repository) {
        $this->repository = $repository;
    }

}
