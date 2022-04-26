<?php

declare(strict_types=1);

namespace LaravelSwivel\Tests\Entity;

use Illuminate\Foundation\Testing\RefreshDatabase;
use LaravelSwivel\Entity\SwivelFeature;
use LaravelSwivel\Tests\TestCase;

class SwivelFeatureTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var SwivelFeature
     */
    private $model;

    /**
     * Testing mapped features
     *
     * @return void
     */
    public function testGetMapData()
    {
        // insert swivel records
        SwivelFeature::create([
            'id' => 1,
            'slug' => 'demo',
            'buckets' => '1,2,3,4,5, 10',
        ]);
        SwivelFeature::create([
            'id' => 1,
            'slug' => 'demo.featureA',
            'buckets' => '1,10',
        ]);

        $expected = [
            'demo' => [1,2,3,4,5,10],
            'demo.featureA' => [1,10],
        ];

        $model = new SwivelFeature();

        $result = $model->getMapData();

        $this->assertEquals($expected, $result);
    }
}
