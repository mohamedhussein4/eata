<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * عرض قائمة الإشعارات
     */
    public function index()
    {
        $notifications = Notification::where('user_id', auth()->id())
            ->latest()
            ->paginate(20);

        return view('frontend.notifications.index', compact('notifications'));
    }

    /**
     * تحديد إشعار كمقروء
     */
    public function markAsRead(Notification $notification)
    {
        // التأكد من أن الإشعار يخص المستخدم الحالي
        if ($notification->user_id !== auth()->id()) {
            abort(403);
        }

        $notification->update(['is_read' => true]);

        return back()->with('success', app()->getLocale() === 'ar' ? 'تم تحديد الإشعار كمقروء' : 'Notification marked as read');
    }

    /**
     * تحديد كل الإشعارات كمقروءة
     */
    public function markAllAsRead()
    {
        Notification::where('user_id', auth()->id())
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return back()->with('success', app()->getLocale() === 'ar' ? 'تم تحديد جميع الإشعارات كمقروءة' : 'All notifications marked as read');
    }
} 