<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Tell Laravel the public folder is 'public_html' when deployed to cPanel
        if (is_dir(base_path('../public_html'))) {
            $this->app->usePublicPath(base_path('../public_html'));
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }

        if (!app()->runningInConsole()) {
            $globalSettings = Cache::rememberForever('global_settings', function () {
                return \App\Models\Setting::pluck('value', 'key')->toArray();
            });

            $companyProfile = Cache::rememberForever('company_profile', function () {
                return \App\Models\CompanyProfile::pluck('value', 'key')->toArray();
            });

            $globalSubsidiaries = Cache::rememberForever('global_subsidiaries', function () {
                return \App\Models\Subsidiary::select('name', 'slug')->get()->map(function($sub) {
                    return [
                        'name' => $sub->name,
                        'slug' => $sub->slug
                    ];
                })->toArray();
            });

            View::share('globalSettings', $globalSettings);
            View::share('companyProfile', $companyProfile);
            View::share('globalSubsidiaries', $globalSubsidiaries);
        }
    }
}
