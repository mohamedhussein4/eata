<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\AdminNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class ContactController extends Controller
{
    /**
     * عرض صفحة الاتصال
     */
    public function index()
    {
        return view('frontend.contact.index');
    }

    /**
     * حفظ رسالة الاتصال
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:10',
        ]);

        // إنشاء رسالة الاتصال
        $contact = Contact::create([
            'user_id' => Auth::id(),
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'subject' => $validated['subject'],
            'message' => $validated['message'],
            'is_read' => false,
        ]);

        // إنشاء إشعار للمدير
        $title = 'رسالة اتصال جديدة';
        $message = 'رسالة جديدة من: ' . $contact->name;
        $url = URL::route('admin.contacts.show', $contact->id);

        AdminNotification::create([
            'title' => $title,
            'message' => $message,
            'type' => 'contact',
            'record_id' => $contact->id,
            'url' => $url,
            'is_read' => false,
        ]);

        return redirect()->back()->with('success', 'تم إرسال رسالتك بنجاح وسنقوم بالرد عليك قريباً!');
    }
} 