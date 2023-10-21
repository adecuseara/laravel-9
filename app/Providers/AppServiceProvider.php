<?php

namespace App\Providers;

use App\Utilities\Contracts\ElasticsearchHelper;
use App\Utilities\Contracts\RedisHelper;
use App\Utilities\ElasticsearchHelperImplementation;
use App\Utilities\RedisHelperImplementation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ElasticsearchHelper::class, ElasticsearchHelperImplementation::class);
        $this->app->bind(RedisHelper::class, RedisHelperImplementation::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    }
}
