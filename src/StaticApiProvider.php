<?php

namespace Altrntv\YandexStaticApi;

use Illuminate\Support\ServiceProvider;

class StaticApiProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->configurePaths();

        $this->mergeConfig();
    }

    private function configurePaths(): void
    {
        $this->publishes([
            __DIR__ . '/../config/yandex-static-api.php' => config_path('yandex-static-api.php'),
        ]);
    }

    private function mergeConfig(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/yandex-static-api.php', 'yandex-static-api');
    }
}
