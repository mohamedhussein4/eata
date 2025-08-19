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
            'message' => 'required|string',
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
        $contact->update(['read_at' => now()]);
        return redirect()->back()->with('success', 'تم تحديد الرسالة كمقروءة');
    }

    public function markAllAsRead()
    {
        Contact::whereNull('read_at')->update(['read_at' => now()]);
        return redirect()->back()->with('success', 'تم تحديد جميع الرسائل كمقروءة');
    }

    public function getUnreadCount()
    {
        $count = Contact::whereNull('read_at')->count();
        return response()->json(['count' => $count]);
    }
}
