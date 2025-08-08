<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\BankAccount;
use App\Models\EWallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * عرض سلة التبرعات
     */
    public function index()
    {
        $cartItems = Cart::where('user_id', Auth::id())
            ->with(['project'])
            ->get();

        $bankAccounts = BankAccount::all();
        $eWallets = EWallet::all();

        return view('frontend.cart.index', compact('cartItems', 'bankAccounts', 'eWallets'));
    }

    /**
     * إضافة مشروع إلى السلة
     */
    public function addToCart(Request $request)
    {
        $validated = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'amount' => 'required|numeric|min:1',
        ]);

        // التحقق من وجود المشروع في السلة
        $existingItem = Cart::where('user_id', Auth::id())
            ->where('project_id', $validated['project_id'])
            ->first();

        if ($existingItem) {
            $existingItem->update([
                'amount' => $existingItem->amount + $validated['amount']
            ]);
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'project_id' => $validated['project_id'],
                'amount' => $validated['amount'],
            ]);
        }

        return redirect()->back()->with('success', 'تم إضافة المشروع إلى السلة بنجاح');
    }

    /**
     * حذف مشروع من السلة
     */
    public function removeFromCart($id)
    {
        $cartItem = Cart::where('user_id', Auth::id())
            ->where('id', $id)
            ->firstOrFail();

        $cartItem->delete();

        return redirect()->back()->with('success', 'تم حذف المشروع من السلة بنجاح');
    }

    /**
     * تحديث كمية التبرع في السلة
     */
    public function updateCart(Request $request, $id)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);

        $cartItem = Cart::where('user_id', Auth::id())
            ->where('id', $id)
            ->firstOrFail();

        $cartItem->update(['amount' => $validated['amount']]);

        return redirect()->back()->with('success', 'تم تحديث كمية التبرع بنجاح');
    }

    /**
     * جلب تفاصيل الحساب البنكي
     */
    public function getBankDetails($id)
    {
        $bankAccount = BankAccount::findOrFail($id);
        return response()->json($bankAccount);
    }

    /**
     * جلب تفاصيل المحفظة الإلكترونية
     */
    public function getWalletDetails($id)
    {
        $eWallet = EWallet::findOrFail($id);
        return response()->json($eWallet);
    }
} 