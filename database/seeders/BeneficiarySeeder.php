<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Beneficiary;

class BeneficiarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $beneficiaries = [
            [
                'name' => 'عائلة محمد أحمد',
                'phone' => '+963991234567',
                'address' => 'دمشق، حي الميدان',
                'family_size' => 6,
                'income' => 50000,
                'needs' => 'طعام، ملابس، أدوية',
                'story' => 'عائلة مكونة من 6 أفراد، الأب عاطل عن العمل والأم تعمل في تنظيف المنازل. لديهم 4 أطفال في سن المدرسة ويحتاجون مساعدة في توفير الاحتياجات الأساسية.',
                'status' => 'approved',
            ],
            [
                'name' => 'عائلة فاطمة علي',
                'phone' => '+963992345678',
                'address' => 'حلب، حي الصالحين',
                'family_size' => 4,
                'income' => 75000,
                'needs' => 'تعليم، كتب مدرسية، ملابس',
                'story' => 'أم عزباء مع 3 أطفال، تعمل في خياطة الملابس. تحتاج مساعدة في توفير التعليم للأطفال وشراء الكتب المدرسية.',
                'status' => 'approved',
            ],
            [
                'name' => 'عائلة أحمد حسن',
                'phone' => '+963993456789',
                'address' => 'حمص، حي باب عمرو',
                'family_size' => 8,
                'income' => 60000,
                'needs' => 'طعام، مأوى، أدوية',
                'story' => 'عائلة كبيرة مكونة من 8 أفراد، الأب مريض ولا يستطيع العمل. يحتاجون مساعدة في توفير الطعام والدواء.',
                'status' => 'pending',
            ],
            [
                'name' => 'عائلة سارة محمود',
                'phone' => '+963994567890',
                'address' => 'حماة، حي الحاضر',
                'family_size' => 5,
                'income' => 80000,
                'needs' => 'تعليم، أجهزة إلكترونية، ملابس',
                'story' => 'عائلة لديها 3 أطفال في سن المراهقة، يحتاجون مساعدة في توفير التعليم والأجهزة الإلكترونية للدراسة.',
                'status' => 'approved',
            ],
            [
                'name' => 'عائلة علي كريم',
                'phone' => '+963995678901',
                'address' => 'اللاذقية، حي القرداحة',
                'family_size' => 7,
                'income' => 45000,
                'needs' => 'طعام، مأوى، أدوية',
                'story' => 'عائلة فقدت منزلها في الحرب، يعيشون في مأوى مؤقت. يحتاجون مساعدة في إعادة بناء منزلهم.',
                'status' => 'approved',
            ],
            [
                'name' => 'عائلة نور الدين',
                'phone' => '+963996789012',
                'address' => 'طرطوس، حي الشيخ سعد',
                'family_size' => 4,
                'income' => 90000,
                'needs' => 'تعليم، كتب، ملابس',
                'story' => 'عائلة لديها طفلان في المدرسة، يحتاجون مساعدة في توفير الكتب المدرسية والملابس.',
                'status' => 'pending',
            ],
        ];

        foreach ($beneficiaries as $beneficiaryData) {
            Beneficiary::create($beneficiaryData);
        }

        $this->command->info('تم إنشاء ' . count($beneficiaries) . ' مستفيد بنجاح');
    }
}
