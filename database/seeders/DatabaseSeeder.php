<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // الإعدادات الأساسية
            SettingsSeeder::class,
            
            // البيانات الأساسية
            UserSeeder::class,
            ProjectSeeder::class,
            TestimonialSeeder::class,
            VolunteerSeeder::class,
            BeneficiarySeeder::class,
            PageSeeder::class,
            
            // البيانات المرتبطة
            DonationSeeder::class,
            ContactSeeder::class,
            TicketSeeder::class,
        ]);

        $this->command->info('تم إنشاء جميع البيانات التجريبية بنجاح!');
    }
}
