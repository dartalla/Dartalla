<?php

namespace CustomerVehicle\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use CustomerVehicle\Form\CustomerVehicle as CustomerVehicleForm;
use Vehicle\Entity\Vehicle as VehicleEntity;
use Doctrine\ORM\EntityManager;
use Zend\Json\Json;

class CustomerVehicleController extends AbstractActionController {

    /**
     * @var CustomerVehicle\Entity\CustomerVehicleEntity
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
        $form = new CustomerVehicleForm($this->getEntityManager(), $id);
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
            'customerVehicle' => $customer->getCustomerVehicle(),
        );
    }

    public function postAction() {
        $em = $this->getEntityManager();
        $customerId = $this->params()->fromQuery('customerId');
        $currencyFilter = new \Zend\I18n\Filter\NumberFormat();
        $hydrator = new \DoctrineModule\Stdlib\Hydrator\DoctrineObject($em);
        
        $data = $this->params()->fromQuery();
        $data['vehicleValue'] = $currencyFilter->filter($data['vehicleValue']);
        $data['vehicleBrandId'] = $em->find('Vehicle\Entity\VehicleBrand', $data['vehicleBrandId']);
        $data['vehicleTypeId'] = $em->find('Vehicle\Entity\VehicleType', $data['vehicleTypeId']);
        $data['vehicleModelId'] = $em->find('Vehicle\Entity\VehicleModel', $data['vehicleModelId']);
        $data['vehicleVersionId'] = $em->find('Vehicle\Entity\VehicleVersion', $data['vehicleVersionId']);
        
        $vehicle = new VehicleEntity();
        $hydrator->hydrate($data, $vehicle);
        
        $customer = $em->find('Customer\Entity\Customer', $customerId);
        $customer->addCustomerVehicle($vehicle);
        
        $em->persist($customer);
        $em->flush();
        return $this->getResponse()->setContent(Json::encode(array('result' => true)));
    }

    public function deleteAction() {
        $em = $this->getEntityManager();
        $id = $this->params()->fromQuery('vehicleId', 0);
        $vehicle = $em->find('Vehicle\Entity\Vehicle', $id);
        $em->remove($vehicle);
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
