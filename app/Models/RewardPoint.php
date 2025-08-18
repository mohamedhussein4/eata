<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RewardPoint extends Model
{
    protected $fillable = [
        'user_id',
        'points',
        'donation_type',
        'donation_amount',
        'description',
        'donatable_type',
        'donatable_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function donatable()
    {
        return $this->morphTo();
    }

    // حساب مجموع النقاط للمستخدم
    public static function getUserPoints($userId)
    {
        return self::where('user_id', $userId)->sum('points');
    }

    // حساب نقاط المستخدم حسب نوع التبرع
    public static function getUserPointsByType($userId, $type)
    {
        return self::where('user_id', $userId)
                   ->where('donation_type', $type)
                   ->sum('points');
    }
}
