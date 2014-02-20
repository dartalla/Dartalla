<?php

namespace Business\Controller;

use Business\Entity\Sale as SaleEntity;
use Business\Form\Sale as SaleForm;
use Zend\Mvc\Controller\AbstractActionController;
use Doctrine\ORM\Tools\Pagination\Paginator as DoctrinePaginator;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
use Zend\Paginator\Paginator;
use Zend\Session\Container;

class Sale extends AbstractActionController {

    protected $repository;
    protected $entityManager;
    protected $saleSession;

    public function indexAction() {
        $this->getSaleSession()->offsetUnset('products');
        $companyId = $this->companyAuth()->getCompanyId();
        $adapter = new DoctrineAdapter(
                        new DoctrinePaginator($this->getEntityManager()
                                        ->getRepository($this->getRepository())
                                        ->createQueryBuilder('s')
                                        ->join('s.order', 'o')
                                        ->where("o.companyId = {$companyId}")
                                        ->orderBy('o.orderDate', 'DESC')
                ));
        $paginator = new Paginator($adapter);
        $paginator->setDefaultItemCountPerPage(10);
        $page = $this->params()->fromRoute('page');
        if ($page) {
            $paginator->setCurrentPageNumber($page);
        }
        return array(
            'sale' => $paginator,
        );
    }

    public function addAction() {
        if (!$this->getSaleSession()->products) {
            $this->getSaleSession()->products = array();
        }
        $form = new SaleForm($this->getEntityManager(), $this->companyAuth()->getCompanyId());
        $sale = new SaleEntity();
        $form->bind($sale);
        if ($this->request->isPost()) {
            $post = $this->request->getPost();
            $form->setData($post);
            if ($form->isValid()) {
                $em = $this->getEntityManager();
                $products = $this->getSaleSession()->products;
                if (count($products)) {
                    foreach ($products as $product) {
                        $saleDetails = new \Business\Entity\SaleDetail();
                        $saleDetails->setSaleDetailQuantity($product['quantity']);
                        $saleDetails->setSaleDetailPrice($product['productPrice']);
                        $saleDetails->setSaleDetailDiscount(0);
                        $saleDetails->setSaleDetailTotal($product['subtotal']);
                        $saleDetails->setProductId($em->find('Product\Entity\Product', $product['productId']));
                        $sale->addSaleDetails($saleDetails);
                    }
                }
                $em->persist($sale);
                $em->flush();
                $this->getSaleSession()->offsetUnset('products');
                return $this->redirect()->toRoute('admin/business/sale');
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
        $item = $em->getRepository($this->getRepository())->findOneBy(array('saleId' => $id));
        if (!$item) {
            return $this->redirect()->toRoute('admin/business/sale/add/' . $personType);
        }
        $form = new SaleForm($em, $this->companyAuth()->getCompanyId());
        $form->bind($item);
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $em->persist($item);
                $em->flush();
                return $this->redirect()->toRoute('admin/business/sale');
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
            return $this->redirect()->toRoute('admin/business/sale');
        }
        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'NÃ£o');
            if ($del == 'Sim') {
                $id = $request->getPost('id');
                $em->remove($em->find($this->getRepository(), $id));
                $em->flush();
            }
            return $this->redirect()->toRoute('admin/business/sale');
        }
        return array(
            'id' => $id,
            'sale' => $em->find($this->getRepository(), $id),
        );
    }

    public function viewAction() {
        $id = (int) $this->getEvent()->getRouteMatch()->getParam('id');
        $em = $this->getEntityManager();
        $item = $em->getRepository($this->getRepository())->findOneBy(array('saleId' => $id));
        if (!$item) {
            return $this->redirect()->toRoute('admin/business/sale');
        }
        return array(
            'id' => $id,
            'sale' => $em->find($this->getRepository(), $id),
        );
    }

    public function addproductAction() {
        $item = $this->params()->fromQuery('product');
        $quantity = $this->params()->fromQuery('quantity');
        if (!$item) {
            return false;
        }
        $em = $this->getEntityManager();
        $product = $em->getRepository('Product\Entity\Product')
                ->createQueryBuilder('p')
                ->where("p.productName = '{$item}'")
                ->getQuery()
                ->getSingleResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
        $product['quantity'] = $quantity;
        $subtotal = $quantity * $product['productPrice'];
        $product['subtotal'] = $subtotal;
        $this->getSaleSession()->products[] = $product;
        return $this->getResponse()->setContent(\Zend\Json\Json::encode(array('result' => true)));
    }

    public function listproductsAction() {
        $products = array();
        if ($this->getSaleSession()->products) {
            $products = $this->getSaleSession()->products;
        }
        return array(
            'products' => $products
        );
    }

    public function deleteproductAction() {
        $item = (int) $this->params()->fromQuery('itemId');
        $products = $this->getSaleSession()->products;
        if ($item >= 0) {
            unset($products[$item]);
            $this->getSaleSession()->products = $products;
        }
        $view = new \Zend\View\Model\JsonModel(array('result' => true, 'item' => $products));
        return $view;
    }
    
    public function calculateAction() {
        $filter = new \Avr\Filter\Currency();
        $addition = $filter->filter($this->params()->fromQuery('addition'));
        $discount = $filter->filter($this->params()->fromQuery('discount'));
        $products = $this->getSaleSession()->products;
        $sum = 0;
        if (count($products) > 0) {
            foreach ($products as $product) {
                $sum += $product['subtotal'];
            }
        }
        $total = ($sum + $addition) - $discount;
        return new \Zend\View\Model\JsonModel(array('result' => number_format($total, 2, ',', '.')));
    }
    
    public function updateproductAction() {
        $quantity = $this->params()->fromQuery('quantity');
        $item = $this->params()->fromQuery('item');
        $products = $this->getSaleSession()->products;
        if (count($products)) {
            $product = $products[$item];
            $product['quantity'] = $quantity;
            $product['subtotal'] = $quantity * $product['productPrice'];
            $products[$item] = $product;
        }
        $this->getSaleSession()->products = $products;
        return new \Zend\View\Model\JsonModel(array('result' => $products[$item]));
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

    public function getSaleSession() {
        if ($this->saleSession === null) {
            $this->saleSession = new Container('SaleSession');
        }
        return $this->saleSession;
    }

}
