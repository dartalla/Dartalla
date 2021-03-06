<?php

namespace DoctrineORMModule\Proxy\__CG__\Financial\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class Account extends \Financial\Entity\Account implements \Doctrine\ORM\Proxy\Proxy
{
    /**
     * @var \Closure the callback responsible for loading properties in the proxy object. This callback is called with
     *      three parameters, being respectively the proxy object to be initialized, the method that triggered the
     *      initialization process and an array of ordered parameters that were passed to that method.
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setInitializer
     */
    public $__initializer__;

    /**
     * @var \Closure the callback responsible of loading properties that need to be copied in the cloned object
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setCloner
     */
    public $__cloner__;

    /**
     * @var boolean flag indicating if this object was already initialized
     *
     * @see \Doctrine\Common\Persistence\Proxy::__isInitialized
     */
    public $__isInitialized__ = false;

    /**
     * @var array properties to be lazy loaded, with keys being the property
     *            names and values being their default values
     *
     * @see \Doctrine\Common\Persistence\Proxy::__getLazyProperties
     */
    public static $lazyPropertiesDefaults = array();



    /**
     * @param \Closure $initializer
     * @param \Closure $cloner
     */
    public function __construct($initializer = null, $cloner = null)
    {

        $this->__initializer__ = $initializer;
        $this->__cloner__      = $cloner;
    }







