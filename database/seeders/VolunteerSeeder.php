<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Volunteer;

class VolunteerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $volunteers = [
            [
                'name' => 'أحمد محمد',
                'email' => 'ahmed.volunteer@example.com',
                'phone' => '+963991111111',
                'address' => 'دمشق، سوريا',
                'age' => 25,
                'charity_experience' => 'عملت متطوعاً لمدة 3 سنوات في جمعيات خيرية مختلفة',
                'academic_degree' => 'بكالوريوس في العمل الاجتماعي',
                'document_path' => 'volunteer_documents/ahmed_cv.pdf',
            ],
            [
                'name' => 'فاطمة علي',
                'email' => 'fatima.volunteer@example.com',
                'phone' => '+963992222222',
                'address' => 'حلب، سوريا',
                'age' => 30,
                'charity_experience' => 'معلمة متطوعة في مشاريع التعليم لمدة 5 سنوات',
                'academic_degree' => 'بكالوريوس في التربية',
                'document_path' => 'volunteer_documents/fatima_cv.pdf',
            ],
            [
                'name' => 'محمد حسن',
                'email' => 'mohammed.volunteer@example.com',
                'phone' => '+963993333333',
                'address' => 'حمص، سوريا',
                'age' => 28,
                'charity_experience' => 'متطوع في مشاريع توزيع الطعام والمساعدات الإنسانية',
                'academic_degree' => 'دبلوم في إدارة الأعمال',
                'document_path' => 'volunteer_documents/mohammed_cv.pdf',
            ],
            [
                'name' => 'سارة أحمد',
                'email' => 'sara.volunteer@example.com',
                'phone' => '+963994444444',
                'address' => 'حماة، سوريا',
                'age' => 22,
                'charity_experience' => 'متطوعة جديدة في مجال التصميم والاتصال',
                'academic_degree' => 'بكالوريوس في التصميم الجرافيكي',
                'document_path' => 'volunteer_documents/sara_cv.pdf',
            ],
            [
                'name' => 'علي محمود',
                'email' => 'ali.volunteer@example.com',
                'phone' => '+963995555555',
                'address' => 'اللاذقية، سوريا',
                'age' => 35,
                'charity_experience' => 'طبيب متطوع في العيادات الميدانية لمدة 8 سنوات',
                'academic_degree' => 'دكتوراه في الطب',
                'document_path' => 'volunteer_documents/ali_cv.pdf',
            ],
            [
                'name' => 'نور الدين',
                'email' => 'nour.volunteer@example.com',
                'phone' => '+963996666666',
                'address' => 'طرطوس، سوريا',
                'age' => 27,
                'charity_experience' => 'متطوع في مشاريع إعادة الإعمار وبناء المنازل',
                'academic_degree' => 'بكالوريوس في الهندسة المدنية',
                'document_path' => 'volunteer_documents/nour_cv.pdf',
            ],
            [
                'name' => 'ليلى كريم',
                'email' => 'layla.volunteer@example.com',
                'phone' => '+963997777777',
                'address' => 'دير الزور، سوريا',
                'age' => 24,
                'charity_experience' => 'متطوعة في مراكز الشباب ومشاريع التعليم',
                'academic_degree' => 'بكالوريوس في علم النفس',
                'document_path' => 'volunteer_documents/layla_cv.pdf',
            ],
            [
                'name' => 'حسن عبد الله',
                'email' => 'hassan.volunteer@example.com',
                'phone' => '+963998888888',
                'address' => 'إدلب، سوريا',
                'age' => 32,
                'charity_experience' => 'قائد فريق متطوعين في مشاريع إنسانية مختلفة',
                'academic_degree' => 'ماجستير في إدارة المشاريع',
                'document_path' => 'volunteer_documents/hassan_cv.pdf',
            ],
        ];

        foreach ($volunteers as $volunteerData) {
            Volunteer::create($volunteerData);
        }

        $this->command->info('تم إنشاء ' . count($volunteers) . ' متطوع بنجاح');
    }
}
