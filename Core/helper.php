<?php

// quick response
function response(bool $success, string $message, $data): array
{
    return [
        'success' => $success,
        'message' => $message,
        'data' => $data
    ];
}

// quick show response
function showResponse(array $data)
{
    echo "<pre>";
    print_r($data);
    echo "</pre>";
    exit;
}

// generate order id
function generateOrderId()
{
    // id generate
    $id = date('YmdHis', time());
    return $id;
}
