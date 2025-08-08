<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Donation;
use App\Models\User;
use App\Models\Project;

class DonationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::where('role', 'user')->take(5)->get();
        $projects = Project::take(5)->get();

        if ($users->isEmpty() || $projects->isEmpty()) {
            $this->command->warn('يجب إنشاء المستخدمين والمشاريع أولاً');
            return;
        }

        $donations = [
            [
                'amount' => 100000,
                'donor_name' => 'أحمد محمد',
                'donor_email' => 'ahmed@example.com',
                'donor_phone' => '+963991111111',
                'message' => 'أتمنى أن تصل هذه المساعدة للمحتاجين',
                'payment_method' => 'bank_transfer',
                'status' => 'completed',
            ],
            [
                'amount' => 50000,
                'donor_name' => 'فاطمة علي',
                'donor_email' => 'fatima@example.com',
                'donor_phone' => '+963992222222',
                'message' => 'تبرع صغير أتمنى أن يساعد',
                'payment_method' => 'cash',
                'status' => 'completed',
            ],
            [
                'amount' => 200000,
                'donor_name' => 'محمد حسن',
                'donor_email' => 'mohammed@example.com',
                'donor_phone' => '+963993333333',
                'message' => 'للمساعدة في مشروع بناء المدرسة',
                'payment_method' => 'bank_transfer',
                'status' => 'completed',
            ],
            [
                'amount' => 75000,
                'donor_name' => 'سارة أحمد',
                'donor_email' => 'sara@example.com',
                'donor_phone' => '+963994444444',
                'message' => 'مساعدة للأسر المحتاجة',
                'payment_method' => 'e_wallet',
                'status' => 'pending',
            ],
            [
                'amount' => 150000,
                'donor_name' => 'علي محمود',
                'donor_email' => 'ali@example.com',
                'donor_phone' => '+963995555555',
                'message' => 'للمساعدة في مشروع المياه النظيفة',
                'payment_method' => 'bank_transfer',
                'status' => 'completed',
            ],
            [
                'amount' => 30000,
                'donor_name' => 'نور الدين',
                'donor_email' => 'nour@example.com',
                'donor_phone' => '+963996666666',
                'message' => 'تبرع بسيط للمساعدة',
                'payment_method' => 'cash',
                'status' => 'completed',
            ],
            [
                'amount' => 120000,
                'donor_name' => 'ليلى كريم',
                'donor_email' => 'layla@example.com',
                'donor_phone' => '+963997777777',
                'message' => 'للمساعدة في مشروع إعادة التأهيل',
                'payment_method' => 'e_wallet',
                'status' => 'completed',
            ],
            [
                'amount' => 80000,
                'donor_name' => 'حسن عبد الله',
                'donor_email' => 'hassan@example.com',
                'donor_phone' => '+963998888888',
                'message' => 'مساعدة للمرضى المحتاجين',
                'payment_method' => 'bank_transfer',
                'status' => 'pending',
            ],
        ];

        foreach ($donations as $donationData) {
            $donation = Donation::create([
                'amount' => $donationData['amount'],
                'donor_name' => $donationData['donor_name'],
                'donor_email' => $donationData['donor_email'],
                'donor_phone' => $donationData['donor_phone'],
                'message' => $donationData['message'],
                'payment_method' => $donationData['payment_method'],
                'status' => $donationData['status'],
                'user_id' => $users->random()->id,
                'project_id' => $projects->random()->id,
            ]);
        }

        $this->command->info('تم إنشاء ' . count($donations) . ' تبرع بنجاح');
    }
}
