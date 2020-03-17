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
        
		$this->publishes([
		__DIR__.'/../resources/config/irfa/rajaongkir.php' => config_path('irfa/rajaongkir.php')],'raja-ongkir');

		$this->publishes([
		__DIR__.'/../database/migrations/' => database_path('migrations')
			], 'raja-ongkir'); 

		$this->publishes([ __DIR__.'/../database/migrations/' =>  database_path('migrations')
			], 'raja-ongkir');

		$this->publishes([ __DIR__.'/../console/' =>  app_path('console')
			], 'raja-ongkir');
       
        
	}
}
