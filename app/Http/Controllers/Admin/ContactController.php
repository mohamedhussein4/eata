<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::with('user')->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.contacts.index', compact('contacts'));
    }

    public function show(Contact $contact)
    {
        return view('admin.contacts.show', compact('contact'));
    }

    public function edit(Contact $contact)
    {
        return view('admin.contacts.edit', compact('contact'));
    }

    public function update(Request $request, Contact $contact)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'is_read' => 'boolean',
        ]);

        $contact->update($validated);

        return redirect()->route('admin.contacts.index')->with('success', 'تم تحديث الرسالة بنجاح');
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('admin.contacts.index')->with('success', 'تم حذف الرسالة بنجاح');
    }

    public function markAsRead(Contact $contact)
    {
        $contact->update(['is_read' => true]);
        return redirect()->back()->with('success', 'تم تحديد الرسالة كمقروءة');
    }

    public function markAllAsRead()
    {
        Contact::where('is_read', false)->update(['is_read' => true]);
        return redirect()->back()->with('success', 'تم تحديد جميع الرسائل كمقروءة');
    }

    public function getUnreadCount()
    {
        $count = Contact::where('is_read', false)->count();
        return response()->json(['count' => $count]);
    }
} 