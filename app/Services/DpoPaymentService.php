<?php

namespace App\Services;

use Exception;

class DpoPaymentService
{
    protected $endpoint = "https://secure.3gdirectpay.com/API/v6/";

    public function createPaymentToken($paymentDetails, $services)
    {
        $xmlData = $this->buildXmlData($paymentDetails, $services);

        $ch = curl_init();

        if (!$ch) {
            throw new Exception("Couldn't initialize a cURL handle");
        }

        curl_setopt($ch, CURLOPT_URL, $this->endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/xml']);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlData);

        $result = curl_exec($ch);

        if (curl_errno($ch)) {
            throw new Exception(curl_error($ch));
        }

        curl_close($ch);

        return $result;
    }

    protected function buildXmlData($paymentDetails, $services)
    {
        $servicesXml = '';
        foreach ($services as $service) {
            $servicesXml .= "
                <Service>
                    <ServiceType>{$service['type']}</ServiceType>
                    <ServiceDescription>{$service['description']}</ServiceDescription>
                    <ServiceDate>{$service['date']}</ServiceDate>
                </Service>";
        }

        return "<?xml version=\"1.0\" encoding=\"utf-8\"?>
            <API3G>
                <CompanyToken>{$paymentDetails['company_token']}</CompanyToken>
                <Request>createToken</Request>
                <Transaction>
                    <PaymentAmount>{$paymentDetails['amount']}</PaymentAmount>
                    <PaymentCurrency>{$paymentDetails['currency']}</PaymentCurrency>
                    <CompanyRef>{$paymentDetails['reference']}</CompanyRef>
                    <RedirectURL>{$paymentDetails['redirect_url']}</RedirectURL>
                    <BackURL>{$paymentDetails['back_url']}</BackURL>
                    <CompanyRefUnique>{$paymentDetails['unique_ref']}</CompanyRefUnique>
                    <PTL>{$paymentDetails['ptl']}</PTL>
                </Transaction>
                <Services>{$servicesXml}</Services>
            </API3G>";
    }
}
