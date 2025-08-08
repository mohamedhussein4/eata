<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\Message;
use App\Models\AdminNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::where('user_id', Auth::id())
            ->with(['messages'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('frontend.tickets.index', compact('tickets'));
    }

    public function show(Ticket $ticket)
    {
        if ($ticket->user_id !== Auth::id()) {
            abort(403);
        }

        $messages = $ticket->messages()->with('sender')->orderBy('created_at', 'asc')->get();

        return view('frontend.tickets.show', compact('ticket', 'messages'));
    }

    public function createTicket(Request $request)
    {
        $validated = $request->validate([
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string|min:10',
        ]);

        $existingTicket = Ticket::where('user_id', Auth::id())
            ->where('status', 'open')
            ->first();

        if ($existingTicket) {
            Message::create([
                'ticket_id' => $existingTicket->id,
                'sender_id' => Auth::id(),
                'message' => $validated['message'],
            ]);

            return response()->json(['success' => true, 'message' => 'تم إضافة الرسالة إلى التذكرة المفتوحة']);
        }

        $ticket = Ticket::create([
            'user_id' => Auth::id(),
            'subject' => $validated['subject'] ?? $validated['message'],
            'status' => 'open',
        ]);

        Message::create([
            'ticket_id' => $ticket->id,
            'sender_id' => Auth::id(),
            'message' => $validated['message'],
        ]);

        AdminNotification::create([
            'title' => 'تذكرة دعم فني جديدة',
            'message' => 'تم إنشاء تذكرة دعم فني جديدة',
            'type' => 'ticket',
            'record_id' => $ticket->id,
            'url' => URL::route('admin.support.tickets.show', $ticket->id),
            'is_read' => false,
        ]);

        return response()->json(['success' => true, 'message' => 'تم إنشاء التذكرة بنجاح']);
    }

    public function storeMessage(Request $request)
    {
        $validated = $request->validate([
            'ticket_id' => 'required|exists:tickets,id',
            'message' => 'required|string|min:1',
        ]);

        $ticket = Ticket::where('id', $validated['ticket_id'])
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $message = Message::create([
            'ticket_id' => $ticket->id,
            'sender_id' => Auth::id(),
            'message' => $validated['message'],
        ]);

        return response()->json(['success' => true, 'message' => $message]);
    }
} 