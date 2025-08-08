<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function store(Request $request)
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

    public function getMessages($ticketId)
    {
        $ticket = Ticket::where('id', $ticketId)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $messages = $ticket->messages()
            ->with('sender')
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json($messages);
    }
} 