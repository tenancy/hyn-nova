<?php

namespace Tenancy\HynNova;

use Laravel\Nova\Nova;
use Laravel\Nova\Events\ServingNova;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Tenancy\HynNova\Http\Middleware\Authorize;
use Tenancy\HynNova\Observers\HostnameObserver;
use Tenancy\HynNova\Observers\WebsiteObserver;
use Tenancy\HynNova\Resources\Hostname;
use Tenancy\HynNova\Resources\Tenant;

class ToolServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'hyn-nova');

//        $this->app->booted(function () {
//            $this->routes();
//        });

        Nova::serving(function (ServingNova $event) {
            Nova::resources([
                Tenant::class,
                Hostname::class
            ]);
        });

        $this->bootObservers();
    }

    /**
     * Register the tool's routes.
     *
     * @return void
     */
    protected function routes()
    {
        if ($this->app->routesAreCached()) {
            return;
        }

        Route::middleware(['nova', Authorize::class])
                ->prefix('tenancy')
                ->group(__DIR__.'/../routes/api.php');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    public function bootObservers()
    {
        $config = $this->app['config']['tenancy.models'];

        forward_static_call([$config['website'], 'observe'], WebsiteObserver::class);
        forward_static_call([$config['hostname'], 'observe'], HostnameObserver::class);
    }
}
