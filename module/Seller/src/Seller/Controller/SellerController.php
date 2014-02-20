<?php

namespace Seller\Controller;

use Seller\Entity\Seller as SellerEntity;
use Seller\Form\Seller as SellerForm;
use Zend\Mvc\Controller\AbstractActionController;

class SellerController extends AbstractActionController {

    protected $repository;
    protected $entityManager;

    public function indexAction() {
        $this->redirect()->toRoute('admin/shopman');
    }

    public function addAction() {
        $personType = $this->params('type', base64_encode(0));
        $shopmanId = $this->params('id', 1);
        $form = new SellerForm($this->getEntityManager());
        $seller = new SellerEntity();
        $seller->getPerson()->setPersonType(base64_decode($personType));
        $form->bind($seller);
        $em = $this->getEntityManager();
        $shopman = $em->find('Shopman\Entity\Shopman', $shopmanId);
        if ($this->request->isPost()) {
            $post = $this->request->getPost();
            $form->setData($post);
            if ($form->isValid()) {
                $shopman->addShopmanSeller($seller);
                $em->persist($shopman);
                $em->flush();
                return $this->redirect()->toRoute('admin/shopman');
            }
        }
        return array(
            'form' => $form,
            'personType' => $personType,
            'shopmanId' => $shopmanId,
            'shopmanSeller' => $shopman->getShopmanSeller(),
        );
    }

    public function editAction() {
        $personType = $this->params('type', base64_encode(0));
        $shopmanId = $this->params('id', 1);
        $id = (int) $this->getEvent()->getRouteMatch()->getParam('id');
        $em = $this->getEntityManager();
        $item = $em->getRepository($this->getRepository())->findOneBy(array('sellerId' => $id));
        if (!$item) {
            return $this->redirect()->toRoute('admin/seller/add/' . $personType);
        }
        $form = new SellerForm($this->getEntityManager());
        $form->bind($item);
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $em->persist($item);
                $em->flush();
                return $this->redirect()->toRoute('admin/shopman');
            }
        }
        return array(
            'id' => $id,
            'form' => $form,
            'personType' => $personType,
            'shopmanId' => $shopmanId,
        );
    }

    public function deleteAction() {
        if ($this->getRequest()->isXmlHttpRequest()) {
            $this->layout('layout/blank');
        }
        $em = $this->getEntityManager();
        $id = $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('admin/shopman');
        }
        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'Não');
            if ($del == 'Sim') {
                $id = $request->getPost('id');
                $em->remove($em->find($this->getRepository(), $id));
                $em->flush();
            }
            return $this->redirect()->toRoute('admin/shopman');
        }
        return array(
            'id' => $id,
            'seller' => $em->find($this->getRepository(), $id),
        );
    }

    public function viewAction() {
        $id = (int) $this->getEvent()->getRouteMatch()->getParam('id');
        $em = $this->getEntityManager();
        $item = $em->getRepository($this->getRepository())->findOneBy(array('sellerId' => $id));
        if (!$item) {
            return $this->redirect()->toRoute('admin/shopman');
        }
        return array(
            'id' => $id,
            'seller' => $em->find($this->getRepository(), $id),
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
