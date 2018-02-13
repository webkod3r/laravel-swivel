<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Swivel Bucket Index
    |--------------------------------------------------------------------------
    |
    | Defines the index desired by default in the environment and the one will
    | define the expected behavior
    |
    */
    'bucket_index' => env('SWIVEL_BUCKET_INDEX', 1),

    /*
    |--------------------------------------------------------------------------
    | Loader Class
    |--------------------------------------------------------------------------
    |
    | Defines the class used to load the swivel feature and handle the behavior
    |
    */
    'loader_class' => env('SWIVEL_LOADER_CLASS', \Webkod3r\LaravelSwivel\SwivelLoader::class),

    /*
    |--------------------------------------------------------------------------
    | Model Class
    |--------------------------------------------------------------------------
    |
    | Defines the class used to load features from Database
    |
    */
    'model_class' => env('SWIVEL_MODEL_CLASS', \Webkod3r\LaravelSwivel\Entity\SwivelFeature::class),

    /*
    |--------------------------------------------------------------------------
    | Logger Class
    |--------------------------------------------------------------------------
    */
    'logger_class' => env('SWIVEL_LOGGER_CLASS', 'Psr\Log\LoggerInterface'),

    /*
    |--------------------------------------------------------------------------
    | Use Cookies
    |--------------------------------------------------------------------------
    |
    | Defines if the app should use cookies to store the current bucket
    |
    */
    'cookie_enabled' => env('SWIVEL_COOKIE_ENABLED', true),

    /*
    |--------------------------------------------------------------------------
    | Cookie name
    |--------------------------------------------------------------------------
    */
    'cookie_name' => env('SWIVEL_COOKIE_NAME', 'Swivel_Bucket'),

    /*
    |--------------------------------------------------------------------------
    | Cookie Expire Time
    |--------------------------------------------------------------------------
    */
    'cookie_expire' => env('SWIVEL_COOKIE_EXPIRE', 0),
    'cookie_path' => env('SWIVEL_COOKIE_PATH', '/'),
    'cookie_domain' => env('SWIVEL_COOKIE_DOMAIN', env('HTTP_HOST')),
    'cookie_secure' => env('SWIVEL_COOKIE_SECURE', true),
    'cookie_http_only' => env('SWIVEL_COOKIE_HTTP_ONLY', false),
];
