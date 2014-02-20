<?php

namespace Company\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Doctrine\ORM\EntityManager;
use Company\Entity\Company as CompanyEntity;
use Company\Form\Company as CompanyForm;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
use Doctrine\ORM\Tools\Pagination\Paginator as DoctrinePaginator;
use Zend\Paginator\Paginator;
use Zend\Crypt\Password\Bcrypt;

class CompanyController extends AbstractActionController {

    /**
     * @var Company\Entity\CompanyEntity
     */
    protected $repository;

    /**
     * @var Doctrine\ORM\EntityManager
     */
    protected $entityManager;

    public function indexAction() {

        $company_id = $this->companyAuth()->getCompanyId();
        
        $adapter = new DoctrineAdapter(
                new DoctrinePaginator(
                $this->getEntityManager()
                        ->getRepository($this->getRepository())
                        ->createQueryBuilder('c')
                        ->where('c.companyIsActive = TRUE')
                        ->andWhere('c.companySelf = ' . $company_id)));

        $paginator = new Paginator($adapter);
        $paginator->setDefaultItemCountPerPage(10);

        $page = $this->params()->fromRoute('page');

        if ($page) {
            $paginator->setCurrentPageNumber($page);
        }

        return array(
            'company' => $paginator
        );
    }

    public function addAction() {
        $form = new CompanyForm($this->getEntityManager());
        $company = new CompanyEntity();
        $form->bind($company);
        if ($this->request->isPost()) {
            $post = $this->request->getPost();
            $form->setData($post);
            if ($form->isValid()) {
                $em = $this->getEntityManager();
                $user = $form->getData()->getUser();
                $user->setState(1);
                $user->setDisplayName($form->getData()->getCompanyFancyName());

                $bcrypt = new Bcrypt;
                $bcrypt->setCost(14);
                $user->setPassword($bcrypt->create($user->getPassword()));

                $em->persist($user);
                $company->setUser($user);

                $em->persist($company);
                $em->flush();
                return $this->redirect()->toRoute('admin/company');
            }
            \Zend\Debug\Debug::dump($form->getMessages());
        }
        return array(
            'form' => $form
        );
    }

    public function editAction() {
        $id = (int) $this->getEvent()->getRouteMatch()->getParam('id');
        $em = $this->getEntityManager();
        $item = $em->getRepository($this->getRepository())->findOneBy(array('companyId' => $id));
        if (!$item) {
            return $this->redirect()->toRoute('admin/company/add');
        }
        $form = new CompanyForm($em);
        $form->bind($item);
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $em->persist($item);
                $em->flush();
                return $this->redirect()->toRoute('admin/company');
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
            return $this->redirect()->toRoute('admin/company');
        }
        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'Não');
            if ($del == 'Sim') {
                $id = $request->getPost('id');
                $company = $em->find($this->getRepository(), $id);
                $company->setCompanyIsActive(false);
                $em->persist($company);
                $em->flush();
            }
            return $this->redirect()->toRoute('admin/company');
        }
        return array(
            'company_id' => $id,
            'company' => $em->find($this->getRepository(), $id),
        );
    }

    public function viewAction() {
        $id = (int) $this->getEvent()->getRouteMatch()->getParam('id');
        $em = $this->getEntityManager();
        $item = $em->getRepository($this->getRepository())->findOneBy(array('companyId' => $id));
        if (!$item) {
            return $this->redirect()->toRoute('admin/company');
        }
        return array(
            'id' => $id,
            'company' => $em->find($this->getRepository(), $id),
        );
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
