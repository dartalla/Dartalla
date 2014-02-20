<?php

namespace Employee\Controller;

use Employee\Entity\Employee as EmployeeEntity;
use Employee\Form\Employee as EmployeeForm;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Doctrine\ORM\Tools\Pagination\Paginator as DoctrinePaginator;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
use Zend\Paginator\Paginator;
use Zend\Crypt\Password\Bcrypt;

class EmployeeController extends AbstractActionController {

    protected $repository;
    protected $entityManager;

    public function indexAction() {
        $adapter = new DoctrineAdapter(
                new DoctrinePaginator($this->getEntityManager()
                        ->getRepository($this->getRepository())
                        ->createQueryBuilder('e')
                        ->where('e.employeeActive = TRUE')
                        ->where('e.companyId = ' . $this->companyAuth()->getCompanyId())
        ));

        $paginator = new Paginator($adapter);
        $paginator->setDefaultItemCountPerPage(10);

        $page = $this->params()->fromRoute('page');

        if ($page) {
            $paginator->setCurrentPageNumber($page);
        }

        return array(
            'employee' => $paginator
        );
    }

    public function addAction() {
        $form = new EmployeeForm($this->getEntityManager());
        $employee = new EmployeeEntity();
        $form->bind($employee);
        if ($this->request->isPost()) {
            $post = $this->request->getPost();
            $form->setData($post);
            if ($form->isValid()) {
                $em = $this->getEntityManager();
                $user = $form->getData()->getUser();
                $user->setState(1);
                $user->setDisplayName($form->getData()->getPerson()->getPersonName());

                $bcrypt = new Bcrypt;
                $bcrypt->setCost(14);
                $user->setPassword($bcrypt->create($user->getPassword()));

                $em->persist($user);
                $employee->setUser($user);
                $em->persist($employee);
                $em->flush();
                return $this->redirect()->toRoute('admin/employee');
            }
        }
        return new ViewModel(array(
            'form' => $form
        ));
    }

    public function editAction() {
        $id = (int) $this->getEvent()->getRouteMatch()->getParam('id');
        $em = $this->getEntityManager();
        $item = $em->getRepository($this->getRepository())->findOneBy(array('employeeId' => $id));
        if (!$item) {
            return $this->redirect()->toRoute('admin/employee/add');
        }
        $form = new EmployeeForm($this->getEntityManager());
        $form->bind($item);
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $em->persist($item);
                $em->flush();
                return $this->redirect()->toRoute('admin/employee');
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
            return $this->redirect()->toRoute('admin/employee');
        }
        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'Não');
            if ($del == 'Sim') {
                $id = $request->getPost('id');
                $em->remove($em->find($this->getRepository(), $id));
                $em->flush();
            }
            return $this->redirect()->toRoute('admin/employee');
        }
        return array(
            'id' => $id,
            'employee' => $em->find($this->getRepository(), $id),
        );
    }

    public function viewAction() {
        $id = (int) $this->getEvent()->getRouteMatch()->getParam('id');
        $em = $this->getEntityManager();
        $item = $em->getRepository($this->getRepository())->findOneBy(array('employeeId' => $id));
        if (!$item) {
            return $this->redirect()->toRoute('admin/employee');
        }
        return array(
            'id' => $id,
            'employee' => $em->find($this->getRepository(), $id),
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
