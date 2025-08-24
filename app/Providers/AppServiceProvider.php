<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\AdminNotification;

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
        // مشاركة الإشعارات مع كل views لوحة التحكم
        View::composer('layouts.dashboard', function ($view) {
            $notifications = AdminNotification::orderBy('created_at', 'desc')
                ->take(10)
                ->get();
            
            $unreadCount = AdminNotification::where('is_read', false)->count();
            
            $view->with([
                'adminNotifications' => $notifications,
                'unreadNotificationsCount' => $unreadCount
            ]);
        });
    }
}
