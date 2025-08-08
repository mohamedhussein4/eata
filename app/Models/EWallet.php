<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EWallet extends Model
{
    protected $fillable = [
        'user_id',
        'provider',
        'account_id',
        'currency_type',
        'wallet_link',

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
