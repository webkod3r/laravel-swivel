<?php

namespace Webkod3r\LaravelSwivel\Entity;

use Illuminate\Container\Container;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

/**
 * Class SwivelFeature
 *
 * @package Webkod3r\LaravelSwivel\Entity
 * @property integer $id
 * @property string $slug
 * @property string $buckets
 * @property \DateTime $created_at
 * @property \DateTime $updated_at
 */
class SwivelFeature extends Model implements SwivelModelInterface {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'swivel_features';

    const SWIVEL_MAP_CACHE_KEY = 'swivel_features_map';
    const DELIMITER = ',';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['slug', 'buckets'];

    /**
     * Mockable function to access the container
     *
     * @return Container
     */
    protected function getContainer()
    {
        return Container::getInstance();
    }

    /**
     * Return an array of map data in the format that Swivel expects
     *
     * @return array Array containing the mapping between the features and buckets
     * <pre>
     * return [
     *  'TopupProviders' => [1,2,3,4,5,6,7,8,9,10],
     *  'TopupProviders.Multiple' => [1,2,3,4,5],
     * ]
     * </pre>
     */
    public function getMapData() {
        // load configuration settings
        $config = (array)$this->getContainer()->make('config')->get('swivel');

        if (empty($config)) {
            Log::warning('Swivel config not found.');
            $config['cache_key'] = '';
            $config['cache_duration'] = 0;
        }

        return Cache::remember($config['cache_key'], $config['cache_duration'], function () {
            $features = self::all();
            if ($features->count() === 0) {
                return [];
            } else {
                return call_user_func_array('array_merge', array_map([$this, 'formatRow'], $features->toArray()));
            }
            return $features;
        });
    }

    /**
     * Format data from database to the data swivel expects
     *
     * @param array $feature
     * @return array
     */
    protected function formatRow(array $feature) {
        if (!empty($feature['id'])) {
            return [$feature['slug'] => explode(static::DELIMITER, $feature['buckets'])];
        }
        return [];
    }
}
