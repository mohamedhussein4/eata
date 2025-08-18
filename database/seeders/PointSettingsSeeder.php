<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PointSetting;

class PointSettingsSeeder extends Seeder
{
    public function run()
    {
        $settings = [
            [
                'donation_type' => 'food_donation',
                'points_per_amount' => 10,
                'amount_threshold' => 100,
                'description' => 'نقاط التبرعات الغذائية',
                'is_active' => true
            ],
            [
                'donation_type' => 'regular_donation',
                'points_per_amount' => 15,
                'amount_threshold' => 100,
                'description' => 'نقاط التبرعات العادية',
                'is_active' => true
            ],
            [
                'donation_type' => 'sms_donation',
                'points_per_amount' => 20,
                'amount_threshold' => 50,
                'description' => 'نقاط تبرعات الرسائل',
                'is_active' => true
            ],
            [
                'donation_type' => 'digital_currency_donation',
                'points_per_amount' => 25,
                'amount_threshold' => 100,
                'description' => 'نقاط التبرعات الرقمية',
                'is_active' => true
            ]
        ];

        foreach ($settings as $setting) {
            PointSetting::create($setting);
        }
    }
}
