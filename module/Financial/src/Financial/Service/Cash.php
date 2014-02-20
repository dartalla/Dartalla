<?php

namespace Financial\Service;

class Cash {

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $entityManager;

    /**
     * @var string
     */
    protected $revenue;

    /**
     * @var string
     */
    protected $expense;

    public function filter($post, $companyId) {
        $where = null;

        if ($post->date) {
            $filter = new \Avr\Filter\Date();
            $date = $filter->filter($post->date);
            $where = "AND l.launchDate = '{$date}'";
        }

        $expenses = $this->getEntityManager()
                        ->createQuery(
                                "SELECT e,l FROM {$this->getExpense()} e
                        JOIN e.launch l 
                        WHERE e.companyId = {$companyId}
                        {$where}
                        ORDER BY l.launchDate DESC"
                        )->getResult();

        $revenues = $this->getEntityManager()
                        ->createQuery(
                                "SELECT e,l FROM {$this->getRevenue()} e
                        JOIN e.launch l 
                        WHERE e.companyId = {$companyId}
                        {$where}
                        ORDER BY l.launchDate DESC"
                        )->getResult();
        return array(
            'expenses' => $expenses,
            'revenues' => $revenues
        );
    }

    public function getExpenses($companyId, $date = null) {
        return $this->getEntityManager()
                        ->getRepository($this->getExpense())
                        ->getExpenses($companyId, $date);
    }

    public function getRevenues($companyId, $date = null) {
        return $this->getEntityManager()
                        ->getRepository($this->getRevenue())
                        ->getRevenues($companyId, $date);
    }

    public function getLastRevenues($companyId, $limit = 5) {
        return $this->getEntityManager()
                        ->getRepository($this->getRevenue())
                        ->findBy(array('companyId' => $companyId), array('revenueId' => 'DESC'), $limit);
    }

    public function getLastExpenses($companyId, $limit = 5) {
        return $this->getEntityManager()
                        ->getRepository($this->getExpense())
                        ->findBy(array('companyId' => $companyId), array('expenseId' => 'DESC'), $limit);
    }

    public function getExpenseTotal($companyId, $date = null) {
        return $this->getEntityManager()
                        ->getRepository($this->getExpense())
                        ->getExpenseTotal($companyId, $date);
    }

    public function getExpenseLastTotal($companyId) {
        return $this->getEntityManager()
                        ->getRepository($this->getExpense())
                        ->getExpenseLastTotal($companyId);
    }

    public function getRevenueTotal($companyId, $date = null) {
        return $this->getEntityManager()
                        ->getRepository($this->getRevenue())
                        ->getRevenueTotal($companyId, $date);
    }

    public function getRevenueLastTotal($companyId) {
        return $this->getEntityManager()
                        ->getRepository($this->getRevenue())
                        ->getRevenueLastTotal($companyId);
    }

    public function getBalance($companyId, $date = null) {
        $expenseTotal = $this->getExpenseTotal($companyId, $date);
        $revenueTotal = $this->getRevenueTotal($companyId, $date);
        return $revenueTotal['total'] - $expenseTotal['total'];
    }

    public function getLastBalance($companyId) {
        $expenseTotal = $this->getExpenseLastTotal($companyId);
        $revenueTotal = $this->getRevenueLastTotal($companyId);
        return $revenueTotal['total'] - $expenseTotal['total'];
    }

    public function getCurrentMonthRevenues($companyId) {
        $startDate = date('Y-m') . '-01';
        $endDate = date('Y-m-') . date('t', mktime(0, 0, 0, date('m'), '01', date('Y')));
        $revenues = $this->getEntityManager()
                ->getRepository($this->getRevenue())
                ->createQueryBuilder('r')
                ->select('SUM(l.launchValue) as total')
                ->join('r.launch', 'l')
                ->where("l.launchDate BETWEEN '{$startDate}' AND '{$endDate}'") 
                ->andWhere("r.companyId = {$companyId}")
                ->getQuery()
                ->getSingleResult();

        return $revenues['total'];
    }
    
    public function getCurrentMonthExpenses($companyId) {
        $startDate = date('Y-m') . '-01';
        $endDate = date('Y-m-') . date('t', mktime(0, 0, 0, date('m'), '01', date('Y')));
        $expenses = $this->getEntityManager()
                ->getRepository($this->getExpense())
                ->createQueryBuilder('r')
                ->select('SUM(l.launchValue) as total')
                ->join('r.launch', 'l')
                ->where("l.launchDate BETWEEN '{$startDate}' AND '{$endDate}'") 
                ->andWhere("r.companyId = {$companyId}")
                ->getQuery()
                ->getSingleResult();

        return $expenses['total'];
    }

    public function getCash() {
        return $this->getEntityManager()
                        ->getRepository('\Financial\Entity\Launch')
                        ->createQueryBuilder('l')
                        ->orderBy('l.launchId', 'DESC')
                        ->where("l.launchDate = '" . date('Y-m-d') . "'")
                        ->getQuery()
                        ->getResult();
    }

    public function getCashTotal() {
        return $this->getEntityManager()
                        ->getRepository($this->getRepository())
                        ->getCashTotal();
    }

    public function getCashTotalByDate($date = null) {
        return $this->getEntityManager()
                        ->getRepository($this->getRepository())
                        ->getCashTotalByDate($date);
    }

    public function find($id) {
        return $this->getEntityManager()
                        ->find($this->getRepository(), $id);
    }

    public function findAll() {
        return $this->getEntityManager()
                        ->getRepository($this->getRepository())
                        ->findAll();
    }

    public function findOneBy(array $criteria, array $orderBy = null) {
        return $this->getEntityManager()
                        ->getRepository($this->getRepository())
                        ->findOneBy($criteria, $orderBy);
    }

    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null) {
        return $this->getEntityManager()
                        ->getRepository($this->getRepository())
                        ->findBy($criteria, $orderBy, $limit, $offset);
    }

    /**
     * @return \Doctrine\ORM\EntityManager
     */
    public function getEntityManager() {
        return $this->entityManager;
    }

    /**
     * @param \Doctrine\ORM\EntityManager $entityManager
     * @return \Financial\Service\Cash
     */
    public function setEntityManager($entityManager) {
        $this->entityManager = $entityManager;
        return $this;
    }

    /**
     * @return string
     */
    public function getRepository() {
        if (!isset($this->repository)) {
            $this->setRepository('Financial\Entity\Cash');
        }
        return $this->repository;
    }

    /**
     * @param string $repository
     * @return \Financial\Service\Cash
     */
    public function setRepository($repository) {
        $this->repository = $repository;
        return $this;
    }

    /**
     * @return string
     */
    public function getRevenue() {
        return $this->revenue;
    }

    /**
     * @param string $revenue
     * @return \Financial\Service\Cash
     */
    public function setRevenue($revenue) {
        $this->revenue = $revenue;
        return $this;
    }

    /**
     * @return string
     */
    public function getExpense() {
        return $this->expense;
    }

    /**
     * @param string $expense
     * @return \Financial\Service\Cash
     */
    public function setExpense($expense) {
        $this->expense = $expense;
        return $this;
    }

}
