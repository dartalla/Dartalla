<?php

namespace AccountingItem\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use AccountingItem\Form\AccountingItem as AccountingItemForm;
use AccountingItem\Entity\AccountingItem as AccountingItemEntity;
use Doctrine\ORM\EntityManager;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
use Doctrine\ORM\Tools\Pagination\Paginator as DoctrinePaginator;
use Zend\Paginator\Paginator;

class AccountingItemController extends AbstractActionController {

    /**
     * @var AccountingItem\Entity\AccountingItemEntity
     */
    protected $repository;

    /**
     * @var Doctrine\ORM\EntityManager
     */
    protected $entityManager;
    
    protected $companyId;

    public function indexAction() {
        
        $adapter = new DoctrineAdapter(
                new DoctrinePaginator($this->getEntityManager()
                        ->getRepository($this->getRepository())
                        ->createQueryBuilder('ai')
                        ->where('ai.companyId = ' . $this->getCompanyId())
                        ->orderBy('ai.accountingItemName', 'ASC')
        ));
        
        $paginator = new Paginator($adapter);
        $paginator->setDefaultItemCountPerPage(10);
        
        $page = $this->params()->fromRoute('page', 0);
        
        if ($page) {
            $paginator->setCurrentPageNumber($page);
        }
        
        return array(
            'accountingItem' => $paginator
        );
    }

    public function addAction() {
        $form = new AccountingItemForm($this->getEntityManager());
        $accountingItem = new AccountingItemEntity();
        $form->bind($accountingItem);
        if ($this->request->isPost()) {
            $post = $this->request->getPost();
            $form->setData($post);
            if ($form->isValid()) {
                $em = $this->getEntityManager();
                $em->persist($accountingItem);
                $em->flush();
                return $this->redirect()->toRoute('admin/accounting-item');
            }
        }
        return array(
            'form' => $form
        );
    }

    public function editAction() {
        $id = (int) $this->getEvent()->getRouteMatch()->getParam('id');
        $em = $this->getEntityManager();
        $item = $em->getRepository($this->getRepository())->findOneBy(array('accountingItemId' => $id));
        if (!$item) {
            return $this->redirect()->toRoute('admin/accounting-item/add');
        }
        $form = new AccountingItemForm($this->getEntityManager());
        $form->bind($item);
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $em->persist($item);
                $em->flush();
                return $this->redirect()->toRoute('admin/accounting-item');
            }
        }
        return array(
            'id' => $id,
            'form' => $form,
        );
    }

    public function deleteAction() {
        $em = $this->getEntityManager();
        $id = $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('admin/accounting-item');
        }
        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'Não');
            if ($del == 'Sim') {
                $id = $request->getPost('id');
                $em->remove($em->find($this->getRepository(), $id));
                $em->flush();
            }
            return $this->redirect()->toRoute('admin/accounting-item');
        }
        return array(
            'id' => $id,
            'accountingItem' => $em->find($this->getRepository(), $id),
        );
    }

    public function viewAction() {
        
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
    
    public function getCompanyId() {
        if (!isset($this->companyId)) {
            $this->setCompanyId($this->companyAuth()->getCompanyId());
        }
        return $this->companyId;
    }

    public function setCompanyId($companyId) {
        $this->companyId = $companyId;
        return $this;
    }
}
