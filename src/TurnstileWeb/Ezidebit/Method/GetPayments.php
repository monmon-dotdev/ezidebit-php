<?php

namespace TurnstileWeb\Ezidebit\Method;

use TurnstileWeb\Ezidebit\Soap\SoapClient;

/**
 * Class GetPayments
 * @package TurnstileWeb\Ezidebit\Method
 */
class GetPayments extends AbstractMethod
{
    /**
     * @var array
     */
    public static $paymentTypes = array('ALL', 'PENDING', 'FAILED', 'SUCCESSFUL');

    /**
     * @var array
     */
    public static $paymentMethods = array('ALL', 'CR', 'DR');

    /**
     * @var array
     */
    public static $paymentSources = array('ALL', 'SCHEDULED', 'WEB', 'PHONE', 'BPAY');

    /**
     * Inject and validate the request parameters
     *
     * @param array $parameters
     * @return AbstractMethod
     */
    public function validate(array $parameters = array())
    {
        if (!isset($parameters['paymentType']) ||
            !is_string($parameters['paymentType']) ||
            !in_array(strtoupper($parameters['paymentType']), self::$paymentTypes)) {
            throw new \InvalidArgumentException('Invalid payment type');
        }
        if (!isset($parameters['paymentMethod']) ||
            !is_string($parameters['paymentMethod']) ||
            !in_array(strtoupper($parameters['paymentMethod']), self::$paymentMethods)) {
            throw new \InvalidArgumentException('Invalid payment method');
        }
        if (!isset($parameters['paymentSource']) ||
            !is_string($parameters['paymentSource']) ||
            !in_array(strtoupper($parameters['paymentSource']), self::$paymentSources)) {
            throw new \InvalidArgumentException('Invalid payment source');
        }
    }

    /**
     * Make the request GetPayments
     *
     * @param callable $success
     * @param callable $failure
     */
    public function request(Callable $success, Callable $failure)
    {

    }

    /**
     * The the request body
     *
     * @return \SimpleXMLElement
     */
    protected function getBody()
    {
        return new \SimpleXMLElement($this->getBodyString());
    }

    protected function getBodyString()
    {
        return <<<XML
<px:GetPayments>
    <px:DigitalKey>$this->digitalKey</px:DigitalKey>
    <px:PaymentType>$this->parameters()->get('paymentType')</px:PaymentType>
    <px:PaymentMethod>$this->parameters()->get('paymentMethod')</px:PaymentMethod>
    <px:PaymentSource>$this->parameters()->get('paymentSource')</px:PaymentSource>
    <px:PaymentReference />
    <px:DateFrom>$this->parameters()->get('dateFrom')->format('Y-m-d')</px:DateFrom>
    <px:DateTo>$this->parameters()->get('dateTo')->format('Y-m-d')</px:DateTo>
    <px:DateField>$this->parameters()->get('dateField')</px:DateField>
    <px:EziDebitCustomerID />
    <px:YourSystemReference>$this->parameters()->get('yourSystemReference')</px:YourSystemReference>
</px:GetPayments>
XML;
    }
}