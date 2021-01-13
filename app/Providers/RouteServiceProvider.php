<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{

    /** @var string Namespace for API routes */
    protected $sApiNameSpace = 'App\Http\Controllers\Api';

    /** @var string Namespace for APP Admin routes */
    protected $sAppAdminNameSpace = 'App\Http\Controllers\App\Admin';

    /** @var string Namespace for APP Front routes */
    protected $sAppFrontNameSpace = 'App\Http\Controllers\App\Front';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiV1Routes();

        $this->mapAdminRoutes();

        $this->mapFrontRoutes();
    }

    /**
     * Define the "admin" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapAdminRoutes()
    {
        Route::domain(env('APP_ROUTE'))
            ->middleware('web')
            ->namespace($this->sAppAdminNameSpace)
            ->group(base_path('routes/app/admin.php'));
    }

    /**
     * Define the "front" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapFrontRoutes()
    {
        Route::domain(env('APP_ROUTE'))
            ->middleware('web')
            ->namespace($this->sAppFrontNameSpace)
            ->group(base_path('routes/app/front.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiV1Routes()
    {
        Route::domain(env('API_ROUTE'))
            ->prefix('v1')
            ->middleware('api')
            ->namespace($this->sApiNameSpace . '\v1')
            ->group(base_path('routes/api/api_v1.php'));
    }
}
