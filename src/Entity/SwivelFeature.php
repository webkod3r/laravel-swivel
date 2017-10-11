<?php

namespace Webkod3r\LaravelSwivel\Entity;

use Illuminate\Database\Eloquent\Model;

class SwivelFeature extends Model implements SwivelModelInterface {

    /**
     * Return an array of map data in the format that Swivel expects
     *
     * @return array
     */
    public function getMapData() {
        return [
            'CoolFeature' => ['1, 2, 3, 4'],
            'CoolFeature.Second' => [5,6,7,8,9,10],
        ];
    }
}
