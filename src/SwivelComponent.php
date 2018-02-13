<?php

namespace Webkod3r\LaravelSwivel;

use Illuminate\Http\Request as IlluminateRequest;

/**
 * @package Webkod3r\LaravelSwivel
 * @author Pablo Molina <web.kod3r@gmail.com>
 */
class SwivelComponent {

    /**
     * @var SwivelLoader
     */
    protected $loader;

    public function __construct(IlluminateRequest $request) {
        $config = (array)config('laravel-swivel');

        $swivelOptions = [
            'LoaderAlias' => $config['loader_class'],
            'ModelAlias' => $config['model_class'],
            'Logger' => app($config['logger_class']),
            'Metrics' => null,
        ];

        // always search for the header and fallback to default value configured
        $swivelOptions['BucketIndex'] = !empty($request->header('Bucket'))
            ? (int)$request->header('Bucket')
            : (int)$config['bucket_index'];

        if (empty($swivelOptions['LoaderAlias'])) {
            throw new \InvalidArgumentException('Loader alias expected');
        }

        if (!empty($config['cookie_enabled'])) {
            $cookie = [
                'enabled' => true,
                'name' => $config['cookie_name'],
                'expire' => (int)$config['cookie_expire'],
                'path' => $config['cookie_path'],
                'domain' => $config['cookie_domain'],
                'secure' => (boolean)$config['cookie_secure'],
                'httpOnly' => (boolean)$config['cookie_http_only'],
            ];
            $swivelOptions['Cookie'] = $cookie;
        }

        $this->loader = new $swivelOptions['LoaderAlias']($swivelOptions);
    }

    /**
     * Create a new Builder instance
     *
     * @param string $slug
     * @return \Zumba\Swivel\Builder
     */
    public function forFeature($slug) {
        return $this->loader->getManager()->forFeature($slug);
    }

    /**
     * Syntactic sugar for creating simple feature toggles (ternary style)
     *
     * @param string $slug
     * @param mixed $a
     * @param mixed $b
     * @return mixed
     */
    public function invoke($slug, $a, $b = null) {
        return $this->loader->getManager()->invoke($slug, $a, $b);
    }

    /**
     * Shorthand syntactic sugar for invoking a simple feature behavior using Builder::addValue.
     * Useful for ternary style code.
     *
     * @param $slug
     * @param $a
     * @param null $b
     * @return mixed
     */
    public function returnValue($slug, $a, $b = null) {
        return $this->loader->getManager()->returnValue($slug, $a, $b);
    }
}
