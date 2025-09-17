<?php

namespace Models;

use Core\Model;
use Exception;

class Helper extends Model
{
    // bkash config
    public static function BkashConfig()
    {
        return (object) [
            "BASE_URL" => config('BKASH_SANDBOX') === 'true' ? "https://tokenized.sandbox.bka.sh/v1.2.0-beta" : config('BKASH_BASE_URL') . '/' . config('BKASH_VERSION'),
            "USERNAME" => config('BKASH_SANDBOX') === 'true' ? "01770618567" : config('BKASH_USERNAME'),
            "PASSWORD" => config('BKASH_SANDBOX') === 'true' ? "D7DaC<*E*eG" : config('BKASH_PASSWORD'),
            "APP_KEY" => config('BKASH_SANDBOX') === 'true' ? "0vWQuCRGiUX7EPVjQDr0EUAYtc" : config('BKASH_APP_KEY'),
            "APP_SECRET" => config('BKASH_SANDBOX') === 'true' ? "jcUNPBgbcqEDedNKdvE4G1cAK7D3hCjmJccNPZZBq96QIxxwAMEx" : config('BKASH_APP_SECRET'),
            "CALLBACK_URL" => config('BKASH_SANDBOX') === 'true' ? "http://localhost:8000/bkash" : config('BKASH_CALLBACK_URL'),
        ];
    }

    // nagad config
    public static function NagadConfig()
    {
        return (object) [
            "BASE_URL" => config('NAGAD_SANDBOX') === 'true' ? "http://sandbox.mynagad.com:10080/remote-payment-gateway-1.0/api/dfs" : config('NAGAD_BASE_URL'),
            "ACCOUNT" => config('NAGAD_SANDBOX') === 'true' ? "01711428036" : config('NAGAD_ACCOUNT'),
            "MERCHANTID" => config('NAGAD_SANDBOX') === 'true' ? "683002007104225" : config('NAGAD_MERCHANTID'),
            "PG_PUBLIC_KEY" => config('NAGAD_SANDBOX') === 'true' ? "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAjBH1pFNSSRKPuMcNxmU5jZ1x8K9LPFM4XSu11m7uCfLUSE4SEjL30w3ockFvwAcuJffCUwtSpbjr34cSTD7EFG1Jqk9Gg0fQCKvPaU54jjMJoP2toR9fGmQV7y9fz31UVxSk97AqWZZLJBT2lmv76AgpVV0k0xtb/0VIv8pd/j6TIz9SFfsTQOugHkhyRzzhvZisiKzOAAWNX8RMpG+iqQi4p9W9VrmmiCfFDmLFnMrwhncnMsvlXB8QSJCq2irrx3HG0SJJCbS5+atz+E1iqO8QaPJ05snxv82Mf4NlZ4gZK0Pq/VvJ20lSkR+0nk+s/v3BgIyle78wjZP1vWLU4wIDAQAB" : config('NAGAD_MERCHANT_PG_PUBLIC_KEY'),
            "PRIVATE_KEY" => config('NAGAD_SANDBOX') === 'true' ? "MIIEvAIBADANBgkqhkiG9w0BAQEFAASCBKYwggSiAgEAAoIBAQCJakyLqojWTDAVUdNJLvuXhROV+LXymqnukBrmiWwTYnJYm9r5cKHj1hYQRhU5eiy6NmFVJqJtwpxyyDSCWSoSmIQMoO2KjYyB5cDajRF45v1GmSeyiIn0hl55qM8ohJGjXQVPfXiqEB5c5REJ8Toy83gzGE3ApmLipoegnwMkewsTNDbe5xZdxN1qfKiRiCL720FtQfIwPDp9ZqbG2OQbdyZUB8I08irKJ0x/psM4SjXasglHBK5G1DX7BmwcB/PRbC0cHYy3pXDmLI8pZl1NehLzbav0Y4fP4MdnpQnfzZJdpaGVE0oI15lq+KZ0tbllNcS+/4MSwW+afvOw9bazAgMBAAECggEAIkenUsw3GKam9BqWh9I1p0Xmbeo+kYftznqai1pK4McVWW9//+wOJsU4edTR5KXK1KVOQKzDpnf/CU9SchYGPd9YScI3n/HR1HHZW2wHqM6O7na0hYA0UhDXLqhjDWuM3WEOOxdE67/bozbtujo4V4+PM8fjVaTsVDhQ60vfv9CnJJ7dLnhqcoovidOwZTHwG+pQtAwbX0ICgKSrc0elv8ZtfwlEvgIrtSiLAO1/CAf+uReUXyBCZhS4Xl7LroKZGiZ80/JE5mc67V/yImVKHBe0aZwgDHgtHh63/50/cAyuUfKyreAH0VLEwy54UCGramPQqYlIReMEbi6U4GC5AQKBgQDfDnHCH1rBvBWfkxPivl/yNKmENBkVikGWBwHNA3wVQ+xZ1Oqmjw3zuHY0xOH0GtK8l3Jy5dRL4DYlwB1qgd/Cxh0mmOv7/C3SviRk7W6FKqdpJLyaE/bqI9AmRCZBpX2PMje6Mm8QHp6+1QpPnN/SenOvoQg/WWYM1DNXUJsfMwKBgQCdtddE7A5IBvgZX2o9vTLZY/3KVuHgJm9dQNbfvtXw+IQfwssPqjrvoU6hPBWHbCZl6FCl2tRh/QfYR/N7H2PvRFfbbeWHw9+xwFP1pdgMug4cTAt4rkRJRLjEnZCNvSMVHrri+fAgpv296nOhwmY/qw5Smi9rMkRY6BoNCiEKgQKBgAaRnFQFLF0MNu7OHAXPaW/ukRdtmVeDDM9oQWtSMPNHXsx+crKY/+YvhnujWKwhphcbtqkfj5L0dWPDNpqOXJKV1wHt+vUexhKwus2mGF0flnKIPG2lLN5UU6rs0tuYDgyLhAyds5ub6zzfdUBG9Gh0ZrfDXETRUyoJjcGChC71AoGAfmSciL0SWQFU1qjUcXRvCzCK1h25WrYS7E6pppm/xia1ZOrtaLmKEEBbzvZjXqv7PhLoh3OQYJO0NM69QMCQi9JfAxnZKWx+m2tDHozyUIjQBDehve8UBRBRcCnDDwU015lQN9YNb23Fz+3VDB/LaF1D1kmBlUys3//r2OV0Q4ECgYBnpo6ZFmrHvV9IMIGjP7XIlVa1uiMCt41FVyINB9SJnamGGauW/pyENvEVh+ueuthSg37e/l0Xu0nm/XGqyKCqkAfBbL2Uj/j5FyDFrpF27PkANDo99CdqL5A4NQzZ69QRlCQ4wnNCq6GsYy2WEJyU2D+K8EBSQcwLsrI7QL7fvQ==" : config('NAGAD_MERCHANT_PRIVATE_KEY'),
            "CALLBACK_URL" => config('NAGAD_SANDBOX') === 'true' ? "http://localhost:8000/nagad" : config('NAGAD_CALLBACK_URL'),
            "COMPANY_NAME" => config('COMPANY_NAME'),
            "COMPANY_LOGO" => config('COMPANY_LOGO'),
        ];
    }

