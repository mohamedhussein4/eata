<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Ticket;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::with(['ticket', 'sender'])->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.messages.index', compact('messages'));
    }

    public function show(Message $message)
    {
        return view('admin.messages.show', compact('message'));
    }

    public function edit(Message $message)
    {
        return view('admin.messages.edit', compact('message'));
    }

    public function update(Request $request, Message $message)
    {
        $validated = $request->validate([
            'message' => 'required|string|min:1',
        ]);

        $message->update($validated);

        return redirect()->route('admin.messages.index')->with('success', 'تم تحديث الرسالة بنجاح');
    }

    public function destroy(Message $message)
    {
        $message->delete();
        return redirect()->route('admin.messages.index')->with('success', 'تم حذف الرسالة بنجاح');
    }

    public function getMessagesByTicket($ticketId)
    {
        $ticket = Ticket::findOrFail($ticketId);
        $messages = $ticket->messages()->with('sender')->orderBy('created_at', 'asc')->get();
        
        return response()->json($messages);
    }

    public function replyToTicket(Request $request, $ticketId)
    {
        $validated = $request->validate([
            'message' => 'required|string|min:1',
        ]);

        $ticket = Ticket::findOrFail($ticketId);

        Message::create([
            'ticket_id' => $ticket->id,
            'sender_id' => auth()->id(),
            'message' => $validated['message'],
        ]);

        return response()->json(['success' => true, 'message' => 'تم إرسال الرد بنجاح']);
    }
} 