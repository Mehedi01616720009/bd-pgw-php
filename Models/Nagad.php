<?php

namespace Models;

use Core\Model;

class Nagad extends Model
{
    public function initialize($invoice)
    {
        $SensitiveData = [
            'merchantId' => Helper::NagadConfig()->MERCHANTID,
            'datetime' => date('YmdHis', time()),
            'orderId' => $invoice,
            'challenge' => date('ymdHis', time()),
        ];

        $url = Helper::NagadConfig()->BASE_URL . "/check-out/initialize/" . Helper::NagadConfig()->MERCHANTID . '/' . $invoice;
        $headers = [
            "Content-Type: application/json",
            "X-KM-Api-Version:v-0.2.0",
            "X-KM-IP-V4:" . Helper::getIpAddress(),
            "X-KM-Client-Type:PC_WEB"
        ];
        $body = json_encode([
            'accountNumber' => Helper::NagadConfig()->ACCOUNT,
            'dateTime' => date('YmdHis', time()),
            'sensitiveData' => Helper::encryptDataWithPublicKey(json_encode($SensitiveData), Helper::NagadConfig()->PG_PUBLIC_KEY),
            'signature' => Helper::signatureGenerate(json_encode($SensitiveData), Helper::NagadConfig()->PRIVATE_KEY),
        ]);

        $response = Helper::PostRequest($url, $headers, $body, [
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
        ]);
        // echo '<pre>';
        // print_r($response);
        // echo '</pre>';
        // exit();
        $result = json_decode($response, true);
        $Error = Helper::NagadException($result);

        if ($Error['success'] === true) {
            return response(false, $Error['message'], $Error['data']);
        }

        return response(true, 'Payment initialized successfully', $result);
    }

    public function createPayment($amount, $invoice)
    {
        $initialize = $this->initialize($invoice);
        if (!$initialize['success']) {
            return response(false, $initialize['message'], $initialize['data']);
        }

        $initializedResult = json_decode(Helper::decryptDataWithPrivateKey($initialize['data']['sensitiveData'], Helper::NagadConfig()->PRIVATE_KEY), true);
        if (!isset($initializedResult['paymentReferenceId'], $initializedResult['challenge'])) {
            return response(false, "Initialization Failed, Decryption failed", null);
        }

        $paymentReferenceId = $initializedResult['paymentReferenceId'];
        $challenge = $initializedResult['challenge'];

        $SensitiveData = [
            'merchantId' => Helper::NagadConfig()->MERCHANTID,
            'orderId' => $invoice,
            'currencyCode' => '050',
            'amount' => $amount,
            'challenge' => $challenge,
        ];

        $AdditionalMerchantInf = [
            'serviceName' => Helper::NagadConfig()->COMPANY_NAME,
            'serviceLogoURL' => Helper::NagadConfig()->COMPANY_LOGO,
            'additionalFieldNameEN' => 'Type',
            'additionalFieldNameBN' => 'টাইপ',
            'additionalFieldValue' => 'Payment',
        ];

        $url = Helper::NagadConfig()->BASE_URL . "/check-out/complete/" . $paymentReferenceId;
        $headers = [
            "Content-Type: application/json",
            "X-KM-Api-Version:v-0.2.0",
            "X-KM-IP-V4:" . Helper::getIpAddress(),
            "X-KM-Client-Type:PC_WEB"
        ];
        $body = json_encode([
            'merchantCallbackURL' => Helper::NagadConfig()->CALLBACK_URL,
            'additionalMerchantInf' => $AdditionalMerchantInf,
            'sensitiveData' => Helper::encryptDataWithPublicKey(json_encode($SensitiveData), Helper::NagadConfig()->PG_PUBLIC_KEY),
            'signature' => Helper::signatureGenerate(json_encode($SensitiveData), Helper::NagadConfig()->PRIVATE_KEY),
        ]);

        $response = Helper::PostRequest($url, $headers, $body, [
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
        ]);
        // echo '<pre>';
        // print_r($response);
        // echo '</pre>';
        // exit();
        $result = json_decode($response, true);
        $Error = Helper::NagadException($result);

        if ($Error['success'] === true) {
            return response(false, $Error['message'], $Error['data']);
        }

        return response(true, 'Payment created successfully', $result);
    }

    public function verifyPayment($paymentReferenceId)
    {
        $url = Helper::NagadConfig()->BASE_URL . "/verify/payment/" . $paymentReferenceId;
        $response = Helper::GetRequest($url);
        // echo '<pre>';
        // print_r($response);
        // echo '</pre>';
        // exit();
        $result = json_decode($response, true);
        $Error = Helper::NagadException($result);

        if ($Error['success'] === true) {
            return response(false, $Error['message'], $Error['data']);
        }

        return response(true, 'Payment verified successfully', $result);
    }
}
