<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Donation extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'project_id',
        'amount',
        'donor_name',
        'donor_email',
        'donor_phone',
        'payment_method',
        'bank_account_id',
        'e_wallet_id',
        'payment_proof',
        'status',
        'notes',
    ];

    protected $casts = [
        'amount' => 'float',
    ];

    // العلاقة مع المشروع
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    // العلاقة مع المستخدم
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // العلاقة مع الحساب البنكي
    public function bankAccount()
    {
        return $this->belongsTo(BankAccount::class);
    }

    // العلاقة مع المحفظة الإلكترونية
    public function eWallet()
    {
        return $this->belongsTo(EWallet::class);
    }
}
