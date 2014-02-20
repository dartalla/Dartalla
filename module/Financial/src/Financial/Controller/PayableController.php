<?php

namespace Financial\Controller;

use Financial\Entity\Payable as PayableEntity;
use Financial\Form\Payable as PayableForm;
use Zend\Mvc\Controller\AbstractActionController;
use Doctrine\ORM\Tools\Pagination\Paginator as DoctrinePaginator;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
use Zend\Paginator\Paginator;

class PayableController extends AbstractActionController {

    protected $repository;
    protected $entityManager;

    public function indexAction() {
        $companyId = $this->companyAuth()->getCompanyId();

        $adapter = new DoctrineAdapter(
                new DoctrinePaginator($this->getEntityManager()
                        ->getRepository($this->getRepository())
                        ->createQueryBuilder('r')
                        ->join('r.account', 'a')
                        ->where('r.companyId = ' . $companyId)
                        ->orderBy('a.accountExpirationDate', 'ASC')
        ));
        
        $payableTotal = $this->getEntityManager()
                ->getRepository($this->getRepository())
                ->getPayableTotal();
        
        $paginator = new Paginator($adapter);
        $paginator->setDefaultItemCountPerPage(10);
        
        $page = $this->params()->fromRoute('page');
        
        if ($page) {
            $paginator->setCurrentPageNumber($page);
        }
        
        $form = new \Financial\Form\Discharge();
        
        return array(
            'payable' => $paginator,
            'total' => $payableTotal,
            'form' => $form
        );
    }

    public function addAction() {
        $form = new PayableForm($this->getEntityManager(), $this->companyAuth()->getCompanyId());
        $payable = new PayableEntity();
        $form->bind($payable);
        if ($this->request->isPost()) {
            $post = $this->request->getPost();
            $form->setData($post);
            if ($form->isValid()) {
                $em = $this->getEntityManager();
                $em->persist($payable);
                $em->flush();
                return $this->redirect()->toRoute('admin/financial/payable');
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
        $item = $em->getRepository($this->getRepository())->findOneBy(array('payableId' => $id));
        if (!$item) {
            return $this->redirect()->toRoute('admin/financial/payable/add/' . $personType);
        }
        $form = new PayableForm($em, $this->companyAuth()->getCompanyId());
        $form->bind($item);
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $em->persist($item);
                $em->flush();
                return $this->redirect()->toRoute('admin/financial/payable');
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
            return $this->redirect()->toRoute('admin/financial/payable');
        }
        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'Não');
            if ($del == 'Sim') {
                $id = $request->getPost('id');
                $em->remove($em->find($this->getRepository(), $id));
                $em->flush();
            }
            return $this->redirect()->toRoute('admin/financial/payable');
        }
        return array(
            'id' => $id,
            'payable' => $em->find($this->getRepository(), $id),
        );
    }

    public function viewAction() {
        $id = (int) $this->getEvent()->getRouteMatch()->getParam('id');
        $em = $this->getEntityManager();
        $item = $em->getRepository($this->getRepository())->findOneBy(array('payableId' => $id));
        if (!$item) {
            return $this->redirect()->toRoute('admin/financial/payable');
        }
        return array(
            'id' => $id,
            'payable' => $em->find($this->getRepository(), $id),
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
