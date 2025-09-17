<?php

use Dotenv\Dotenv;

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->safeLoad();

return [
    "host" => $_ENV['DB_HOST'],
    "user" => $_ENV['DB_USER'],
    "pass" => $_ENV['DB_PASS'],
    "db_name" => $_ENV['DB_NAME'],
    "subdirectory" => $_ENV['APP_SUB_URL'],
    "app_url" => $_ENV['APP_URL'],
    "public_url" => $_ENV['PUBLIC_URL'],
    "BKASH_SANDBOX" => $_ENV['BKASH_SANDBOX'],
    "BKASH_VERSION" => $_ENV['BKASH_VERSION'],
    "BKASH_APP_KEY" => $_ENV['BKASH_APP_KEY'],
    "BKASH_APP_SECRET" => $_ENV['BKASH_APP_SECRET'],
    "BKASH_USERNAME" => $_ENV['BKASH_USERNAME'],
    "BKASH_PASSWORD" => $_ENV['BKASH_PASSWORD'],
    "BKASH_CALLBACK_URL" => $_ENV['BKASH_CALLBACK_URL'],
    "BKASH_BASE_URL" => $_ENV['BKASH_BASE_URL'],
    "NAGAD_SANDBOX" => $_ENV['NAGAD_SANDBOX'],
    "NAGAD_ACCOUNT" => $_ENV['NAGAD_ACCOUNT'],
    "NAGAD_MERCHANTID" => $_ENV['NAGAD_MERCHANTID'],
    "NAGAD_MERCHANT_PG_PUBLIC_KEY" => $_ENV['NAGAD_MERCHANT_PG_PUBLIC_KEY'],
    "NAGAD_MERCHANT_PRIVATE_KEY" => $_ENV['NAGAD_MERCHANT_PRIVATE_KEY'],
    "NAGAD_CALLBACK_URL" => $_ENV['NAGAD_CALLBACK_URL'],
    "NAGAD_BASE_URL" => $_ENV['NAGAD_BASE_URL'],
    "COMPANY_NAME" => $_ENV['COMPANY_NAME'],
    "COMPANY_LOGO" => $_ENV['COMPANY_LOGO'],
];
