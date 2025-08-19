<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    protected $fillable = [
        'bank_name',
        'account_number',
        'account_name',
        'iban',
        'swift_code'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
