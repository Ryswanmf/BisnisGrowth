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
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        \Illuminate\Pagination\Paginator::useTailwind();

        // Share footer settings and static pages to all views
        view()->composer('*', function ($view) {
            try {
                $footerSetting = \Illuminate\Support\Facades\Cache::rememberForever('footer_settings_v3', function () {
                    return \App\Models\FooterSetting::first();
                });
                
                // Pastikan objek valid dan bukan __PHP_Incomplete_Class
                if (!($footerSetting instanceof \App\Models\FooterSetting)) {
                    \Illuminate\Support\Facades\Cache::forget('footer_settings_v3');
                    $footerSetting = \App\Models\FooterSetting::first();
                }

                $globalFooterPages = \Illuminate\Support\Facades\Cache::rememberForever('footer_pages_v3', function () {
                    return \App\Models\Page::where('is_published', true)->get();
                });
                
                if ($globalFooterPages && !($globalFooterPages instanceof \Illuminate\Support\Collection)) {
                    \Illuminate\Support\Facades\Cache::forget('footer_pages_v3');
                    $globalFooterPages = \App\Models\Page::where('is_published', true)->get();
                }

            } catch (\Exception $e) {
                $footerSetting = null;
                $globalFooterPages = collect();
            }

            $view->with('footerSetting', $footerSetting);
            $view->with('globalFooterPages', $globalFooterPages ?? collect());
        });
    }
}
