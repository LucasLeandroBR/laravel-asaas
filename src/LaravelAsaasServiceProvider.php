<?php

namespace LucasLeandroBR\LaravelAsaas;

use Illuminate\Log\Logger;
use Illuminate\Support\ServiceProvider;
use Psr\Log\LoggerInterface;

class LaravelAsaasServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any package services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->registerMigrations();
        $this->registerPublishing();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->configure();
        $this->bindLogger();
    }

    /**
     * Setup the configuration for Cashier.
     *
     * @return void
     */
    protected function configure(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/config.php', 'asaas'
        );
    }

    /**
     * Bind the Stripe logger interface to the Cashier logger.
     *
     * @return void
     */
    protected function bindLogger(): void
    {
        $this->app->bind(LoggerInterface::class, function ($app) {
            return new Logger(
                $app->make('log')->channel(config('asaas.logger'))
            );
        });
    }

    /**
     * Register the package migrations.
     *
     * @return void
     */
    protected function registerMigrations(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }

    /**
     * Register the package's publishable resources.
     *
     * @return void
     */
    protected function registerPublishing(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => $this->app->configPath('asaas.php'),
            ], 'cashier-config');

            $this->publishes([
                __DIR__.'/../database/migrations' => $this->app->databasePath('migrations'),
            ], 'asaas-migrations');

//            $this->publishes([
//                __DIR__.'/../resources/views' => $this->app->resourcePath('views/vendor/asaas'),
//            ], 'asaas-views');
        }
    }
}
