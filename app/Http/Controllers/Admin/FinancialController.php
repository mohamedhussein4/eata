<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BankAccount;
use App\Models\EWallet;
use App\Models\Payment;
use App\Models\Order;
use Illuminate\Http\Request;

class FinancialController extends Controller
{
    /**
     * عرض لوحة التحكم المالية
     */
    public function dashboard()
    {
        $stats = [
            'total_bank_accounts' => BankAccount::count(),
            'total_e_wallets' => EWallet::count(),
            'total_payments' => Payment::count(),
            'total_orders' => Order::count(),
        ];

        $recentPayments = Payment::with('user')->latest()->take(5)->get();
        $recentOrders = Order::with('user')->latest()->take(5)->get();

        return view('admin.financial.dashboard', compact('stats', 'recentPayments', 'recentOrders'));
    }

    /**
     * عرض تقرير المالية
     */
    public function report(Request $request)
    {
        $startDate = $request->get('start_date', now()->startOfMonth());
        $endDate = $request->get('end_date', now()->endOfMonth());

        $payments = Payment::whereBetween('created_at', [$startDate, $endDate])
            ->with('user')
            ->get();

        $orders = Order::whereBetween('created_at', [$startDate, $endDate])
            ->with('user')
            ->get();

        $stats = [
            'total_payments' => $payments->count(),
            'total_payment_amount' => $payments->where('status', 'completed')->sum('amount'),
            'total_orders' => $orders->count(),
            'total_order_amount' => $orders->where('status', 'completed')->sum('total_price'),
        ];

        return view('admin.financial.report', compact('stats', 'payments', 'orders', 'startDate', 'endDate'));
    }

    /**
     * تصدير التقرير المالي
     */
    public function exportReport(Request $request)
    {
        $startDate = $request->get('start_date', now()->startOfMonth());
        $endDate = $request->get('end_date', now()->endOfMonth());

        $payments = Payment::whereBetween('created_at', [$startDate, $endDate])
            ->with('user')
            ->get();

        $orders = Order::whereBetween('created_at', [$startDate, $endDate])
            ->with('user')
            ->get();

        // هنا يتم تصدير التقرير كـ Excel أو PDF
        return response()->json([
            'success' => true,
            'message' => 'تم تصدير التقرير بنجاح',
            'data' => [
                'payments' => $payments,
                'orders' => $orders,
                'start_date' => $startDate,
                'end_date' => $endDate,
            ]
        ]);
    }
} 