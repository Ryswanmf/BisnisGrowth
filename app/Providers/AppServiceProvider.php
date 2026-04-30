<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind('path.public', function() {
            if (file_exists(base_path('../public_html'))) {
                return base_path('../public_html');
            }
            
            // Jika folder domain adalah nama folder induknya sendiri (bisnisgrowth.sites.id)
            if (str_contains(base_path(), 'bisnisgrowth.sites.id')) {
                return dirname(base_path());
            }

            return base_path('public');
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        \Illuminate\Pagination\Paginator::useTailwind();

        // Share all settings to all views
        view()->composer('*', function ($view) {
            try {
                // Settings Utama (v4)
                $siteSettings = \Illuminate\Support\Facades\Cache::rememberForever('site_settings_v4', function () {
                    return \App\Models\SiteSetting::pluck('value', 'key')->toArray();
                });

                $footerSetting = \Illuminate\Support\Facades\Cache::rememberForever('footer_settings_v4', function () {
                    return \App\Models\FooterSetting::first();
                });
                
                if (!($footerSetting instanceof \App\Models\FooterSetting) && !is_null($footerSetting)) {
                    \Illuminate\Support\Facades\Cache::forget('footer_settings_v4');
                    $footerSetting = \App\Models\FooterSetting::first();
                }

                $globalFooterPages = \Illuminate\Support\Facades\Cache::rememberForever('footer_pages_v4', function () {
                    return \App\Models\Page::where('is_published', true)->get();
                });

            } catch (\Exception $e) {
                $siteSettings = [];
                $footerSetting = null;
                $globalFooterPages = collect();
            }

            $view->with([
                'siteSettings' => $siteSettings,
                'footerSetting' => $footerSetting,
                'globalFooterPages' => $globalFooterPages ?? collect()
            ]);
        });
    }
}
