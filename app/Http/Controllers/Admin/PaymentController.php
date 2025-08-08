<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with(['user', 'order'])->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.payments.index', compact('payments'));
    }

    public function create()
    {
        return view('admin.payments.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required|string|max:255',
            'order_id' => 'nullable|exists:orders,id',
            'transaction_id' => 'nullable|string|max:255',
            'status' => 'required|in:pending,completed,failed',
            'notes' => 'nullable|string',
        ]);

        Payment::create($validated);

        return redirect()->route('admin.payments.index')->with('success', 'تم إضافة المدفوعات بنجاح');
    }

    public function show(Payment $payment)
    {
        return view('admin.payments.show', compact('payment'));
    }

    public function edit(Payment $payment)
    {
        return view('admin.payments.edit', compact('payment'));
    }

    public function update(Request $request, Payment $payment)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required|string|max:255',
            'order_id' => 'nullable|exists:orders,id',
            'transaction_id' => 'nullable|string|max:255',
            'status' => 'required|in:pending,completed,failed',
            'notes' => 'nullable|string',
        ]);

        $payment->update($validated);

        return redirect()->route('admin.payments.index')->with('success', 'تم تحديث المدفوعات بنجاح');
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();
        return redirect()->route('admin.payments.index')->with('success', 'تم حذف المدفوعات بنجاح');
    }

    public function updateStatus(Request $request, $id)
    {
        $payment = Payment::findOrFail($id);
        $payment->update(['status' => $request->status]);
        
        return redirect()->back()->with('success', 'تم تحديث حالة المدفوعات بنجاح');
    }

    public function getPaymentStatistics()
    {
        $stats = [
            'total' => Payment::count(),
            'pending' => Payment::where('status', 'pending')->count(),
            'completed' => Payment::where('status', 'completed')->count(),
            'failed' => Payment::where('status', 'failed')->count(),
            'total_amount' => Payment::where('status', 'completed')->sum('amount'),
        ];

        return response()->json($stats);
    }
} 