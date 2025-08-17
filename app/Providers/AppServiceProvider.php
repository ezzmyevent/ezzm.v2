<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use DB;
use View, Cookie;
use Illuminate\Pagination\Paginator;
use App\Models\Interfaces;
use Illuminate\Support\Facades\Schema;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */

    public function boot()
    {
        // Avoid hitting database or request context while running in console
        // (e.g., composer dump-autoload, artisan commands, package:discover)
        if ($this->app->runningInConsole()) {
            return;
        }

        $master_setting['currentURL'] = request()->segments();

        $settings = null;
        try {
            if (Schema::hasTable('events')) {
                $settings = DB::table('events')->where('id', 1)->first();
            }
        } catch (\Throwable $e) {
            // Swallow any DB errors during web boot to keep app responsive
            $settings = null;
        }

        $master_setting['settings'] = $settings;

        View::share('master_setting', $master_setting);
    }


    public function register()
    {
        //
    }


}
