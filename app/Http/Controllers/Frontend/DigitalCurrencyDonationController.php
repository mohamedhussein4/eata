<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\DigitalCurrencyDonation;
use App\Models\BankAccount;
use App\Models\EWallet;
use App\Traits\RewardPointsTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DigitalCurrencyDonationController extends Controller
{
    use RewardPointsTrait;
    /**
     * عرض قائمة تبرعات العملات الرقمية
     */
    public function index()
    {
        $donations = DigitalCurrencyDonation::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $bankAccounts = BankAccount::all();
        $eWallets = EWallet::all();

        return view('frontend.digital-currency-donations.index', compact('donations', 'bankAccounts', 'eWallets'));
    }

    /**
     * عرض نموذج تبرع عملة رقمية جديدة
     */
    public function getBankDetails($id)
    {
        $bank = BankAccount::findOrFail($id);
        return response()->json([
            'bank_name' => $bank->bank_name,
            'account_name' => $bank->account_name,
            'account_number' => $bank->account_number,
            'iban' => $bank->iban,
            'swift_code' => $bank->swift_code,
            'currency' => $bank->currency,
        ]);
    }

    public function getWalletDetails($id)
    {
        $wallet = EWallet::findOrFail($id);
        return response()->json([
            'wallet_name' => $wallet->wallet_name,
            'provider' => $wallet->provider,
            'account_id' => $wallet->account_id,
            'wallet_link' => $wallet->wallet_link,
            'instructions' => $wallet->instructions,
        ]);
    }

    /**
     * حفظ تبرع عملة رقمية جديدة
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'payment_method' => 'required|in:bank_account,e_wallet',
            'bank_account_id' => 'required_if:payment_method,bank_account|exists:bank_accounts,id',
            'e_wallet_id' => 'required_if:payment_method,e_wallet|exists:e_wallets,id',
            'amount' => 'required|numeric|min:0',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'notes' => 'nullable|string',
            'proof_document' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // معالجة الملف المرفق
        if ($request->hasFile('proof_document')) {
            $file = $request->file('proof_document');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/donations/digital', $filename);
        }

        $donation = DigitalCurrencyDonation::create([
            'user_id' => Auth::id(),
            'payment_method' => $validated['payment_method'],
            'bank_account_id' => $validated['payment_method'] === 'bank_account' ? $validated['bank_account_id'] : null,
            'e_wallet_id' => $validated['payment_method'] === 'e_wallet' ? $validated['e_wallet_id'] : null,
            'amount' => $validated['amount'],
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'notes' => $validated['notes'],
            'proof_document' => $filename ?? null,
            'currency_type' => 'SYP', // الليرة السورية كعملة افتراضية
            'status' => 'pending',
        ]);

        // إضافة نقاط المكافأة
        $this->addRewardPoints(
            $validated['amount'],
            'digital_currency_donation',
            $donation
        );

        return redirect()->route('digital-currency-donations.index')
            ->with('success', 'تم إرسال تبرع العملة الرقمية بنجاح وسيتم مراجعته قريباً');
    }
}
