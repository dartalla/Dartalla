<?php

namespace CustomerSponsor\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use CustomerSponsor\Form\CustomerSponsor as CustomerSponsorForm;
use Sponsor\Entity\Sponsor as SponsorEntity;
use Doctrine\ORM\EntityManager;
use Zend\Json\Json;

class CustomerSponsorController extends AbstractActionController {

    /**
     * @var CustomerSponsor\Entity\CustomerSponsorEntity
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
        $id = $this->params('id');
        $em = $this->getEntityManager();
        $personType = $this->params('type', base64_encode(0));
        $form = new CustomerSponsorForm($this->getEntityManager(), $id);
        $customer = $em->find('Customer\Entity\Customer', $id);
        $customer->getPerson()->setPersonType(base64_decode($personType));
        $sponsor = new SponsorEntity();
        $form->bind($sponsor);
        if ($this->request->isPost()) {
            $post = $this->request->getPost();
            $form->setData($post);
            if ($form->isValid()) {
                $em->persist($customer);
                $em->flush();
                return $this->redirect()->toRoute('admin/customer');
            }
        }
        return array(
            'form' => $form,
            'personType' => $personType,
            'customerId' => $id,
        );
    }

    public function listAction() {
        $customer_id = $this->params()->fromRoute('id');
        $em = $this->getEntityManager();
        $customer = $em->find('Customer\Entity\Customer', $customer_id);
        return array(
            'customerId' => $customer_id,
            'customerSponsor' => $customer->getCustomerSponsor(),
        );
    }

    public function postAction() {
        $em = $this->getEntityManager();
        $filter = new \Zend\Filter\Digits();
        $customer_id = $this->params()->fromQuery('customer_id');
        $sponsor_type = $this->params()->fromQuery('sponsor_type');
        $sponsor_name = $this->params()->fromQuery('sponsor_name');
        $sponsor_phone = $this->params()->fromQuery('sponsor_phone');
        
        $sponsor = new SponsorEntity();
        $sponsor->setSponsorType($sponsor_type);
        $sponsor->setSponsorName($sponsor_name);
        $sponsor->setSponsorPhone($filter->filter($sponsor_phone));
        
        $customer = $em->find('Customer\Entity\Customer', $customer_id);
        $customer->addCustomerSponsor($sponsor);

        $em->persist($customer);
        $em->flush();
        return $this->getResponse()->setContent(Json::encode(array('result' => true)));
    }

    public function deleteAction() {
        $em = $this->getEntityManager();
        $id = $this->params()->fromQuery('sponsor_id', 0);
        $sponsor = $em->find($this->getRepository(), $id);
        $em->remove($sponsor);
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
