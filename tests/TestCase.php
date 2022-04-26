<?php

namespace LaravelSwivel\Tests;

use Illuminate\Contracts\Foundation\Application;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    /**
     * Override app setup
     *
     * @return void
     */
    protected function setUp()
    {
        parent::setUp();
        $this->defineDatabaseMigrations();
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application $app App instance.
     * @return void
     */
    protected function defineEnvironment(Application $app)
    {
        $app['config']->set('swivel.cache_key', 'test-cache-key');

        $app['config']->set('app.timezone', 'UTC');
        $app['config']->set('database.default', 'testing');
    }

    /**
     * Define database migrations.
     *
     * @return void
     */
    protected function defineDatabaseMigrations()
    {
        $this->loadMigrationsFrom(realpath(__DIR__ . '/../src/database/migrations'));
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
        return [
            // @see: https://github.com/orchestral/testbench/issues/155#issuecomment-278019944
            'Orchestra\Database\ConsoleServiceProvider',
        ];
    }

    /**
     * Sets a protected property on a given object via reflection class
     *
     * @param $object   - instance in which protected value is being modified
     * @param $property - property on instance being modified
     * @param $value    - new value of the property being modified
     * @return void
     */
    protected function setProtectedProperty($object, $property, $value)
    {
        $reflection = new \ReflectionClass($object);
        $reflection_property = $reflection->getProperty($property);
        $reflection_property->setAccessible(true);
        $reflection_property->setValue($object, $value);
    }

    /**
     * Call protected/private method of a class.
     *
     * @param mixed  $object     Instantiated object that we will run method on.
     * @param string $methodName Method name to call
     * @param array  $parameters Array of parameters to pass into method.
     *
     * @return mixed Method return.
     */
    protected function invokeMethod(&$object, $methodName, array $parameters = [])
    {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }
}
