<?php

namespace Financial\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Json\Json;
use Financial\Entity\AccountParcel;

class AccountParcelController extends AbstractActionController {

    protected $entityManager;
    protected $repository;

    public function indexAction() {
        
    }

    public function createAction() {
        $count = $this->params()->fromQuery('count');
        $accountValue = $this->params()->fromQuery('value');
        $firstExpiration = $this->params()->fromQuery('date');
        $parcelValue = $accountValue;

        if ($count > 0) {
            $parcelValue = $accountValue / $count;
            $parcels = array();
            
            for ($i = 0; $i < $count; $i++) {
                $accountParcel = new AccountParcel();
                $accountParcel->setAccountParcelValue($parcelValue);
                $accountParcel->setAccountParcelExpiration($this->getDate($firstExpiration));
                $parcels[] = $accountParcel;
            }
        } else {
            $accountParcel = new AccountParcel();
            $accountParcel->setAccountParcelValue($parcelValue);
            $accountParcel->setAccountParcelExpiration($this->getDate($firstExpiration, 0));
            $parcels[] = $accountParcel;
        }
        
        $view = new \Zend\View\Model\JsonModel($parcels);
        $view->setTerminal(true);
        $view->setTemplate('account-parcel/create');
        return $view;
    }

    public function getDate($date, $interval = 30) {
        if (!$date) {
            $date = date('d/m/Y');
        }
        $date_array = explode('/', $date);
        $mktime = mktime(null, null, null, $date_array[1], $date_array[0] + $interval, $date_array[2]);
        $expiration_date = new \DateTime(date('Y-m-d', $mktime));
        return $expiration_date;
    }

    public function getEntityManager() {
        return $this->entityManager;
    }

    public function setEntityManager($entityManager) {
        $this->entityManager = $entityManager;
    }

    public function getRepository() {
        return $this->repository;
    }

    public function setRepository($repository) {
        $this->repository = $repository;
    }

}
