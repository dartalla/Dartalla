<?php

namespace Customer\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Customer\Form\CustomerPatrimony as CustomerPatrimonyForm;
use Patrimony\Entity\Patrimony as PatrimonyEntity;
use Doctrine\ORM\EntityManager;
use Zend\Json\Json;

class CustomerPatrimonyController extends AbstractActionController {

    /**
     * @var CustomerPatrimony\Entity\CustomerPatrimonyEntity
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
        $form = new CustomerPatrimonyForm($this->getEntityManager(), $id);
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
            'customerPatrimony' => $customer->getCustomerPatrimony(),
        );
    }

    public function postAction() {
        $em = $this->getEntityManager();
        $currency_filter = new \Zend\I18n\Filter\NumberFormat();
        $customer_id = $this->params()->fromQuery('customer_id');
        $patrimony_name = $this->params()->fromQuery('patrimony_name');
        $patrimony_value = $currency_filter->filter($this->params()->fromQuery('patrimony_value'));
        
        $patrimony = new PatrimonyEntity();
        $patrimony->setPatrimonyName($patrimony_name);
        $patrimony->setPatrimonyValue($patrimony_value);
        
        $customer = $em->find('Customer\Entity\Customer', $customer_id);
        $customer->addCustomerPatrimony($patrimony);
        
        $em->persist($customer);
        $em->flush();
        return $this->getResponse()->setContent(Json::encode(array('result' => true)));
    }

    public function deleteAction() {
        $em = $this->getEntityManager();
        $id = $this->params()->fromQuery('patrimony_id', 0);
        $patrimony = $em->find('Patrimony\Entity\Patrimony', $id);
        $em->remove($patrimony);
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
