<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\Project;
use App\Models\Payment;
use App\Models\Notification;
use App\Models\BankAccount;
use App\Models\EWallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DonationController extends Controller
{
    /**
     * عرض صفحة التبرع
     */
    public function index(Request $request)
    {
        $projects = Project::all();
        $bankAccounts = BankAccount::all();
        $eWallets = EWallet::all();

        // إذا تم تمرير project_id من صفحة المشروع
        $selectedProject = null;
        if ($request->has('project_id')) {
            $selectedProject = Project::find($request->project_id);
        }

        return view('frontend.donations.create', compact('projects', 'bankAccounts', 'eWallets', 'selectedProject'));
    }

    /**
     * حفظ التبرع الجديد
     */
    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'project_id' => 'nullable|exists:projects,id',
            'payment_method' => 'required|in:bank_account,e_wallet,cash',
            'bank_account_id' => 'required_if:payment_method,bank_account|exists:bank_accounts,id',
            'e_wallet_id' => 'required_if:payment_method,e_wallet|exists:e_wallets,id',
            'donor_name' => 'required|string|max:255',
            'donor_email' => 'required|email|max:255',
            'donor_phone' => 'required|string|max:20',
            'payment_proof' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
            'notes' => 'nullable|string|max:1000',
        ]);

        try {
            DB::beginTransaction();

            // رفع ملف إثبات الدفع إن وجد
            $paymentProofPath = null;
            if ($request->hasFile('payment_proof')) {
                $paymentProofPath = $request->file('payment_proof')->store('payment_proofs', 'public');
            }

            // إنشاء التبرع
            $donation = Donation::create([
                'user_id' => auth()->id(),
                'project_id' => $request->project_id,
                'amount' => $request->amount,
                'donor_name' => $request->donor_name,
                'donor_email' => $request->donor_email,
                'donor_phone' => $request->donor_phone,
                'payment_method' => $request->payment_method,
                'bank_account_id' => $request->payment_method === 'bank_account' ? $request->bank_account_id : null,
                'e_wallet_id' => $request->payment_method === 'e_wallet' ? $request->e_wallet_id : null,
                'payment_proof' => $paymentProofPath,
                'status' => 'pending',
                'notes' => $request->notes,
            ]);

            // إنشاء إشعار للمسؤول
            Notification::create([
                'user_id' => 1, // المسؤول
                'type' => 'donation',
                'title' => app()->getLocale() === 'ar' ? 'تبرع جديد' : 'New Donation',
                'message' => app()->getLocale() === 'ar'
                    ? sprintf('تم استلام تبرع جديد بقيمة %s من %s', number_format($request->amount), $request->donor_name)
                    : sprintf('New donation received of %s from %s', number_format($request->amount), $request->donor_name),
            ]);

            DB::commit();

            return redirect()->route('donations.success')
                ->with('success', app()->getLocale() === 'ar' ? 'تم تسجيل التبرع بنجاح! سيتم مراجعة طلبك وإشعارك بالنتيجة.' : 'Donation registered successfully! Your request will be reviewed and you will be notified of the result.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', app()->getLocale() === 'ar' ? 'حدث خطأ أثناء معالجة التبرع. يرجى المحاولة مرة أخرى.' : 'An error occurred while processing the donation. Please try again.');
        }
    }

    /**
     * صفحة نجاح التبرع
     */
    public function success()
    {
        return view('frontend.donations.success');
    }

    /**
     * صفحة إلغاء التبرع
     */
    public function cancel()
    {
        return view('frontend.donations.cancel');
    }

    /**
     * الحصول على تفاصيل البنك
     */
    public function getBankDetails($id)
    {
        $bank = BankAccount::find($id);
        if (!$bank) {
            return response()->json(['error' => 'Bank not found'], 404);
        }

        return response()->json([
            'bank_name' => $bank->bank_name,
            'account_number' => $bank->account_number,
            'iban' => $bank->iban,
            'swift_code' => $bank->swift_code,
            'account_name' => $bank->account_name,
        ]);
    }

    /**
     * الحصول على تفاصيل المحفظة
     */
    public function getWalletDetails($id)
    {
        $wallet = EWallet::find($id);
        if (!$wallet) {
            return response()->json(['error' => 'Wallet not found'], 404);
        }

        return response()->json([
            'provider' => $wallet->provider,
            'account_id' => $wallet->account_id,
            'currency_type' => $wallet->currency_type,
            'wallet_link' => $wallet->wallet_link,
        ]);
    }
}
