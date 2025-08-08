<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\EWallet;
use Illuminate\Http\Request;

class EWalletController extends Controller
{
    public function index()
    {
        $eWallets = EWallet::where('is_active', true)->get();
        return view('frontend.e-wallets.index', compact('eWallets'));
    }

    public function show(EWallet $eWallet)
    {
        if (!$eWallet->is_active) {
            abort(404);
        }

        return view('frontend.e-wallets.show', compact('eWallet'));
    }

    public function getDetails($id)
    {
        $eWallet = EWallet::where('id', $id)
            ->where('is_active', true)
            ->firstOrFail();

        return response()->json($eWallet);
    }

    public function list()
    {
        $eWallets = EWallet::where('is_active', true)
            ->orderBy('wallet_name')
            ->get();

        return response()->json($eWallets);
    }
} 