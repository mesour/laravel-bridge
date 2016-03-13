<?php
/**
 * This file is part of the Mesour Laravel Bridges (http://components.mesour.com/version3/bridges/laravel)
 *
 * Copyright (c) 2016 Matouš Němec (http://mesour.com)
 *
 * For full licence and copyright please view the file licence.md in root of this project
 */

namespace Mesour\Bridges\Laravel;

use Illuminate\Support\ServiceProvider;

class ApplicationServiceProvider extends ServiceProvider
{

	/**
	 * Register bindings in the container.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->singleton(
			ApplicationManager::class,
			function ($app) {
				return new ApplicationManager(config('mesour_app'));
			}
		);
	}

}