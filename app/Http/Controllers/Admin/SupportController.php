<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    /**
     * عرض قائمة التذاكر
     */
    public function index()
    {
        $tickets = Ticket::with(['user', 'messages'])
            ->latest()
            ->paginate(15);

        $stats = [
            'total' => Ticket::count(),
            'open' => Ticket::where('status', 'open')->count(),
            'closed' => Ticket::where('status', 'closed')->count(),
            'pending' => Ticket::where('status', 'pending')->count(),
        ];

        return view('admin.support.tickets.index', compact('tickets', 'stats'));
    }

    /**
     * عرض تفاصيل التذكرة
     */
    public function show(Ticket $ticket)
    {
        $ticket->load(['user', 'messages.sender']);
        return view('admin.support.tickets.show', compact('ticket'));
    }

    /**
     * إغلاق التذكرة
     */
    public function close(Ticket $ticket)
    {
        $ticket->update(['status' => 'closed']);

        // إنشاء رسالة نظام
        Message::create([
            'ticket_id' => $ticket->id,
            'sender_id' => auth()->id(),
            'message' => 'تم إغلاق التذكرة'
        ]);

        return back()->with('success', 'تم إغلاق التذكرة بنجاح');
    }

    /**
     * إعادة فتح التذكرة
     */
    public function reopen(Ticket $ticket)
    {
        $ticket->update(['status' => 'open']);

        // إنشاء رسالة نظام
        Message::create([
            'ticket_id' => $ticket->id,
            'sender_id' => auth()->id(),
            'message' => 'تم إعادة فتح التذكرة'
        ]);

        return back()->with('success', 'تم إعادة فتح التذكرة بنجاح');
    }

    /**
     * إرسال رد على التذكرة
     */
    public function reply(Request $request, Ticket $ticket)
    {
        $request->validate([
            'content' => 'required|string'
        ]);

        $message = Message::create([
            'ticket_id' => $ticket->id,
            'sender_id' => auth()->id(),
            'message' => $request->content
        ]);

        // تحديث حالة التذكرة إلى مفتوحة إذا كانت في انتظار الرد
        if ($ticket->status === 'pending') {
            $ticket->update(['status' => 'open']);
        }

        return back()->with('success', 'تم إرسال الرد بنجاح');
    }
}
