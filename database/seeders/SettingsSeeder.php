<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            'site_name' => 'اسم الموقع',
            'email' => 'example@example.com',
            'phone' => '1234567890',
            'address' => '123 شارع رئيسي، المدينة',
            'logo' => 'default-logo.png', 
            'facebook_link' => 'https://facebook.com',
            'twitter_link' => 'https://twitter.com',
            'youtube_link' => 'https://youtube.com',
            'linkedin_link' => 'https://linkedin.com',
            'copyright' => 'جميع الحقوق محفوظة © 2024',
            'footer_description' => 'هذا هو وصف الفوتر الافتراضي.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
