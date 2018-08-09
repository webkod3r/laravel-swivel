<?php

namespace Webkod3r\LaravelSwivel\Entity;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

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

    protected $table = 'swivel_features';

    const TABLE_NAME = 'swivel_features';
    const SWIVEL_MAP_CACHE_KEY = 'swivel_features_map';
    const DELIMITER = ',';

    protected $fillable = ['slug', 'buckets'];

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
        $config = (array)config('swivel');

        if (Cache::has($config['cache_key'])) {
            return Cache::get($config['cache_key']);
        } else {
            $features = self::all();
            if ($features->count() === 0) {
                $map = [];
            } else {
                $map = call_user_func_array('array_merge', array_map([$this, 'formatRow'], $features->toArray()));
            }

            Cache::add($config['cache_key'], $map, $config['cache_duration']);
            return $map;
        }
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
