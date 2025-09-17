<?php

namespace Models;

use Core\Model;

class Bkash extends Model
{
    // grant token
    public function grantToken()
    {
        $now = date('Y-m-d H:i:s', time());

        // get token
        $Query = "SELECT id, token, refreshToken, expiredAt
        FROM token 
        WHERE id = ? AND expiredAt > ? 
        ORDER BY id DESC 
        LIMIT 1";
        $Data = [1, $now];
        $Token = $this->SelectRow($Query, $Data);
        if ($Token) {
            return response(true, 'Token has been retrieved successfully', [
                'token' => $Token[0]->token,
            ]);
        }

        $url = Helper::BkashConfig()->BASE_URL . "/tokenized/checkout/token/grant";
        $headers = [
            "Content-Type: application/json",
            "Accept: application/json",
            "username: " . Helper::BkashConfig()->USERNAME,
            "password: " . Helper::BkashConfig()->PASSWORD
        ];
        $body = json_encode([
            "app_key" => Helper::BkashConfig()->APP_KEY,
            "app_secret" => Helper::BkashConfig()->APP_SECRET
        ]);

        $response = Helper::PostRequest($url, $headers, $body, [
            CURLOPT_IPRESOLVE => CURL_IPRESOLVE_V4,
        ]);
        // echo '<pre>';
        // print_r($response);
        // echo '</pre>';
        // exit();
        $result = json_decode($response, true);

        if (!isset($result['id_token'])) {
            return response(false, 'Failed to get token', $result);
        }

        $id_token     = $result['id_token'];
        $refreshToken = $result['refresh_token'] ?? null;
        $expiredAt    = date('Y-m-d H:i:s', time() + 3000);

        $UpsertQuery = "INSERT INTO token 
        (id, token, refreshToken, expiredAt, createdAt, updatedAt) 
        VALUES (?, ?, ?, ?, ?, ?) 
        ON DUPLICATE KEY UPDATE 
        token = VALUES(token), 
        refreshToken = VALUES(refreshToken), 
        expiredAt = VALUES(expiredAt), 
        updatedAt = VALUES(updatedAt)";
        $UpsertData = [1, $id_token, $refreshToken, $expiredAt, $now, $now];
        $this->InsertRow($UpsertQuery, $UpsertData);

        return response(true, 'Token has been retrieved successfully', [
            'token' => $id_token,
        ]);
    }

    public function createPayment($amount, $invoice, $payerReference)
    {
        $tokenData = $this->grantToken();
        if (!$tokenData['success']) {
            return response(false, 'Could not retrieve token', $tokenData);
        }

        $id_token = $tokenData['data']['token'];
        $app_key  = Helper::BkashConfig()->APP_KEY;

        $url = Helper::BkashConfig()->BASE_URL . "/tokenized/checkout/create";
        $headers = [
            "Content-Type: application/json",
            "Accept: application/json",
            "Authorization: $id_token",
            "X-APP-Key: $app_key"
        ];
        $body = json_encode([
            "mode" => "0011",
            "payerReference" => $payerReference,
            "callbackURL" => Helper::BkashConfig()->CALLBACK_URL,
            "amount" => $amount,
            "currency" => "BDT",
            "intent" => "sale",
            "merchantInvoiceNumber" => $invoice
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

        if (isset($result['statusCode']) && $result['statusCode'] !== '0000') {
            return response(false, 'Failed to create payment', $result);
        }

        return response(true, 'Payment created successfully', $result);
    }

    public function executePayment($paymentID)
    {
        $tokenData = $this->grantToken();
        if (!$tokenData['success']) {
            return response(false, 'Could not retrieve token', $tokenData);
        }

        $id_token = $tokenData['data']['token'];
        $app_key  = Helper::BkashConfig()->APP_KEY;

        $url = Helper::BkashConfig()->BASE_URL . "/tokenized/checkout/execute";
        $headers = [
            "Content-Type: application/json",
            "Accept: application/json",
            "Authorization: $id_token",
            "X-APP-Key: $app_key"
        ];
        $body = json_encode([
            "paymentID" => $paymentID,
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

        if (isset($result['statusCode']) && $result['statusCode'] !== '0000') {
            return response(false, 'Failed to execute payment', $result);
        }

        return response(true, 'Payment executed successfully', $result);
    }
}
