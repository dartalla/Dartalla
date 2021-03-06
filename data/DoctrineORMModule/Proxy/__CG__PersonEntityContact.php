<?php

namespace DoctrineORMModule\Proxy\__CG__\Person\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class Contact extends \Person\Entity\Contact implements \Doctrine\ORM\Proxy\Proxy
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
            return array('__isInitialized__', 'contactId', 'contactEmail', 'contactWebsite', 'contactPhone', 'contactCell', 'contactFax');
        }

        return array('__isInitialized__', 'contactId', 'contactEmail', 'contactWebsite', 'contactPhone', 'contactCell', 'contactFax');
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (Contact $proxy) {
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
    public function getContactId()
    {
        if ($this->__isInitialized__ === false) {
            return  parent::getContactId();
        }


        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getContactId', array());

        return parent::getContactId();
    }

    /**
     * {@inheritDoc}
     */
    public function setContactId($contactId)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setContactId', array($contactId));

        return parent::setContactId($contactId);
    }

    /**
     * {@inheritDoc}
     */
    public function getContactEmail()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getContactEmail', array());

        return parent::getContactEmail();
    }

    /**
     * {@inheritDoc}
     */
    public function setContactEmail($contactEmail)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setContactEmail', array($contactEmail));

        return parent::setContactEmail($contactEmail);
    }

    /**
     * {@inheritDoc}
     */
    public function getContactWebsite()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getContactWebsite', array());

        return parent::getContactWebsite();
    }

    /**
     * {@inheritDoc}
     */
    public function setContactWebsite($contactWebsite)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setContactWebsite', array($contactWebsite));

        return parent::setContactWebsite($contactWebsite);
    }

    /**
     * {@inheritDoc}
     */
    public function getContactPhone()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getContactPhone', array());

        return parent::getContactPhone();
    }

    /**
     * {@inheritDoc}
     */
    public function setContactPhone($contactPhone)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setContactPhone', array($contactPhone));

        return parent::setContactPhone($contactPhone);
    }

    /**
     * {@inheritDoc}
     */
    public function getContactCell()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getContactCell', array());

        return parent::getContactCell();
    }

    /**
     * {@inheritDoc}
     */
    public function setContactCell($contactCell)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setContactCell', array($contactCell));

        return parent::setContactCell($contactCell);
    }

    /**
     * {@inheritDoc}
     */
    public function getContactFax()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getContactFax', array());

        return parent::getContactFax();
    }

    /**
     * {@inheritDoc}
     */
    public function setContactFax($contactFax)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setContactFax', array($contactFax));

        return parent::setContactFax($contactFax);
    }

}
