<?php

$_SETTINGS = [
    'debug' => 1,
    'version' => '0.08A',
    'language'=>'ru',
    'DataBase' => [
        'dsn' => 'mysql:host=178.32.53.111;dbname=Vilay_Vehela',
        'user' => 'Vilay_VehelaUser',
        'password' => '12345678'
    ],
    'Plugins' => [
        'Preload' => [
            'Cache' => [
                'path' => 'caching/php_fast_cache.php'
            ]
        ],
        'Other' => [
            'CKEditor' => [
                'path' => 'caching/php_fast_cache.php'
            ]
        ],
    ]
];

?>