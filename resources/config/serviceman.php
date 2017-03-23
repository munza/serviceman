<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Generator Config
    |--------------------------------------------------------------------------
    |
    */
    'generator'  => [
        'basePath' => app_path(),
        'paths' => [
            'service'    => 'Services',
            'command'    => 'Services\\{{ service }}',
            'handler'    => 'Services\\{{ service }}',
            'middleware' => 'Services\\{{ service }}',
        ],
    ],

];
