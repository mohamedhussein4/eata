<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SmsDonationRecord;
use Illuminate\Http\Request;

class SmsDonationRecordController extends Controller
{
    public function index()
    {
        $records = SmsDonationRecord::with(['smsDonation'])->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.sms-donation-records.index', compact('records'));
    }

    public function create()
    {
        return view('admin.sms-donation-records.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'sms_donation_id' => 'required|exists:sms_donations,id',
            'sent_at' => 'required|date',
            'status' => 'required|in:sent,failed,delivered',
            'response_message' => 'nullable|string',
        ]);

        SmsDonationRecord::create($validated);

        return redirect()->route('admin.sms-donation-records.index')->with('success', 'تم إضافة سجل التبرع بنجاح');
    }

    public function show(SmsDonationRecord $record)
    {
        return view('admin.sms-donation-records.show', compact('record'));
    }

    public function edit(SmsDonationRecord $record)
    {
        return view('admin.sms-donation-records.edit', compact('record'));
    }

    public function update(Request $request, SmsDonationRecord $record)
    {
        $validated = $request->validate([
            'sms_donation_id' => 'required|exists:sms_donations,id',
            'sent_at' => 'required|date',
            'status' => 'required|in:sent,failed,delivered',
            'response_message' => 'nullable|string',
        ]);

        $record->update($validated);

        return redirect()->route('admin.sms-donation-records.index')->with('success', 'تم تحديث سجل التبرع بنجاح');
    }

    public function destroy(SmsDonationRecord $record)
    {
        $record->delete();
        return redirect()->route('admin.sms-donation-records.index')->with('success', 'تم حذف سجل التبرع بنجاح');
    }

    public function updateStatus(Request $request, $id)
    {
        $record = SmsDonationRecord::findOrFail($id);
        $record->update(['status' => $request->status]);
        
        return redirect()->back()->with('success', 'تم تحديث حالة سجل التبرع بنجاح');
    }
} 