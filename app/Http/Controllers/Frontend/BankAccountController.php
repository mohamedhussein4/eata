<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BankAccount;
use Illuminate\Http\Request;

class BankAccountController extends Controller
{
    public function index()
    {
        $bankAccounts = BankAccount::where('is_active', true)->get();
        return view('frontend.bank-accounts.index', compact('bankAccounts'));
    }

    public function show(BankAccount $bankAccount)
    {
        if (!$bankAccount->is_active) {
            abort(404);
        }

        return view('frontend.bank-accounts.show', compact('bankAccount'));
    }

    public function getDetails($id)
    {
        $bankAccount = BankAccount::where('id', $id)
            ->where('is_active', true)
            ->firstOrFail();

        return response()->json($bankAccount);
    }

    public function list()
    {
        $bankAccounts = BankAccount::where('is_active', true)
            ->orderBy('bank_name')
            ->get();

        return response()->json($bankAccounts);
    }
} 