<?php

namespace Financial\Controller;

use Financial\Entity\Revenue as RevenueEntity;
use Financial\Form\Revenue as RevenueForm;
use Zend\Mvc\Controller\AbstractActionController;
use Doctrine\ORM\Tools\Pagination\Paginator as DoctrinePaginator;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
use Zend\Paginator\Paginator;

class RevenueController extends AbstractActionController {

    /**
     * @var Doctrine\ORM\EntityManager
     */
    protected $entityManager;
    
    /**
     * @var Financial\Service\Revenue
     */
    protected $service;

    public function indexAction() {
        $companyId = $this->companyAuth()->getCompanyId();
        $adapter = new DoctrineAdapter(
            new DoctrinePaginator($this->getService()->getPaginationResult($companyId))
        );
        $paginator = new Paginator($adapter);
        $paginator->setDefaultItemCountPerPage(10);
        $page = $this->params()->fromRoute('page');
        if ($page) {
            $paginator->setCurrentPageNumber($page);
        }
        $revenueTotal = $this->getService()->getRevenueTotal($companyId);
        return array(
            'revenue' => $paginator,
            'total' => $revenueTotal,
        );
    }

    public function addAction() {
        $form = new RevenueForm($this->getEntityManager(), $this->companyAuth()->getCompanyId());
        $revenue = new RevenueEntity();
        $form->bind($revenue);
        if ($this->request->isPost()) {
            $post = $this->request->getPost();
            $form->setData($post);
            if ($form->isValid()) {
                $em = $this->getEntityManager();
                $em->persist($revenue);
                $em->flush();
                return $this->redirect()->toRoute('admin/financial/cash');
            }
        }
        return array(
            'form' => $form,
        );
    }

    public function editAction() {
        $id = (int) $this->getEvent()->getRouteMatch()->getParam('id');
        $em = $this->getEntityManager();
        $item = $this->getService()->findOneBy(array('revenueId' => $id));
        if (!$item) {
            return $this->redirect()->toRoute('admin/financial/revenue/add/');
        }
        $form = new RevenueForm($this->getEntityManager(), $this->companyAuth()->getCompanyId());
        $form->bind($item);
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $em->persist($item);
                $em->flush();
                return $this->redirect()->toRoute('admin/financial/revenue');
            }
        }
        return array(
            'id' => $id,
            'form' => $form,
        );
    }

    public function deleteAction() {
        if ($this->getRequest()->isXmlHttpRequest()) {
            $this->layout('layout/blank');
        }
        $em = $this->getEntityManager();
        $id = $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('admin/financial/revenue');
        }
        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'Não');
            if ($del == 'Sim') {
                $id = $request->getPost('id');
                $em->remove($this->getService()->find($id));
                $em->flush();
            }
            return $this->redirect()->toRoute('admin/financial/revenue');
        }
        return array(
            'id' => $id,
            'revenue' => $this->getService()->find($id),
        );
    }

    public function viewAction() {
        $id = (int) $this->getEvent()->getRouteMatch()->getParam('id');
        $em = $this->getEntityManager();
        $item = $this->getService()->findOneBy(array('revenueId' => $id));
        if (!$item) {
            return $this->redirect()->toRoute('admin/financial/revenue');
        }
        return array(
            'id' => $id,
            'revenue' => $em->find($this->getRepository(), $id),
        );
    }

    public function getEntityManager() {
        return $this->entityManager;
    }

    public function setEntityManager($entityManager) {
        $this->entityManager = $entityManager;
    }

    public function getService() {
        return $this->service;
    }

    public function setService($service) {
        $this->service = $service;
        return $this;
    }
}
