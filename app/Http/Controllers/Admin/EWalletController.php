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
            'wallet_name' => 'required|string|max:255',
            'wallet_number' => 'required|string|max:255',
            'account_holder' => 'required|string|max:255',
            'is_active' => 'boolean',
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
            'wallet_name' => 'required|string|max:255',
            'wallet_number' => 'required|string|max:255',
            'account_holder' => 'required|string|max:255',
            'is_active' => 'boolean',
        ]);

        $eWallet->update($validated);

        return redirect()->route('admin.e-wallets.index')->with('success', 'تم تحديث المحفظة الإلكترونية بنجاح');
    }

    public function destroy(EWallet $eWallet)
    {
        $eWallet->delete();
        return redirect()->route('admin.e-wallets.index')->with('success', 'تم حذف المحفظة الإلكترونية بنجاح');
    }

    public function toggleStatus(EWallet $eWallet)
    {
        $eWallet->update(['is_active' => !$eWallet->is_active]);
        return redirect()->back()->with('success', 'تم تحديث حالة المحفظة الإلكترونية بنجاح');
    }
} 