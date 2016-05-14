<?php

namespace TurnstileWeb\Ezidebit\Method;
use TurnstileWeb\Ezidebit\Soap\SoapClient;

/**
 * Class AbstractMethod
 * @package TurnstileWeb\Ezidebit\Method
 */
abstract class AbstractMethod implements MethodInterface
{
    /**
     * @var string
     */
    protected $url;

    /**
     * @var string
     */
    protected $soapClient;

    /**
     * @var \Symfony\Component\HttpFoundation\ParameterBag
     */
    protected $parameters;

    /**
     * @param string $digitalKey
     * @param string $url
     */
    function __construct($digitalKey, $url, SoapClient $soapClient)
    {
        $this->$digitalKey = $digitalKey;
        $this->url = $url;
        $this->soapClient = $soapClient;
    }

    /**
     * Inject and validate the request parameters
     *
     * @param array $parameters
     * @return AbstractMethod
     */
    abstract public function validate(array $parameters = array());

    /**
     * Make the request
     *
     * @param callable $success
     * @param callable $failure
     */
    abstract public function request(Callable $success, Callable $failure);
}