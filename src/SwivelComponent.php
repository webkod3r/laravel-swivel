<?php

namespace Webkod3r\LaravelSwivel;

use Illuminate\Http\Request as IlluminateRequest;

class SwivelComponent {
    /**
     * @var SwivelLoader
     */
    protected $loader;

    /**
     * Request object.
     *
     * @var IlluminateRequest
     */
    public $request;

    public function __construct(IlluminateRequest $request) {
        $this->request = $request;
        $swivelOptions = (array)config('swivel');
        $swivelOptions['BucketIndex'] = !empty($swivelOptions['BucketIndex'])
            ? $swivelOptions['BucketIndex']
            : $request->header('Bucket', rand(1, 9));
        $swivelLoader = $swivelOptions['LoaderAlias'];
        if(empty($swivelLoader)){
            throw new \InvalidArgumentException('Loader alias expected');
        }
        $this->loader = new $swivelLoader($swivelOptions);
    }

    /**
     * Create a new Builder instance
     *
     * @param string $slug
     * @return \Zumba\Swivel\Builder
     */
    public function forFeature($slug)
    {
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
    public function invoke($slug, $a, $b = null)
    {
        return $this->loader->getManager()->invoke($slug, $a, $b);
    }

    /**
     * Shorthand syntactic sugar for invoking a simple feature behavior using Builder::addValue.
     * Useful for ternary style code.
     *
     * @param $slug
     * @param $a
     * @param null $b
     *
     * @return mixed
     */
    public function returnValue($slug, $a, $b=null) {
        return $this->loader->getManager()->returnValue($slug, $a, $b);
    }
}