    // get ip address
    public static function getIpAddress()
    {
        if (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif (isset($_SERVER['HTTP_X_FORWARDED'])) {
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        } elseif (isset($_SERVER['HTTP_FORWARDED_FOR'])) {
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        } elseif (isset($_SERVER['HTTP_FORWARDED'])) {
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        } elseif (isset($_SERVER['REMOTE_ADDR'])) {
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        } else {
            $ipaddress = 'UNKNOWN IP';
        }

        return $ipaddress;
    }

    public static function PostRequest(string $url, array $headers, string $body, array $options = [])
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

        if (!empty($options)) {
            curl_setopt_array($ch, $options);
        }

        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    public static function GetRequest($url)
    {
        $ch = curl_init();
        $timeout = 10;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/0 (Windows; U; Windows NT 0; zh-CN; rv:3)");
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    // NAGAD only ======
    public static function encryptDataWithPublicKey(string $data, string $pgPublicKey)
    {
        $publicKey = "-----BEGIN PUBLIC KEY-----\n" . $pgPublicKey . "\n-----END PUBLIC KEY-----";
        $keyResource = openssl_get_publickey($publicKey);
        $status = openssl_public_encrypt($data, $cryptoText, $keyResource);
        if ($status) {
            return base64_encode($cryptoText);
        }

        return response(false, "Invalid Public key. Check Public Key in Configuration", null);
    }

    public static function signatureGenerate(string $data, string $merchantPrivateKey)
    {
        $privateKey = "-----BEGIN RSA PRIVATE KEY-----\n" . $merchantPrivateKey . "\n-----END RSA PRIVATE KEY-----";
        $status = openssl_sign($data, $signature, $privateKey, OPENSSL_ALGO_SHA256);
        if ($status) {
            return base64_encode($signature);
        }

        return response(false, "Invalid private key. Check Private Key in Configuration", null);
    }

    public static function decryptDataWithPrivateKey(string $cryptoText, string $merchantPrivateKey)
    {
        $private_key = "-----BEGIN RSA PRIVATE KEY-----\n" . $merchantPrivateKey . "\n-----END RSA PRIVATE KEY-----";
        openssl_private_decrypt(base64_decode($cryptoText), $plain_text, $private_key);
        return $plain_text;
    }

    public static function NagadException($response)
    {
        $errorMap = [
            "16_0006_004" => "Provided merchant ID is invalid",
            "16_0006_052" => "Invalid Merchant",
            "16_0006_053" => "Inactive Merchant",
            "16_0006_056" => "Encryption failed",
            "16_0006_057" => "Decryption failed",
            "16_0006_058" => "Failed to verify signature",
            "16_0006_059" => "Invalid Sensitive Data",
            "16_0006_060" => "Error processing sensitive data",
            "16_0006_061" => "Invalid merchant key",
            "16_0006_064" => "Mandatory Header Missing",
            "16_0006_068" => "Invalid Order Id",
            "16_0006_075" => "Could not persist data to storage",
            "16_0006_076" => "Transaction Date Time Not in allowed window",
            "16_0006_080" => "Invalid Currency Code",
            "16_0006_081" => "Invalid Date Time Format",
            "16_0006_083" => "Duplicate Order ID in same day",
            "16_0006_999" => "Invalid Request",
            "16_0006_017" => "Purchase information state is invalid",
            "16_0006_040" => "Invalid encrypted request type",
            "16_0006_050" => "Provided merchant ID is invalid",
            "16_0006_055" => "Invalid Payment Reference Id",
            "16_0006_069" => "Data not encoded",
        ];

        if (isset($response['reason']) && array_key_exists($response['reason'], $errorMap)) {
            $message = $errorMap[$response['reason']];
            $status = $response['reason'];
            return response(true, "[$status] $message", $response);
        }
        return response(false, "No error found", $response);
    }
}
