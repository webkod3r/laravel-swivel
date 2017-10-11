<?php

namespace Webkod3r\LaravelSwivel\Entity;

interface SwivelModelInterface {
    /**
     * Return an array of map data in the format that Swivel expects
     *
     * @return array
     */
    public function getMapData();
}
