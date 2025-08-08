<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DigitalCurrencyDonation extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_method',
        'bank_account_id',
        'e_wallet_id',
        'currency_type',
        'amount',
        'user_id',
        'name',
        'email',
        'phone',
        'proof_document',
        'status',

    ];

    public function bankAccount()
    {
        return $this->belongsTo(BankAccount::class);
    }

    public function eWallet()
    {
        return $this->belongsTo(EWallet::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
