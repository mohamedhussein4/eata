<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = [
            [
                'title' => 'مساعدة الأسر المحتاجة',
                'description' => 'مشروع لتقديم المساعدة المادية والعينية للأسر المحتاجة في مختلف المناطق',
                'total_amount' => 5000000,
                'remaining_amount' => 2500000,
                'status' => 'active',
                'visits' => 150,
                'donation_count' => 25,
                'beneficiaries_count' => 50,
            ],
            [
                'title' => 'بناء مدرسة في الريف',
                'description' => 'مشروع لبناء مدرسة في المناطق الريفية لتوفير التعليم للأطفال',
                'total_amount' => 10000000,
                'remaining_amount' => 7000000,
                'status' => 'active',
                'visits' => 200,
                'donation_count' => 40,
                'beneficiaries_count' => 200,
            ],
            [
                'title' => 'توفير المياه النظيفة',
                'description' => 'مشروع لحفر آبار وتوفير المياه النظيفة للمناطق المحرومة',
                'total_amount' => 3000000,
                'remaining_amount' => 1500000,
                'status' => 'active',
                'visits' => 100,
                'donation_count' => 15,
                'beneficiaries_count' => 300,
            ],
            [
                'title' => 'مساعدة المرضى',
                'description' => 'مشروع لتوفير العلاج والدواء للمرضى المحتاجين',
                'total_amount' => 2000000,
                'remaining_amount' => 1200000,
                'status' => 'active',
                'visits' => 80,
                'donation_count' => 12,
                'beneficiaries_count' => 100,
            ],
            [
                'title' => 'إعادة تأهيل المنازل',
                'description' => 'مشروع لإعادة تأهيل المنازل المتضررة وتوفير المأوى للأسر',
                'total_amount' => 8000000,
                'remaining_amount' => 4000000,
                'status' => 'completed',
                'visits' => 300,
                'donation_count' => 60,
                'beneficiaries_count' => 80,
            ],
        ];

        foreach ($projects as $projectData) {
            Project::create($projectData);
        }

        $this->command->info('تم إنشاء ' . count($projects) . ' مشروع بنجاح');
    }
}
