<?php

namespace App\Providers;

use App\Models\Base;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(Base::DEFAULT_STRING_LENGTH);

        // Use Bootstrap 4 pagination views
        Paginator::$defaultView = 'pagination::bootstrap-4';
        Paginator::$defaultSimpleView = 'pagination::simple-bootstrap-4';
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
