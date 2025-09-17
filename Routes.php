<?php

use Controllers\Index;

return [
    // basic routes |=========
    [
        "url" => "/",
        "name" => "home",
        "controller" => Index::class,
        "method" => "home"
    ],
    [
        "url" => "/bkash",
        "name" => "bkash",
        "controller" => Index::class,
        "method" => "bkash"
    ],
    [
        "url" => "/nagad",
        "name" => "nagad",
        "controller" => Index::class,
        "method" => "nagad"
    ],
];
