<?php

namespace Pixney\StatamicInstagramUserFeed;

use Statamic\Providers\AddonServiceProvider;
use Pixney\StatamicInstagramUserFeed\Tags\StatamicInstagramUserFeed;

class ServiceProvider extends AddonServiceProvider
{
    protected $publishAfterInstall = false;

    protected $tags = [
        StatamicInstagramUserFeed::class
    ];

    protected $routes = [
        'web'     => __DIR__ . '/../routes/web.php',
    ];

    public function register()
    {
        parent::register();

        $this->mergeConfigFrom(__DIR__ . '/../config/statamic-instagram-user-feed.php', 'statamic-instagram-user-feed');
    }

    public function boot()
    {
        parent::boot();

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/statamic-instagram-user-feed'),
        ], 'statamic-instagram-user-feed-views');

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'statamic-instagram-user-feed');
    }
}
