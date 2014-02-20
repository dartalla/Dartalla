<?php

namespace Financial\Controller;

use Financial\Entity\Receivable as ReceivableEntity;
use Financial\Form\Receivable as ReceivableForm;
use Zend\Mvc\Controller\AbstractActionController;
use Doctrine\ORM\Tools\Pagination\Paginator as DoctrinePaginator;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
use Zend\Paginator\Paginator;
use Financial\Form\Discharge;

class ReceivableController extends AbstractActionController {

    protected $repository;
    protected $entityManager;

    public function indexAction() {
        $companyId = $this->companyAuth()->getCompanyId();

        $adapter = new DoctrineAdapter(
                new DoctrinePaginator($this->getEntityManager()
                        ->getRepository($this->getRepository())
                        ->createQueryBuilder('r')
                        ->where('r.companyId = ' . $companyId)
                        ->join('r.account', 'a')
                        ->orderBy('a.accountExpirationDate', 'ASC')
        ));

        $receivableTotal = $this->getEntityManager()
                ->getRepository($this->getRepository())
                ->getReceivableTotal();

        $paginator = new Paginator($adapter);
        $paginator->setDefaultItemCountPerPage(10);

        $page = $this->params()->fromRoute('page');

        if ($page) {
            $paginator->setCurrentPageNumber($page);
        }

        $form = new Discharge();

        return array(
            'receivable' => $paginator,
            'total' => $receivableTotal,
            'form' => $form,
        );
    }

    public function addAction() {
        $form = new ReceivableForm($this->getEntityManager(), $this->companyAuth()->getCompanyId());
        $receivable = new ReceivableEntity();
        $form->bind($receivable);
        if ($this->request->isPost()) {
            $post = $this->request->getPost();
            $form->setData($post);
            if ($form->isValid()) {
                $em = $this->getEntityManager();
                $em->persist($receivable);
                $em->flush();
                return $this->redirect()->toRoute('admin/financial/receivable');
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
        $item = $em->getRepository($this->getRepository())->findOneBy(array('receivableId' => $id));
        if (!$item) {
            return $this->redirect()->toRoute('admin/financial/receivable/add/' . $personType);
        }
        $form = new ReceivableForm($em, $this->companyAuth()->getCompanyId());
        $form->bind($item);
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $em->persist($item);
                $em->flush();
                return $this->redirect()->toRoute('admin/financial/receivable');
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
            return $this->redirect()->toRoute('admin/financial/receivable');
        }
        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'Não');
            if ($del == 'Sim') {
                $id = $request->getPost('id');
                $em->remove($em->find($this->getRepository(), $id));
                $em->flush();
            }
            return $this->redirect()->toRoute('admin/financial/receivable');
        }
        return array(
            'id' => $id,
            'receivable' => $em->find($this->getRepository(), $id),
        );
    }

    public function viewAction() {
        $id = (int) $this->getEvent()->getRouteMatch()->getParam('id');
        $em = $this->getEntityManager();
        $item = $em->getRepository($this->getRepository())->findOneBy(array('receivableId' => $id));
        if (!$item) {
            return $this->redirect()->toRoute('admin/financial/receivable');
        }
        return array(
            'id' => $id,
            'receivable' => $em->find($this->getRepository(), $id),
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
