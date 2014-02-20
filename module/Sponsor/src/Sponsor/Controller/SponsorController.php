<?php

namespace Sponsor\Controller;

use Sponsor\Entity\Sponsor as SponsorEntity;
use Sponsor\Form\Sponsor as SponsorForm;
use Zend\Mvc\Controller\AbstractActionController;
use Doctrine\ORM\Tools\Pagination\Paginator as DoctrinePaginator;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
use Zend\Paginator\Paginator;

class SponsorController extends AbstractActionController {

    protected $repository;
    protected $entityManager;

    public function indexAction() {
        $companyId = $this->companyAuth()->getCompanyId();

        $adapter = new DoctrineAdapter(
                new DoctrinePaginator($this->getEntityManager()
                        ->getRepository($this->getRepository())
                        ->createQueryBuilder('c')
                        ->join('c.person', 'p')
                        ->where('c.companyId = ' . $companyId)
                        ->orderBy('p.personName', 'ASC')
        ));

        $paginator = new Paginator($adapter);
        $paginator->setDefaultItemCountPerPage(10);

        $page = $this->params()->fromRoute('page');

        if ($page) {
            $paginator->setCurrentPageNumber($page);
        }

        return array(
            'sponsor' => $paginator
        );
    }

    public function addAction() {
        $em = $this->getEntityManager();
        $customerId = $this->params('id');
        $customer = $em->find('Customer\Entity\Customer', $customerId);
        $personType = $this->params('type', base64_encode(0));
        $form = new SponsorForm($this->getEntityManager());
        if ($customer->getSponsor()) {
            $sponsor = $customer->getSponsor();
        } else {
            $sponsor = new SponsorEntity();
        }
        $sponsor->getPerson()->setPersonType(base64_decode($personType));
        $form->bind($sponsor);
        if ($this->request->isPost()) {
            $post = $this->request->getPost();
            $form->setData($post);
            if ($form->isValid()) {
                $customer->setSponsor($sponsor);
                $em->persist($customer);
                $em->flush();
                return $this->redirect()->toRoute('admin/customer');
            }
        }
        return array(
            'form' => $form,
            'personType' => $personType,
            'customer' => $customer
        );
    }

    public function editAction() {
        $personType = $this->params('type', base64_encode(0));
        $id = (int) $this->getEvent()->getRouteMatch()->getParam('id');
        $em = $this->getEntityManager();
        $item = $em->getRepository($this->getRepository())->findOneBy(array('sponsorId' => $id));
        if (!$item) {
            return $this->redirect()->toRoute('admin/sponsor/add/' . $personType);
        }
        $form = new SponsorForm($this->getEntityManager());
        $form->bind($item);
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $em->persist($item);
                $em->flush();
                return $this->redirect()->toRoute('admin/customer');
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
            return $this->redirect()->toRoute('admin/customer');
        }
        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'Não');
            if ($del == 'Sim') {
                $id = $request->getPost('id');
                $em->remove($em->find($this->getRepository(), $id));
                $em->flush();
            }
            return $this->redirect()->toRoute('admin/customer');
        }
        return array(
            'id' => $id,
            'sponsor' => $em->find($this->getRepository(), $id),
        );
    }

    public function viewAction() {
        $id = (int) $this->getEvent()->getRouteMatch()->getParam('id');
        $em = $this->getEntityManager();
        $item = $em->getRepository($this->getRepository())->findOneBy(array('sponsorId' => $id));
        if (!$item) {
            return $this->redirect()->toRoute('admin/customer');
        }
        return array(
            'id' => $id,
            'sponsor' => $em->find($this->getRepository(), $id),
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
