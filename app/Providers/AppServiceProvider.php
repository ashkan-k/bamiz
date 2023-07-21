<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Modules\Setting\Entities\Setting;
use Modules\Ticket\Entities\Ticket;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if (!env('APP_DEBUG')){
            $this->app->bind('path.public', function() {
                return realpath(base_path().'/public_html');
            });
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (Schema::hasTable('tickets') && str_contains(request()->url(), '/dashboard')){
            $not_answered_tickets = Ticket::whereStatus('waiting')->latest()->get();
            View::share('not_answered_tickets', $not_answered_tickets);
        }

        if (Schema::hasTable('settings') && !str_contains('dashboard', request()->url())){
            $settings = [];
            foreach (Setting::all() as $item){
                $settings[$item->key] = $item->value;
            }
            View::share('settings', $settings);
        }
    }
}
