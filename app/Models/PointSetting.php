<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PointSetting extends Model
{
    protected $fillable = [
        'donation_type',
        'points_per_amount',
        'amount_threshold',
        'description',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // حساب النقاط بناءً على المبلغ
    public function calculatePoints($amount)
    {
        if ($amount >= $this->amount_threshold) {
            return floor($amount / $this->amount_threshold) * $this->points_per_amount;
        }
        return 0;
    }
}
