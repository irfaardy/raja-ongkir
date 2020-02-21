<?php

namespace Irfa\RajaOngkir;

use Illuminate\Support\ServiceProvider;

class RajaOngkirServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
         $this->loadRoutesFrom(__DIR__.'/routes.php');
        $this->publishes([
        __DIR__.'/../resources/config/irfa/rajaongkir.php' => config_path('irfa/rajaongkir.php'),
    ]);
        
    }
}
