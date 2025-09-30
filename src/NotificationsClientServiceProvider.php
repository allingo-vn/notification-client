<?php

namespace AllinGo\NotificationsClient;

use Illuminate\Support\ServiceProvider;
use AllinGo\NotificationsClient\Contracts\DispatcherInterface;
use AllinGo\NotificationsClient\Dispatchers\ExternalHttpDispatcher;
use AllinGo\NotificationsClient\Dispatchers\InternalLocalDispatcher;

class NotificationsClientServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/notifications_client.php',
            'notifications_client'
        );

        $this->app->bind(DispatcherInterface::class, function ($app) {
            $cfg  = $app['config']->get('notifications_client', []);
            $mode = $cfg['mode'] ?? 'external';

            return $mode === 'internal'
                ? new InternalLocalDispatcher($app, $cfg)
                : new ExternalHttpDispatcher($cfg);
        });

        $this->app->singleton(Notifier::class, fn($app) => new Notifier($app->make(DispatcherInterface::class)));
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/notifications_client.php' =>
                    $this->app->basePath('config/notifications_client.php'),
            ], 'config');
        }

        // Register alias for Laravel and Lumen with facades enabled
        if (method_exists($this->app, 'alias')) {
            $this->app->alias(
                \AllinGo\NotificationsClient\Facades\AllingoNotifier::class,
                'AllingoNotifier'
            );
        }
    }
}
