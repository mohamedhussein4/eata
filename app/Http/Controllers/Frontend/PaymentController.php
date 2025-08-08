<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::where('user_id', Auth::id())
            ->with(['order'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('frontend.payments.index', compact('payments'));
    }

    public function show(Payment $payment)
    {
        if ($payment->user_id !== Auth::id()) {
            abort(403);
        }

        return view('frontend.payments.show', compact('payment'));
    }

    public function create()
    {
        return view('frontend.payments.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:1',
            'payment_method' => 'required|string|max:255',
            'order_id' => 'nullable|exists:orders,id',
            'transaction_id' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $payment = Payment::create([
            'user_id' => Auth::id(),
            'amount' => $validated['amount'],
            'payment_method' => $validated['payment_method'],
            'order_id' => $validated['order_id'],
            'transaction_id' => $validated['transaction_id'],
            'notes' => $validated['notes'],
            'status' => 'pending',
        ]);

        return redirect()->route('payments.show', $payment)
            ->with('success', 'تم إنشاء المدفوعات بنجاح');
    }

    public function processPayment(Request $request, $id)
    {
        $payment = Payment::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        // هنا يتم معالجة المدفوعات
        $payment->update(['status' => 'completed']);

        return response()->json(['success' => true, 'message' => 'تم معالجة المدفوعات بنجاح']);
    }

    public function getPaymentStatus($id)
    {
        $payment = Payment::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return response()->json(['status' => $payment->status]);
    }
} 