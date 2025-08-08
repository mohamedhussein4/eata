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
    public function index()
    {
        $projects = Project::all();
        $bankAccounts = BankAccount::all();
        $eWallets = EWallet::all();
        
        return view('frontend.donations.index', compact('projects', 'bankAccounts', 'eWallets'));
    }

    /**
     * حفظ التبرع الجديد
     */
    public function store(Request $request)
    {
        $request->validate([
            'total_price' => 'required|numeric|min:1',
            'project_id' => 'nullable|exists:projects,id',
            'payment_method' => 'required|in:bank,wallet,card',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'notes' => 'nullable|string',
        ]);

        try {
            DB::beginTransaction();

            // إنشاء التبرع
            $donation = Donation::create([
                'user_id' => auth()->id(),
                'project_id' => $request->project_id,
                'amount' => $request->total_price,
                'payment_method' => $request->payment_method,
                'status' => 'pending',
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'notes' => $request->notes,
            ]);

            // إنشاء عملية الدفع
            $payment = Payment::create([
                'donation_id' => $donation->id,
                'amount' => $request->total_price,
                'payment_method' => $request->payment_method,
                'status' => 'pending',
            ]);

            // إنشاء إشعار للمسؤول
            Notification::create([
                'user_id' => 1, // المسؤول
                'type' => 'donation',
                'title' => app()->getLocale() === 'ar' ? 'تبرع جديد' : 'New Donation',
                'message' => app()->getLocale() === 'ar' 
                    ? sprintf('تم استلام تبرع جديد بقيمة %s من %s', number_format($request->total_price), $request->name)
                    : sprintf('New donation received of %s from %s', number_format($request->total_price), $request->name),
            ]);

            DB::commit();

            // تحويل المستخدم إلى صفحة الدفع حسب الطريقة المختارة
            switch($request->payment_method) {
                case 'bank':
                    return redirect()->route('bank-accounts.index')
                        ->with('success', app()->getLocale() === 'ar' ? 'تم تسجيل التبرع بنجاح. يرجى إكمال عملية التحويل البنكي.' : 'Donation registered successfully. Please complete the bank transfer.');
                case 'wallet':
                    return redirect()->route('e-wallets.index')
                        ->with('success', app()->getLocale() === 'ar' ? 'تم تسجيل التبرع بنجاح. يرجى إكمال عملية الدفع عبر المحفظة.' : 'Donation registered successfully. Please complete the wallet payment.');
                default:
                    return redirect()->route('payments.process', $payment->id);
            }
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

    public function getBankDetails($id)
    {
        $bank = BankAccount::findOrFail($id);
        return response()->json([
            'bank_name' => $bank->bank_name,
            'account_name' => $bank->account_name,
            'account_number' => $bank->account_number,
            'iban' => $bank->iban,
            'swift_code' => $bank->swift_code,
        ]);
    }

    public function getWalletDetails($id)
    {
        $wallet = EWallet::findOrFail($id);
        return response()->json([
            'provider' => $wallet->provider,
            'account_id' => $wallet->account_id,
            'wallet_link' => $wallet->wallet_link,
            'currency_type' => $wallet->currency_type,
        ]);
    }
} 