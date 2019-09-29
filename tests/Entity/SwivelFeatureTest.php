<?php

namespace Tests\Webkod3r\LaravelSwivel\Entity;

use Illuminate\Container\Container;
use Webkod3r\LaravelSwivel\Entity\SwivelFeature;

class SwivelFeatureTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var SwivelFeature
     */
    private $model;

    protected function setUp()
    {
        parent::setUp();

        $this->model = new SwivelFeature();

        Container::getInstance()->make('config')->set(['swivel.cache_key' => 'test-cache-key']);
        //config(['swivel.cache_duration' => 2]);
    }

    public function testGetMapData()
    {
        $expected = [
            ['demo' => [1,2,3,4,5]],
        ];

        $this->model = $this->getMockBuilder(SwivelFeature::class)
            ->setMethods(['all'])
            ->getMock();

        $this->model->expects($this->exactly(1))
            ->method('all')
            ->will($this->returnValue(new \DateTime()));

        $result = $this->model->getMapData();

        $this->assertEquals($expected, $result);
    }
}
