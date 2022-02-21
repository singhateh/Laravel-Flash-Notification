<?php

namespace Jambasangsang\Flash;

use Illuminate\Container\Container;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;


class FlashNotificationServiceProvider extends ServiceProvider
{

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'flash');
        $this->registerBladeDirectives();

        $this->publishes([
            __DIR__ . '/config/flash.php' => config_path('flash.php'),
            __DIR__ . '/resources/views' => resource_path('views/vendor/flash'),
            __DIR__ . '/public' => public_path('vendor'),
        ], 'flash-config');
    }


    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/config/flash.php', 'flash');

        $this->app->singleton('flash', function (Container $app) {
            return new LaravelFlash($app['session'], $app['config']);
        });

        $this->app->alias('LaravelFlash', LaravelFlash::class);
        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('LaravelFlash', "Jambasangsang\\Flash\\Facades\\LaravelFlash");
    }


    public function registerBladeDirectives()
    {
        Blade::directive('flashRender', function () {
            return "<?php echo app('flash')->render(); ?>";
        });

        Blade::directive('flashStyle', function () {
            if (config(('app.env')) === 'local') {
                return "<link rel='stylesheet' href='https://raw.githack.com/singhateh/Flash/main/flash.min.css'>";
            } else {
                return "<link rel='stylesheet' href='https://rawcdn.githack.com/singhateh/Flash/e32d7e7a04e0add81da4ae766137d9037aefdb63/flash.min.css'>";
            }
        });

        Blade::directive('flashScript', function () {
            if (config(('app.env')) === 'local') {
                return '<script src="https://raw.githack.com/singhateh/Flash/main/flash.min.js"></script>';
            } else {
                return "<link rel='stylesheet'href='https://rawcdn.githack.com/singhateh/Flash/403e0ccb17a422b88f69bc4db1ee62997f80324b/flash.min.js'>";
            }
        });

        Blade::directive('jQuery', function () {
            return '<script src="https://rawcdn.githack.com/singhateh/Flash/4e39a43140a2c69f061451bd1263628123ae912b/jQuery.min.js"></script>';
        });
    }


    public function provides()
    {
        return [
            'flash',
        ];
    }
}
