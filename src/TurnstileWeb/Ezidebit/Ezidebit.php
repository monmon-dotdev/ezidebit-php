<?php

namespace TurnstileWeb\Ezidebit;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Class Ezidebit
 * @package TurnstileWeb\Ezidebit
 */
class Ezidebit
{
    /**
     * @var string
     */
    private $digitalKey;

    /**
     * @var string
     */
    private $pciMode;

    /**
     * @var string
     */
    private $environment;

    /**
     * @var \Symfony\Component\HttpFoundation\ParameterBag
     */
    protected $parameters;

    /**
     * @param string $digitalKey
     * @param string $pciMode
     * @param string $environment
     */
    function __construct($digitalKey, $pciMode, $environment)
    {
        if (! in_array($pciMode, array('pci', 'nonpci'))) {
            throw new \InvalidArgumentException('Invalid PCI mode');
        }
        if (! in_array($environment, array('live', 'test'))) {
            throw new \InvalidArgumentException('Invalid environment');
        }
        $this->digitalKey = $digitalKey;
        $this->pciMode = $pciMode;
        $this->environment = $environment;
        $this->initialize();
    }

    protected function createMethod($class)
    {
        $requestObject = new $class($this->digitalKey, $this->pciMode, $this->environment);
        return $requestObject->initialize(array_replace($this->getParameters(), $parameters));
    }

    /**
     * Initialize this gateway with default parameters
     *
     * @param  array $parameters
     * @return $this
     */
    public function initialize(array $parameters = array())
    {
        $this->parameters = new ParameterBag();
        // set default parameters
        foreach ($this->getDefaultParameters() as $key => $value) {
            if (is_array($value)) {
                $this->parameters->set($key, reset($value));
            } else {
                $this->parameters->set($key, $value);
            }
        }
        return $this;
    }

    /**
     * @return array
     */
    public function getDefaultParameters()
    {
        return array();
    }

    /**
     * @return array
     */
    public function getParameters()
    {
        return $this->parameters->all();
    }

    /**
     * @param  string $key
     * @return mixed
     */
    protected function getParameter($key)
    {
        return $this->parameters->get($key);
    }

    /**
     * @param  string $key
     * @param  mixed  $value
     * @return $this
     */
    protected function setParameter($key, $value)
    {
        $this->parameters->set($key, $value);
        return $this;
    }
}