<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\ServiceProvider;

class checkSettingProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $getSetting = Setting::firstOr(function(){
            return Setting::create([
                'site_name' => 'My Site',
                'favicon' => 'defualt',
                'logo' => '/assets/frontend/img/logo.png',
                'email' => 'sendnw@gmail.com',
                'facebook' => 'https://www.facebook.com/',
                'instagram' => 'https://www.instagram.com/',
                'twitter' => 'https://x.com/',
                'youtube' => 'https://www.youtube.com/',
                'phone' => '01110524632',
                'country' => 'Egypt',
                'city' => 'Cairo',
                'street' => 'Ain shams',
                'small_description'=>'small description for SEO'
            ]);
        });
        $getSetting->wa = "https://wa.me/" . $getSetting->phone;
        view()->share([
            'getSetting' => $getSetting,
        ]);
    }
}
