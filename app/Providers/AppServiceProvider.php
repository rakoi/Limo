<?php

namespace App\Providers;
use App\Post;
use DB;
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
        $trends=DB::select("SELECT moviename FROM posts GROUP BY moviename ORDER BY COUNT(*) DESC LIMIT 10");
        view()->share('trends',$trends);

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
