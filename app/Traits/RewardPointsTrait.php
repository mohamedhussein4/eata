<?php

namespace App\Traits;

use App\Models\RewardPoint;
use App\Models\PointSetting;
use Illuminate\Support\Facades\Auth;

trait RewardPointsTrait
{
    /**
     * إضافة نقاط المكافأة للمستخدم
     */
    protected function addRewardPoints($amount, $donationType, $donatable)
    {

        if (!Auth::check() || !$amount) {

            return;
        }

        $pointSetting = PointSetting::where('donation_type', $donationType)
            ->where('is_active', true)
            ->first();


        if (!$pointSetting) {
            return;
        }


        $points = $pointSetting->calculatePoints($amount);

        if ($points <= 0) {
            return;
        }

        $descriptions = [
            'food_donation' => 'نقاط مكافأة على التبرع الغذائي',
            'regular_donation' => 'نقاط مكافأة على التبرع العادي',
            'sms_donation' => 'نقاط مكافأة على تبرع الرسائل النصية',
            'digital_currency_donation' => 'نقاط مكافأة على تبرع العملات الرقمية',
            'sms_record' => 'نقاط مكافأة على سجل تبرع الرسائل'
        ];

        return RewardPoint::create([
            'user_id' => Auth::id(),
            'points' => $points,
            'donation_type' => $donationType,
            'donation_amount' => $amount,
            'description' => $descriptions[$donationType] ?? 'نقاط مكافأة على التبرع',
            'donatable_type' => get_class($donatable),
            'donatable_id' => $donatable->id
        ]);
    }
}
