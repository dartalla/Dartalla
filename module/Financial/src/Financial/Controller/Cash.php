<?php

namespace Financial\Controller;

use Financial\Entity\Expense;
use Financial\Entity\Revenue;
use Financial\Entity\Launch;
use Zend\Mvc\Controller\AbstractActionController;
use Doctrine\ORM\Tools\Pagination\Paginator as DoctrinePaginator;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\ArrayAdapter;

class Cash extends AbstractActionController {

    protected $service;
    protected $entityManager;

    public function indexAction() {
        $date = $this->params()->fromQuery('dt');
        $companyId = $this->companyAuth()->getCompanyId();
        $monthRevenues = $this->getService()->getCurrentMonthRevenues($companyId);
        $monthExpenses = $this->getService()->getCurrentMonthExpenses($companyId);
        $expense = $this->getService()->getExpenseTotal($companyId, date('Y-m-d'));
        $revenue = $this->getService()->getRevenueTotal($companyId, date('Y-m-d'));
        $lastBalance = $this->getService()->getLastBalance($companyId);
        $balance = $this->getService()->getBalance($companyId, date('Y-m-d')) + $lastBalance;
        $cash = $this->getService()->getCash();
        return array(
            'monthRevenues' => $monthRevenues,
            'monthExpenses' => $monthExpenses,
            'revenue' => $revenue['total'],
            'expense' => $expense['total'],
            'balance' => $balance,
            'lastBalance' => $lastBalance,
            'cash' => $cash,
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
    }

}
