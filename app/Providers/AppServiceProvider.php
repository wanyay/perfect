<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;
use App\Sale;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        Blade::withoutDoubleEncoding();

        Builder::macro('today',function($column = 'created_at'){
            $this->query->whereDate($column,Carbon::now()->toDateString());
            return $this;
        });

        Builder::macro('month',function($month,$year,$column = 'created_at'){
            $this->query->whereMonth($column,$month)->whereYear($column,$year);
            return $this;
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
