<?php
return [
    'Cookie' => [
        'enabled' => true,
        'name' => 'Swivel_Bucket',
        'expire' => 0,
        'path' => '/',
        'domain' => env('HTTP_HOST'),
        'secure' => false,
        'httpOnly' => false
    ],
    'BucketIndex' => null,
    'LoaderAlias' => \Webkod3r\LaravelSwivel\SwivelLoader::class,
    'Logger' => null,
    'Metrics' => null,
    'ModelAlias' => \Webkod3r\LaravelSwivel\Entity\SwivelFeature::class,
];
