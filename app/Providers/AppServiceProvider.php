<?php

namespace App\Providers;

use App\Models\Settings;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //$data['settingss'] = Settings::all();
        if (isset($data['settingss'])){
            foreach ($data['settingss'] as $key){
                $settingss[$key->setting_key]=$key->setting_value;
            }
            view()->share($settingss);
        }
    }
}
