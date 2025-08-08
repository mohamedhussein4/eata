<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BankAccount;
use Illuminate\Http\Request;

class BankAccountController extends Controller
{
    public function index()
    {
        $bankAccounts = BankAccount::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.bank-accounts.index', compact('bankAccounts'));
    }

    public function create()
    {
        return view('admin.bank-accounts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'bank_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:255',
            'account_holder' => 'required|string|max:255',
            'iban' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ]);

        BankAccount::create($validated);

        return redirect()->route('admin.bank-accounts.index')->with('success', 'تم إضافة الحساب البنكي بنجاح');
    }

    public function show(BankAccount $bankAccount)
    {
        return view('admin.bank-accounts.show', compact('bankAccount'));
    }

    public function edit(BankAccount $bankAccount)
    {
        return view('admin.bank-accounts.edit', compact('bankAccount'));
    }

    public function update(Request $request, BankAccount $bankAccount)
    {
        $validated = $request->validate([
            'bank_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:255',
            'account_holder' => 'required|string|max:255',
            'iban' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ]);

        $bankAccount->update($validated);

        return redirect()->route('admin.bank-accounts.index')->with('success', 'تم تحديث الحساب البنكي بنجاح');
    }

    public function destroy(BankAccount $bankAccount)
    {
        $bankAccount->delete();
        return redirect()->route('admin.bank-accounts.index')->with('success', 'تم حذف الحساب البنكي بنجاح');
    }

    public function toggleStatus(BankAccount $bankAccount)
    {
        $bankAccount->update(['is_active' => !$bankAccount->is_active]);
        return redirect()->back()->with('success', 'تم تحديث حالة الحساب البنكي بنجاح');
    }
} 