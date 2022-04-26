<?php

declare(strict_types=1);

namespace LaravelSwivel\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use LaravelSwivel\Entity\SwivelFeature;
use LaravelSwivel\Facades\Swivel;
use LaravelSwivel\Tests\TestCase;

class SwivelFacadeTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Setup test suite
     *
     * @return void
     */
    protected function setUp()
    {
        parent::setUp();

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
    }

    /**
     * Get package providers.
     *
     * @param  \Illuminate\Foundation\Application $app App instance.
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return array_merge(parent::getPackageProviders($app), [
            'LaravelSwivel\SwivelServiceProvider',
        ]);
    }

    /**
     * Set of data for testing the facade
     *
     * @return array
     */
    public function facadeBucketDataProvider(): array
    {
        return [
            'Feature enabled' => [
                'bucket' => 1,
                'result' => true,
            ],
            'Feature disabled' => [
                'bucket' => 5,
                'result' => false,
            ],
        ];
    }

    /**
     * Testing mapped features
     *
     * @param int  $bucket  Expected bucket request.
     * @param bool $enabled The way the system should respond with the strategy.
     * @return void
     * @dataProvider facadeBucketDataProvider
     */
    public function testFacadeEnabledBucket(int $bucket, bool $enabled)
    {
        /** @var Request */
        $request = $this->app->make(Request::class);
        $request->headers->set('Bucket', $bucket);

        $this->assertEquals($enabled, Swivel::returnValue('demo.featureA', true, false));
    }
}
