<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Share global settings and profile to all views, cached forever 
        // (Cache is automatically cleared by their respective Model booted events)
        View::composer('*', function ($view) {
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

            $view->with('globalSettings', $globalSettings);
            $view->with('companyProfile', $companyProfile);
            $view->with('globalSubsidiaries', $globalSubsidiaries);
        });
    }
}
