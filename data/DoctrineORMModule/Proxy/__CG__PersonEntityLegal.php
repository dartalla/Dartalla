<?php

namespace DoctrineORMModule\Proxy\__CG__\Person\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class Legal extends \Person\Entity\Legal implements \Doctrine\ORM\Proxy\Proxy
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
            return array('__isInitialized__', 'legalId', 'legalCnpj', 'legalSubscription', 'legalRepresentativeName', 'legalRepresentativePhone', 'legalRepresentativeRg');
        }

        return array('__isInitialized__', 'legalId', 'legalCnpj', 'legalSubscription', 'legalRepresentativeName', 'legalRepresentativePhone', 'legalRepresentativeRg');
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (Legal $proxy) {
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
    public function getLegalId()
    {
        if ($this->__isInitialized__ === false) {
            return (int)  parent::getLegalId();
        }


        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getLegalId', array());

        return parent::getLegalId();
    }

    /**
     * {@inheritDoc}
     */
    public function setLegalId($legalId)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setLegalId', array($legalId));

        return parent::setLegalId($legalId);
    }

    /**
     * {@inheritDoc}
     */
    public function getLegalCnpj()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getLegalCnpj', array());

        return parent::getLegalCnpj();
    }

    /**
     * {@inheritDoc}
     */
    public function setLegalCnpj($legalCnpj)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setLegalCnpj', array($legalCnpj));

        return parent::setLegalCnpj($legalCnpj);
    }

    /**
     * {@inheritDoc}
     */
    public function getLegalSubscription()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getLegalSubscription', array());

        return parent::getLegalSubscription();
    }

    /**
     * {@inheritDoc}
     */
    public function setLegalSubscription($legalSubscription)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setLegalSubscription', array($legalSubscription));

        return parent::setLegalSubscription($legalSubscription);
    }

    /**
     * {@inheritDoc}
     */
    public function getLegalRepresentativeName()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getLegalRepresentativeName', array());

        return parent::getLegalRepresentativeName();
    }

    /**
     * {@inheritDoc}
     */
    public function setLegalRepresentativeName($legalRepresentativeName)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setLegalRepresentativeName', array($legalRepresentativeName));

        return parent::setLegalRepresentativeName($legalRepresentativeName);
    }

    /**
     * {@inheritDoc}
     */
    public function getLegalRepresentativePhone()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getLegalRepresentativePhone', array());

        return parent::getLegalRepresentativePhone();
    }

    /**
     * {@inheritDoc}
     */
    public function setLegalRepresentativePhone($legalRepresentativePhone)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setLegalRepresentativePhone', array($legalRepresentativePhone));

        return parent::setLegalRepresentativePhone($legalRepresentativePhone);
    }

    /**
     * {@inheritDoc}
     */
    public function getLegalRepresentativeRg()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getLegalRepresentativeRg', array());

        return parent::getLegalRepresentativeRg();
    }

    /**
     * {@inheritDoc}
     */
    public function setLegalRepresentativeRg($legalRepresentativeRg)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setLegalRepresentativeRg', array($legalRepresentativeRg));

        return parent::setLegalRepresentativeRg($legalRepresentativeRg);
    }

}
