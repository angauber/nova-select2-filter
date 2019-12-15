<?php

namespace Angauber\NovaSelect2Filter;

use Laravel\Nova\Nova;
use Laravel\Nova\Events\ServingNova;
use Illuminate\Support\ServiceProvider;

class FilterServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Nova::serving(function (ServingNova $event) {
            Nova::script('nova-select2-filter', __DIR__.'/../dist/js/filter.js');
            Nova::style('nova-select2-filter', __DIR__.'/../dist/css/filter.css');
	});
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
}
