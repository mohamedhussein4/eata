<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\DigitalCurrencyDonation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DigitalCurrencyDonationController extends Controller
{
    /**
     * عرض قائمة تبرعات العملات الرقمية
     */
    public function index()
    {
        $donations = DigitalCurrencyDonation::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('frontend.digital-currency-donations.index', compact('donations'));
    }

    /**
     * عرض نموذج تبرع عملة رقمية جديدة
     */
    public function create()
    {
        return view('frontend.digital-currency-donations.create');
    }

    /**
     * حفظ تبرع عملة رقمية جديدة
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'currency_type' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'wallet_address' => 'required|string|max:255',
            'transaction_hash' => 'nullable|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'notes' => 'nullable|string',
        ]);

        $donation = DigitalCurrencyDonation::create([
            'user_id' => Auth::id(),
            'currency_type' => $validated['currency_type'],
            'amount' => $validated['amount'],
            'wallet_address' => $validated['wallet_address'],
            'transaction_hash' => $validated['transaction_hash'],
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'notes' => $validated['notes'],
            'status' => 'pending',
        ]);

        return redirect()->route('digital-currency-donations.index')
            ->with('success', 'تم إرسال تبرع العملة الرقمية بنجاح وسيتم مراجعته قريباً');
    }
} 