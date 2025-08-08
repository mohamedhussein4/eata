<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminNotification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = AdminNotification::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.notifications.index', compact('notifications'));
    }

    public function show(AdminNotification $notification)
    {
        return view('admin.notifications.show', compact('notification'));
    }

    public function markAsRead($id)
    {
        $notification = AdminNotification::findOrFail($id);
        $notification->update(['is_read' => true]);
        
        return redirect()->back()->with('success', 'تم تحديد الإشعار كمقروء');
    }

    public function markAllAsRead()
    {
        AdminNotification::where('is_read', false)->update(['is_read' => true]);
        
        return redirect()->back()->with('success', 'تم تحديد جميع الإشعارات كمقروءة');
    }

    public function destroy($id)
    {
        $notification = AdminNotification::findOrFail($id);
        $notification->delete();
        
        return redirect()->back()->with('success', 'تم حذف الإشعار بنجاح');
    }

    public function getUnreadCount()
    {
        $count = AdminNotification::where('is_read', false)->count();
        return response()->json(['count' => $count]);
    }

    public function getNotificationsByType($type)
    {
        $notifications = AdminNotification::where('type', $type)
            ->orderBy('created_at', 'desc')
            ->paginate(15);
            
        return view('admin.notifications.by-type', compact('notifications', 'type'));
    }
} 