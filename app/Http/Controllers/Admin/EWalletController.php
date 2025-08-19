<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EWallet;
use Illuminate\Http\Request;

class EWalletController extends Controller
{
    public function index()
    {
        $eWallets = EWallet::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.e-wallets.index', compact('eWallets'));
    }

    public function create()
    {
        return view('admin.e-wallets.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'provider' => 'required|string|max:255',
            'account_id' => 'required|string|max:255',
            'currency_type' => 'nullable|string|max:50',
            'wallet_link' => 'nullable|string|max:255',
        ]);

        EWallet::create($validated);

        return redirect()->route('admin.e-wallets.index')->with('success', 'تم إضافة المحفظة الإلكترونية بنجاح');
    }

    public function show(EWallet $eWallet)
    {
        return view('admin.e-wallets.show', compact('eWallet'));
    }

    public function edit(EWallet $eWallet)
    {
        return view('admin.e-wallets.edit', compact('eWallet'));
    }

    public function update(Request $request, EWallet $eWallet)
    {
        $validated = $request->validate([
            'provider' => 'required|string|max:255',
            'account_id' => 'required|string|max:255',
            'currency_type' => 'nullable|string|max:50',
            'wallet_link' => 'nullable|string|max:255',
        ]);

        $eWallet->update($validated);

        return redirect()->route('admin.e-wallets.index')->with('success', 'تم تحديث المحفظة الإلكترونية بنجاح');
    }

    public function destroy(EWallet $eWallet)
    {
        $eWallet->delete();
        return redirect()->route('admin.e-wallets.index')->with('success', 'تم حذف المحفظة الإلكترونية بنجاح');
    }
}
