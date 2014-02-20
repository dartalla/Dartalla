<?php

namespace Business\Controller;

use Business\Entity\ServiceOrder as ServiceOrderEntity;
use Business\Form\ServiceOrder as ServiceOrderForm;
use Zend\Mvc\Controller\AbstractActionController;
use Doctrine\ORM\Tools\Pagination\Paginator as DoctrinePaginator;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
use Zend\Paginator\Paginator;

class ServiceOrderController extends AbstractActionController {

    protected $repository;
    protected $entityManager;

    public function indexAction() {
        $companyId = $this->companyAuth()->getCompanyId();

        $adapter = new DoctrineAdapter(
                new DoctrinePaginator($this->getEntityManager()
                        ->getRepository($this->getRepository())
                        ->createQueryBuilder('r')
                        ->where('r.companyId = ' . $companyId)
        ));
        
        $serviceOrderTotal = $this->getEntityManager()
                ->getRepository($this->getRepository())
                ->getServiceOrderTotal();
        
        $paginator = new Paginator($adapter);
        $paginator->setDefaultItemCountPerPage(10);
        
        $page = $this->params()->fromRoute('page');
        
        if ($page) {
            $paginator->setCurrentPageNumber($page);
        }
        
        return array(
            'service-order' => $paginator,
            'total' => $serviceOrderTotal,
        );
    }

    public function addAction() {
        $form = new ServiceOrderForm($this->getEntityManager(), $this->companyAuth()->getCompanyId());
        $serviceOrder = new ServiceOrderEntity();
        $form->bind($serviceOrder);
        if ($this->request->isPost()) {
            $post = $this->request->getPost();
            $form->setData($post);
            if ($form->isValid()) {
                $em = $this->getEntityManager();
                $em->persist($serviceOrder);
                $em->flush();
                return $this->redirect()->toRoute('admin/financial/service-order');
            }
        }
        return array(
            'form' => $form,
        );
    }

    public function editAction() {
        $personType = $this->params('type', base64_encode(0));
        $id = (int) $this->getEvent()->getRouteMatch()->getParam('id');
        $em = $this->getEntityManager();
        $item = $em->getRepository($this->getRepository())->findOneBy(array('service-orderId' => $id));
        if (!$item) {
            return $this->redirect()->toRoute('admin/financial/service-order/add/' . $personType);
        }
        $form = new ServiceOrderForm($em, $this->companyAuth()->getCompanyId());
        $form->bind($item);
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $em->persist($item);
                $em->flush();
                return $this->redirect()->toRoute('admin/financial/service-order');
            }
        }
        return array(
            'id' => $id,
            'form' => $form,
            'personType' => $personType
        );
    }

    public function deleteAction() {
        if ($this->getRequest()->isXmlHttpRequest()) {
            $this->layout('layout/blank');
        }
        $em = $this->getEntityManager();
        $id = $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('admin/financial/service-order');
        }
        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'Não');
            if ($del == 'Sim') {
                $id = $request->getPost('id');
                $em->remove($em->find($this->getRepository(), $id));
                $em->flush();
            }
            return $this->redirect()->toRoute('admin/financial/service-order');
        }
        return array(
            'id' => $id,
            'service-order' => $em->find($this->getRepository(), $id),
        );
    }

    public function viewAction() {
        $id = (int) $this->getEvent()->getRouteMatch()->getParam('id');
        $em = $this->getEntityManager();
        $item = $em->getRepository($this->getRepository())->findOneBy(array('service-orderId' => $id));
        if (!$item) {
            return $this->redirect()->toRoute('admin/financial/service-order');
        }
        return array(
            'id' => $id,
            'service-order' => $em->find($this->getRepository(), $id),
        );
    }

    public function getRepository() {
        return $this->repository;
    }

    public function setRepository($repository) {
        $this->repository = $repository;
    }

    public function getEntityManager() {
        return $this->entityManager;
    }

    public function setEntityManager($entityManager) {
        $this->entityManager = $entityManager;
    }
}
