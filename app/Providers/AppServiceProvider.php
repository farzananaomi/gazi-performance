<?php

namespace GaziWorks\Performance\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(\Maatwebsite\Excel\ExcelServiceProvider::class);
        $this->app->register(\Intervention\Image\ImageServiceProvider::class);
        $this->app->register(\Rap2hpoutre\LaravelLogViewer\LaravelLogViewerServiceProvider::class);

        // Facades
        $this->app->alias('Image', \Intervention\Image\Facades\Image::class);
        $this->app->alias('Excel', \Maatwebsite\Excel\Facades\Excel::class);


        if (app()->environment() != 'production') {
            // Service Providers
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
            $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
            // Facades
            $this->app->alias('Debugbar', \Barryvdh\Debugbar\Facade::class);
        }
    }
}
