<?php

namespace Purchase\Controller;

use Purchase\Entity\Purchase as PurchaseEntity;
use Purchase\Form\Purchase as PurchaseForm;
use Zend\Mvc\Controller\AbstractActionController;
use Doctrine\ORM\Tools\Pagination\Paginator as DoctrinePaginator;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
use Zend\Paginator\Paginator;
use Zend\Session\Container;

class Purchase extends AbstractActionController {

    protected $repository;
    protected $entityManager;
    protected $purchaseSession;

    public function indexAction() {
        $this->getPurchaseSession()->offsetUnset('products');
        $companyId = $this->companyAuth()->getCompanyId();
        $adapter = new DoctrineAdapter(
            new DoctrinePaginator($this->getEntityManager()
                ->getRepository($this->getRepository())
                ->createQueryBuilder('pp')
                ->where("pp.companyId = {$companyId}")
                ->orderBy('pp.purchaseDate', 'DESC')
        ));
        $monthTotal = $this->getEntityManager()->getRepository($this->getRepository())
                ->getMonthTotal();
        $total = $this->getEntityManager()->getRepository($this->getRepository())
                ->getTotal();
        $totalOfDay = $this->getEntityManager()->getRepository($this->getRepository())
                ->getTotalOfDay(date('Y-m-d'));
        $paginator = new Paginator($adapter);
        $paginator->setDefaultItemCountPerPage(10);
        $page = $this->params()->fromRoute('page');
        if ($page) {
            $paginator->setCurrentPageNumber($page);
        }
        return array(
            'purchase' => $paginator,
            'total'    => $total,
            'monthTotal'    => $monthTotal,
            'totalOfDay'    => $totalOfDay,
        );
    }

    public function addAction() {
        if (!$this->getPurchaseSession()->products) {
            $this->getPurchaseSession()->products = array();
        }
        $form = new PurchaseForm($this->getEntityManager(), $this->companyAuth()->getCompanyId());
        $purchase = new PurchaseEntity();
        $form->bind($purchase);
        if ($this->request->isPost()) {
            $post = $this->request->getPost();
            $form->setData($post);
            if ($form->isValid()) {
                $em = $this->getEntityManager();
                $products = $this->getPurchaseSession()->products;
                if (count($products)) {
                    foreach ($products as $product) {
                        $productDb = $em->find('Product\Entity\Product', $product['productId']);
                        $purchaseProducts = new \Purchase\Entity\PurchaseProduct();
                        $purchaseProducts->setPurchaseProductQuantity($product['quantity']);
                        $purchaseProducts->setPurchaseProductPrice($product['productPrice']);
                        $purchaseProducts->setPurchaseProductDiscount(0);
                        $purchaseProducts->setPurchaseProductTotal($product['subtotal']);
                        $purchaseProducts->setProductId($productDb);
                        $purchase->addProducts($purchaseProducts);
                        $productDb->setProductStock($productDb->getProductStock() + $product['quantity']);
                        $em->persist($productDb);
                    }
                }
                $em->persist($purchase);
                $em->flush();
                $this->getPurchaseSession()->offsetUnset('products');
                return $this->redirect()->toRoute('admin/purchase');
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
        $item = $em->getRepository($this->getRepository())->findOneBy(array('purchaseId' => $id));
        if (!$item) {
            return $this->redirect()->toRoute('admin/purchase/add/' . $personType);
        }
        $form = new PurchaseForm($em, $this->companyAuth()->getCompanyId());
        $form->bind($item);
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $em->persist($item);
                $em->flush();
                return $this->redirect()->toRoute('admin/purchase');
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
            return $this->redirect()->toRoute('admin/purchase');
        }
        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'NÃ£o');
            if ($del == 'Sim') {
                $id = $request->getPost('id');
                $em->remove($em->find($this->getRepository(), $id));
                $em->flush();
            }
            return $this->redirect()->toRoute('admin/purchase');
        }
        return array(
            'id' => $id,
            'purchase' => $em->find($this->getRepository(), $id),
        );
    }

    public function viewAction() {
        $id = (int) $this->getEvent()->getRouteMatch()->getParam('id');
        $em = $this->getEntityManager();
        $item = $em->getRepository($this->getRepository())->findOneBy(array('purchaseId' => $id));
        if (!$item) {
            return $this->redirect()->toRoute('admin/purchase');
        }
        return array(
            'id' => $id,
            'purchase' => $em->find($this->getRepository(), $id),
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
        $this->getPurchaseSession()->products[] = $product;
        return $this->getResponse()->setContent(\Zend\Json\Json::encode(array('result' => true)));
    }

    public function listproductsAction() {
        $products = array();
        if ($this->getPurchaseSession()->products) {
            $products = $this->getPurchaseSession()->products;
        }
        return array(
            'products' => $products
        );
    }

    public function deleteproductAction() {
        $item = (int) $this->params()->fromQuery('itemId');
        $products = $this->getPurchaseSession()->products;
        if ($item >= 0) {
            unset($products[$item]);
            $this->getPurchaseSession()->products = $products;
        }
        $view = new \Zend\View\Model\JsonModel(array('result' => true, 'item' => $products));
        return $view;
    }
    
    public function calculateAction() {
        $filter = new \Avr\Filter\Currency();
        $discount = $filter->filter($this->params()->fromQuery('discount'));
        $products = $this->getPurchaseSession()->products;
        $sum = 0;
        if (count($products) > 0) {
            foreach ($products as $product) {
                $sum += $product['subtotal'];
            }
        }
        $total = ($sum) - $discount;
        return new \Zend\View\Model\JsonModel(array('result' => number_format($total, 2, ',', '.')));
    }
    
    public function updateproductAction() {
        $quantity = $this->params()->fromQuery('quantity');
        $item = $this->params()->fromQuery('item');
        $products = $this->getPurchaseSession()->products;
        if (count($products)) {
            $product = $products[$item];
            $product['quantity'] = $quantity;
            $product['subtotal'] = $quantity * $product['productPrice'];
            $products[$item] = $product;
        }
        $this->getPurchaseSession()->products = $products;
        return new \Zend\View\Model\JsonModel(array('result' => $products[$item]));
    }

    public function getRepository() {
        if (!$this->repository) {
            $this->repository = 'Purchase\Entity\Purchase';
        }  
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

    public function getPurchaseSession() {
        if ($this->purchaseSession === null) {
            $this->purchaseSession = new Container('PurchaseSession');
        }
        return $this->purchaseSession;
    }

}
