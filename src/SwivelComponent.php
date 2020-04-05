<?php

namespace LaravelSwivel;

use Illuminate\Http\Request;

/**
 * @package LaravelSwivel
 * @author Pablo Molina <web.kod3r@gmail.com>
 */
class SwivelComponent
{
    /**
     * @var \LaravelSwivel\SwivelLoader
     */
    protected $loader;

    /**
     * SwivelComponent constructor.
     * @param \Illuminate\Http\Request $request HTTP request to load the header from
     */
    public function __construct(Request $request)
    {
        $config = (array)config('swivel');

        $swivelOptions = [
            'LoaderAlias' => $config['loader_class'],
            'ModelAlias' => $config['model_class'],
            'Logger' => !empty($config['logger_class']) ? app($config['logger_class']) : null,
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
     * Get the loader instance to access it easily
     *
     * @return \LaravelSwivel\SwivelLoader
     */
    public function getLoader()
    {
        return $this->loader;
    }

    /**
     * Create a new Builder instance
     *
     * @param string $slug The feature domain slug
     * @return \Zumba\Swivel\Builder
     */
    public function forFeature($slug)
    {
        return $this->loader->getManager()->forFeature($slug);
    }

    /**
     * Syntactic sugar for creating simple feature toggles (ternary style)
     *
     * @param string $slug The feature slug to evaluate
     * @param mixed  $a    Clousure to execute if feature is enabled
     * @param mixed  $b    Clousure to execute if feature is disabled
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
     * @param string     $slug The feature slug to evaluate
     * @param mixed      $a    Value to return if feature is enabled
     * @param null|mixed $b    Value to return if feature is disabled
     * @return mixed
     */
    public function returnValue($slug, $a, $b = null)
    {
        return $this->loader->getManager()->returnValue($slug, $a, $b);
    }
}