    /**
     * 
     * @return array
     */
    public function __sleep()
    {
        if ($this->__isInitialized__) {
            return array('__isInitialized__', 'accountId', 'accountAutoId', 'accountDescription', 'accountNumber', 'accountEmissionDate', 'accountExpirationDate', 'accountCompetencyDate', 'accountValue', 'accountParcels', 'accountCarrier', 'accountBarcode', 'accountAutoLaunch', 'accountFine', 'accountInterest', 'accountInterestInterval', 'accountNotes', 'accountDate', 'currentAccountId', 'paymentTypeId', 'accountingItemId', 'departmentId', 'documentTypeId', 'parcels');
        }

        return array('__isInitialized__', 'accountId', 'accountAutoId', 'accountDescription', 'accountNumber', 'accountEmissionDate', 'accountExpirationDate', 'accountCompetencyDate', 'accountValue', 'accountParcels', 'accountCarrier', 'accountBarcode', 'accountAutoLaunch', 'accountFine', 'accountInterest', 'accountInterestInterval', 'accountNotes', 'accountDate', 'currentAccountId', 'paymentTypeId', 'accountingItemId', 'departmentId', 'documentTypeId', 'parcels');
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (Account $proxy) {
                $proxy->__setInitializer(null);
                $proxy->__setCloner(null);

                $existingProperties = get_object_vars($proxy);

                foreach ($proxy->__getLazyProperties() as $property => $defaultValue) {
                    if ( ! array_key_exists($property, $existingProperties)) {
                        $proxy->$property = $defaultValue;
                    }
                }
            };

        }
    }

    /**
     * 
     */
    public function __clone()
    {
        $this->__cloner__ && $this->__cloner__->__invoke($this, '__clone', array());
    }

    /**
     * Forces initialization of the proxy
     */
    public function __load()
    {
        $this->__initializer__ && $this->__initializer__->__invoke($this, '__load', array());
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitialized($initialized)
    {
        $this->__isInitialized__ = $initialized;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitializer(\Closure $initializer = null)
    {
        $this->__initializer__ = $initializer;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __getInitializer()
    {
        return $this->__initializer__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setCloner(\Closure $cloner = null)
    {
        $this->__cloner__ = $cloner;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific cloning logic
     */
    public function __getCloner()
    {
        return $this->__cloner__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     * @static
     */
    public function __getLazyProperties()
    {
        return self::$lazyPropertiesDefaults;
    }

    
    /**
     * {@inheritDoc}
     */
    public function getAccountId()
    {
        if ($this->__isInitialized__ === false) {
            return (int)  parent::getAccountId();
        }


        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAccountId', array());

        return parent::getAccountId();
    }

    /**
     * {@inheritDoc}
     */
    public function setAccountId($accountId)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAccountId', array($accountId));

        return parent::setAccountId($accountId);
    }

    /**
     * {@inheritDoc}
     */
    public function getAccountAutoId()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAccountAutoId', array());

        return parent::getAccountAutoId();
    }

    /**
     * {@inheritDoc}
     */
    public function setAccountAutoId($accountAutoId)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAccountAutoId', array($accountAutoId));

        return parent::setAccountAutoId($accountAutoId);
    }

    /**
     * {@inheritDoc}
     */
    public function getAccountDescription()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAccountDescription', array());

        return parent::getAccountDescription();
    }

    /**
     * {@inheritDoc}
     */
    public function setAccountDescription($accountDescription)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAccountDescription', array($accountDescription));

        return parent::setAccountDescription($accountDescription);
    }

    /**
     * {@inheritDoc}
     */
    public function getAccountNumber()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAccountNumber', array());

        return parent::getAccountNumber();
    }

    /**
     * {@inheritDoc}
     */
    public function setAccountNumber($accountNumber)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAccountNumber', array($accountNumber));

        return parent::setAccountNumber($accountNumber);
    }

    /**
     * {@inheritDoc}
     */
    public function getAccountEmissionDate()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAccountEmissionDate', array());

        return parent::getAccountEmissionDate();
    }

    /**
     * {@inheritDoc}
     */
    public function setAccountEmissionDate($accountEmissionDate)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAccountEmissionDate', array($accountEmissionDate));

        return parent::setAccountEmissionDate($accountEmissionDate);
    }

    /**
     * {@inheritDoc}
     */
    public function getAccountExpirationDate()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAccountExpirationDate', array());

        return parent::getAccountExpirationDate();
    }

    /**
     * {@inheritDoc}
     */
    public function setAccountExpirationDate($accountExpirationDate)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAccountExpirationDate', array($accountExpirationDate));

        return parent::setAccountExpirationDate($accountExpirationDate);
    }

    /**
     * {@inheritDoc}
     */
    public function getAccountValue()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAccountValue', array());

        return parent::getAccountValue();
    }

    /**
     * {@inheritDoc}
     */
    public function setAccountValue($accountValue)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAccountValue', array($accountValue));

        return parent::setAccountValue($accountValue);
    }

    /**
     * {@inheritDoc}
     */
    public function getAccountParcels()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAccountParcels', array());

        return parent::getAccountParcels();
    }

    /**
     * {@inheritDoc}
     */
    public function setAccountParcels($accountParcels)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAccountParcels', array($accountParcels));

        return parent::setAccountParcels($accountParcels);
    }

    /**
     * {@inheritDoc}
     */
    public function getAccountCarrier()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAccountCarrier', array());

        return parent::getAccountCarrier();
    }

    /**
     * {@inheritDoc}
     */
    public function setAccountCarrier($accountCarrier)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAccountCarrier', array($accountCarrier));

        return parent::setAccountCarrier($accountCarrier);
    }

    /**
     * {@inheritDoc}
     */
    public function getAccountBarcode()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAccountBarcode', array());

        return parent::getAccountBarcode();
    }

    /**
     * {@inheritDoc}
     */
    public function setAccountBarcode($accountBarcode)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAccountBarcode', array($accountBarcode));

        return parent::setAccountBarcode($accountBarcode);
    }

    /**
     * {@inheritDoc}
     */
    public function getAccountAutoLaunch()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAccountAutoLaunch', array());

        return parent::getAccountAutoLaunch();
    }

    /**
     * {@inheritDoc}
     */
    public function setAccountAutoLaunch($accountAutoLaunch)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAccountAutoLaunch', array($accountAutoLaunch));

        return parent::setAccountAutoLaunch($accountAutoLaunch);
    }

    /**
     * {@inheritDoc}
     */
    public function getAccountFine()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAccountFine', array());

        return parent::getAccountFine();
    }

    /**
     * {@inheritDoc}
     */
    public function setAccountFine($accountFine)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAccountFine', array($accountFine));

        return parent::setAccountFine($accountFine);
    }

    /**
     * {@inheritDoc}
     */
    public function getAccountInterest()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAccountInterest', array());

        return parent::getAccountInterest();
    }

    /**
     * {@inheritDoc}
     */
    public function setAccountInterest($accountInterest)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAccountInterest', array($accountInterest));

        return parent::setAccountInterest($accountInterest);
    }

    /**
     * {@inheritDoc}
     */
    public function getAccountInterestInterval()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAccountInterestInterval', array());

        return parent::getAccountInterestInterval();
    }

    /**
     * {@inheritDoc}
     */
    public function setAccountInterestInterval($accountInterestInterval)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAccountInterestInterval', array($accountInterestInterval));

        return parent::setAccountInterestInterval($accountInterestInterval);
    }

    /**
     * {@inheritDoc}
     */
    public function getAccountNotes()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAccountNotes', array());

        return parent::getAccountNotes();
    }

    /**
     * {@inheritDoc}
     */
    public function setAccountNotes($accountNotes)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAccountNotes', array($accountNotes));

        return parent::setAccountNotes($accountNotes);
    }

    /**
     * {@inheritDoc}
     */
    public function getAccountDate()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAccountDate', array());

        return parent::getAccountDate();
    }

    /**
     * {@inheritDoc}
     */
    public function setAccountDate($accountDate)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAccountDate', array($accountDate));

        return parent::setAccountDate($accountDate);
    }

    /**
     * {@inheritDoc}
     */
    public function getCurrentAccountId()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCurrentAccountId', array());

        return parent::getCurrentAccountId();
    }

    /**
     * {@inheritDoc}
     */
    public function setCurrentAccountId($currentAccountId)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCurrentAccountId', array($currentAccountId));

        return parent::setCurrentAccountId($currentAccountId);
    }

    /**
     * {@inheritDoc}
     */
    public function getPaymentTypeId()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPaymentTypeId', array());

        return parent::getPaymentTypeId();
    }

    /**
     * {@inheritDoc}
     */
    public function setPaymentTypeId($paymentTypeId)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPaymentTypeId', array($paymentTypeId));

        return parent::setPaymentTypeId($paymentTypeId);
    }

    /**
     * {@inheritDoc}
     */
    public function getAccountingItemId()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAccountingItemId', array());

        return parent::getAccountingItemId();
    }

    /**
     * {@inheritDoc}
     */
    public function setAccountingItemId($accountingItemId)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAccountingItemId', array($accountingItemId));

        return parent::setAccountingItemId($accountingItemId);
    }

    /**
     * {@inheritDoc}
     */
    public function getDepartmentId()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDepartmentId', array());

        return parent::getDepartmentId();
    }

    /**
     * {@inheritDoc}
     */
    public function setDepartmentId($departmentId)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDepartmentId', array($departmentId));

        return parent::setDepartmentId($departmentId);
    }

    /**
     * {@inheritDoc}
     */
    public function getDocumentTypeId()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDocumentTypeId', array());

        return parent::getDocumentTypeId();
    }

    /**
     * {@inheritDoc}
     */
    public function setDocumentTypeId($documentTypeId)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDocumentTypeId', array($documentTypeId));

        return parent::setDocumentTypeId($documentTypeId);
    }

    /**
     * {@inheritDoc}
     */
    public function getAccountCompetencyDate()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAccountCompetencyDate', array());

        return parent::getAccountCompetencyDate();
    }

    /**
     * {@inheritDoc}
     */
    public function setAccountCompetencyDate($accountCompetencyDate)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAccountCompetencyDate', array($accountCompetencyDate));

        return parent::setAccountCompetencyDate($accountCompetencyDate);
    }

    /**
     * {@inheritDoc}
     */
    public function getParcels()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getParcels', array());

        return parent::getParcels();
    }

    /**
     * {@inheritDoc}
     */
    public function addParcels(\Financial\Entity\AccountParcel $parcel)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addParcels', array($parcel));

        return parent::addParcels($parcel);
    }

    /**
     * {@inheritDoc}
     */
    public function setParcels($parcels)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setParcels', array($parcels));

        return parent::setParcels($parcels);
    }

}
