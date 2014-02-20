<?php

namespace Customer\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Customer\Form\CustomerReference as CustomerReferenceForm;
use Reference\Entity\Reference as ReferenceEntity;
use Doctrine\ORM\EntityManager;
use Zend\Json\Json;

class CustomerReferenceController extends AbstractActionController {

    /**
     * @var CustomerReference\Entity\CustomerReferenceEntity
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
        $form = new CustomerReferenceForm($this->getEntityManager(), $id);
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
            'customerReference' => $customer->getCustomerReference(),
        );
    }

    public function postAction() {
        $em = $this->getEntityManager();
        $filter = new \Zend\Filter\Digits();
        $customer_id = $this->params()->fromQuery('customer_id');
        $reference_type = $this->params()->fromQuery('reference_type');
        $reference_name = $this->params()->fromQuery('reference_name');
        $reference_phone = $this->params()->fromQuery('reference_phone');
        
        $reference = new ReferenceEntity();
        $reference->setReferenceType($reference_type);
        $reference->setReferenceName($reference_name);
        $reference->setReferencePhone($filter->filter($reference_phone));
        
        $customer = $em->find('Customer\Entity\Customer', $customer_id);
        $customer->addCustomerReference($reference);

        $em->persist($customer);
        $em->flush();
        return $this->getResponse()->setContent(Json::encode(array('result' => true)));
    }

    public function deleteAction() {
        $em = $this->getEntityManager();
        $id = $this->params()->fromQuery('reference_id', 0);
        $reference = $em->find($this->getRepository(), $id);
        $em->remove($reference);
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
