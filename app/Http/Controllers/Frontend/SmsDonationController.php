<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\SmsDonation;
use App\Models\SmsDonationRecord;
use App\Traits\RewardPointsTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SmsDonationController extends Controller
{
    use RewardPointsTrait;
    /**
     * عرض قائمة تبرعات الرسائل النصية
     */
    public function index()
    {

        return view('frontend.sms-donations.index');
    }

    /**
     * عرض نموذج تبرع رسالة نصية جديدة
     */
    public function create()
    {
        return view('frontend.sms-donations.create');
    }

    /**
     * حفظ تبرع رسالة نصية جديدة
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'donation_type' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'message_text' => 'required|string|max:160',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'notes' => 'nullable|string',
        ]);

        $donation = SmsDonation::create([
            'user_id' => Auth::id(),
            'donation_type' => $validated['donation_type'],
            'phone_number' => $validated['phone_number'],
            'message_text' => $validated['message_text'],
            'name' => $validated['name'],
            'email' => $validated['email'],
            'notes' => $validated['notes'],
            'status' => 'pending',
        ]);

        // إضافة نقاط المكافأة
        $this->addRewardPoints(
            $donation->amount,
            'sms_donation',
            $donation
        );

        return redirect()->route('sms-donations.index')
            ->with('success', 'تم إرسال تبرع الرسالة النصية بنجاح وسيتم مراجعته قريباً');
    }

    /**
     * حفظ سجل تبرع رسالة نصية
     */
    public function storeRecord(Request $request)
    {
        $validated = $request->validate([
            'sms_donation_id' => 'required|exists:sms_donations,id',
            'sent_at' => 'required|date',
            'status' => 'required|in:sent,failed,delivered',
            'response_message' => 'nullable|string',
        ]);

        $record = SmsDonationRecord::create($validated);

        return response()->json(['success' => true, 'record' => $record]);
    }
}
