<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\cms_settings;
use File;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
		
        $location1 = storage_path('app/uploads/1/'.date('Y').'-'.date('m'));
          if(!File::exists($location1)){

                File::makeDirectory($location1, 0777, true, true);
              }else{
              
              }

        
        $this->app['request']->server->set('HTTPS', true);
        \URL::forceScheme('https');

        //\URL::forceScheme('https');

        /*if(config('app.env') === 'production') {
            \URL::forceScheme('https');
        } */       
        //=========site settings========
        $settings = cms_settings::all();

        //$settings_arr = array();

        foreach ($settings as $setting) {
            config()->set('settings.' . $setting->name , $setting->content);
        }
        //=========site settings========
        
		view()->composer('partial.header_new', 'App\Http\ViewComposers\HeaderloginComposer');
        view()->composer('partial.userleftsidebar', 'App\Http\ViewComposers\UserleftComposer');
        view()->composer('partial.footer', 'App\Http\ViewComposers\FooterComposer');
		
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
