<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SmsDonation;
use App\Models\SmsDonationRecord;
use Illuminate\Http\Request;

class SmsDonationController extends Controller
{
    public function index()
    {
        $donations = SmsDonation::with('user')->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.sms-donations.index', compact('donations'));
    }

    public function create()
    {
        return view('admin.sms-donations.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'donation_type' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'message_text' => 'required|string|max:160',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'status' => 'required|in:pending,approved,rejected',
            'notes' => 'nullable|string',
        ]);

        SmsDonation::create($validated);

        return redirect()->route('admin.sms-donations.index')->with('success', 'تم إضافة تبرع الرسالة النصية بنجاح');
    }

    public function show(SmsDonation $smsDonation)
    {
        return view('admin.sms-donations.show', compact('smsDonation'));
    }

    public function edit(SmsDonation $smsDonation)
    {
        return view('admin.sms-donations.edit', compact('smsDonation'));
    }

    public function update(Request $request, SmsDonation $smsDonation)
    {
        $validated = $request->validate([
            'donation_type' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'message_text' => 'required|string|max:160',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'status' => 'required|in:pending,approved,rejected',
            'notes' => 'nullable|string',
        ]);

        $smsDonation->update($validated);

        return redirect()->route('admin.sms-donations.index')->with('success', 'تم تحديث تبرع الرسالة النصية بنجاح');
    }

    public function destroy(SmsDonation $smsDonation)
    {
        $smsDonation->delete();
        return redirect()->route('admin.sms-donations.index')->with('success', 'تم حذف تبرع الرسالة النصية بنجاح');
    }

    public function updateStatus(Request $request, $id)
    {
        $donation = SmsDonation::findOrFail($id);
        $donation->update(['status' => $request->status]);
        
        return redirect()->back()->with('success', 'تم تحديث حالة تبرع الرسالة النصية بنجاح');
    }
} 