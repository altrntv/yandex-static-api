<?php

namespace Tests;

use Altrntv\YandexStaticApi\StaticApiProvider;
use Illuminate\Foundation\Application;

class TestCase extends \Orchestra\Testbench\TestCase
{
    /**
     * @param Application $app
     *
     * @return array<int, class-string>
     */
    protected function getPackageProviders($app): array
    {
        return [
            StaticApiProvider::class,
        ];
    }

    /**
     * @param Application $app
     */
    protected function defineEnvironment($app): void
    {
        $app['config']->set('yandex-static-api.api_key', 'test-key');
    }
}
