<?php

namespace TurnstileWeb\Ezidebit\Soap;

/**
 * Class Soap
 * @package TurnstileWeb\Ezidebit\Soap
 */
class SoapClient extends \SoapClient
{
    public function getEnvelope()
    {
        return new \SimpleXMLElement($this->getEnvelopeString());
    }

    public function getEnvelopeString()
    {
        return <<<XML
<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:px="https://px.ezidebit.com.au/">
    <soapenv:Header />
    <soapenv:Body>
    </soapenv:Body>
</soapenv:Envelope>
XML;
    }
}