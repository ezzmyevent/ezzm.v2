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
        $master_setting['currentURL'] = request()->segments();
        // $settings = DB::table('events')->where('id', 1)->first();
        
   $settings = null;
    if (Schema::hasTable('events')) {
        try {
            $settings = DB::table('events')->where('id', 1)->first();
        } catch (\Exception $e) {
            $settings = null; // Prevent crash if something else fails
        }
    }

        $master_setting['settings'] = $settings;
        
        View::share('master_setting', $master_setting);
    }


    public function register()
    {
        //
    }


}
