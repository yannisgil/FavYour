<?php

namespace Proxies\__CG__\ProjectBundle\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class Project extends \ProjectBundle\Entity\Project implements \Doctrine\ORM\Proxy\Proxy
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
            return array('__isInitialized__', '' . "\0" . 'ProjectBundle\\Entity\\Project' . "\0" . 'id', '' . "\0" . 'ProjectBundle\\Entity\\Project' . "\0" . 'title', '' . "\0" . 'ProjectBundle\\Entity\\Project' . "\0" . 'amountRequested', '' . "\0" . 'ProjectBundle\\Entity\\Project' . "\0" . 'amountWon', '' . "\0" . 'ProjectBundle\\Entity\\Project' . "\0" . 'endDate', '' . "\0" . 'ProjectBundle\\Entity\\Project' . "\0" . 'beginDate', '' . "\0" . 'ProjectBundle\\Entity\\Project' . "\0" . 'location', '' . "\0" . 'ProjectBundle\\Entity\\Project' . "\0" . 'description', '' . "\0" . 'ProjectBundle\\Entity\\Project' . "\0" . 'managers', '' . "\0" . 'ProjectBundle\\Entity\\Project' . "\0" . 'image', '' . "\0" . 'ProjectBundle\\Entity\\Project' . "\0" . 'homepage');
        }

        return array('__isInitialized__', '' . "\0" . 'ProjectBundle\\Entity\\Project' . "\0" . 'id', '' . "\0" . 'ProjectBundle\\Entity\\Project' . "\0" . 'title', '' . "\0" . 'ProjectBundle\\Entity\\Project' . "\0" . 'amountRequested', '' . "\0" . 'ProjectBundle\\Entity\\Project' . "\0" . 'amountWon', '' . "\0" . 'ProjectBundle\\Entity\\Project' . "\0" . 'endDate', '' . "\0" . 'ProjectBundle\\Entity\\Project' . "\0" . 'beginDate', '' . "\0" . 'ProjectBundle\\Entity\\Project' . "\0" . 'location', '' . "\0" . 'ProjectBundle\\Entity\\Project' . "\0" . 'description', '' . "\0" . 'ProjectBundle\\Entity\\Project' . "\0" . 'managers', '' . "\0" . 'ProjectBundle\\Entity\\Project' . "\0" . 'image', '' . "\0" . 'ProjectBundle\\Entity\\Project' . "\0" . 'homepage');
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (Project $proxy) {
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
    public function getId()
    {
        if ($this->__isInitialized__ === false) {
            return (int)  parent::getId();
        }


        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getId', array());

        return parent::getId();
    }

    /**
     * {@inheritDoc}
     */
    public function setTitle($title)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setTitle', array($title));

        return parent::setTitle($title);
    }

    /**
     * {@inheritDoc}
     */
    public function getTitle()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getTitle', array());

        return parent::getTitle();
    }

    /**
     * {@inheritDoc}
     */
    public function setAmountRequested($amountRequested)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAmountRequested', array($amountRequested));

        return parent::setAmountRequested($amountRequested);
    }

    /**
     * {@inheritDoc}
     */
    public function getAmountRequested()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAmountRequested', array());

        return parent::getAmountRequested();
    }

    /**
     * {@inheritDoc}
     */
    public function setEndDate($endDate)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setEndDate', array($endDate));

        return parent::setEndDate($endDate);
    }

    /**
     * {@inheritDoc}
     */
    public function getEndDate()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEndDate', array());

        return parent::getEndDate();
    }

    /**
     * {@inheritDoc}
     */
    public function setBeginDate($beginDate)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setBeginDate', array($beginDate));

        return parent::setBeginDate($beginDate);
    }

    /**
     * {@inheritDoc}
     */
    public function getBeginDate()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getBeginDate', array());

        return parent::getBeginDate();
    }

    /**
     * {@inheritDoc}
     */
    public function setLocation($location)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setLocation', array($location));

        return parent::setLocation($location);
    }

    /**
     * {@inheritDoc}
     */
    public function getLocation()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getLocation', array());

        return parent::getLocation();
    }

    /**
     * {@inheritDoc}
     */
    public function setDescription($description)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDescription', array($description));

        return parent::setDescription($description);
    }

    /**
     * {@inheritDoc}
     */
    public function getDescription()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDescription', array());

        return parent::getDescription();
    }

    /**
     * {@inheritDoc}
     */
    public function setManagers($managers)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setManagers', array($managers));

        return parent::setManagers($managers);
    }

    /**
     * {@inheritDoc}
     */
    public function getManagers()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getManagers', array());

        return parent::getManagers();
    }

    /**
     * {@inheritDoc}
     */
    public function setHomepage($homepage)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setHomepage', array($homepage));

        return parent::setHomepage($homepage);
    }

    /**
     * {@inheritDoc}
     */
    public function getHomepage()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getHomepage', array());

        return parent::getHomepage();
    }

    /**
     * {@inheritDoc}
     */
    public function setImage($image)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setImage', array($image));

        return parent::setImage($image);
    }

    /**
     * {@inheritDoc}
     */
    public function getImage()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getImage', array());

        return parent::getImage();
    }

    /**
     * {@inheritDoc}
     */
    public function setAmountWon($amountWon)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAmountWon', array($amountWon));

        return parent::setAmountWon($amountWon);
    }

    /**
     * {@inheritDoc}
     */
    public function getAmountWon()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAmountWon', array());

        return parent::getAmountWon();
    }

}
