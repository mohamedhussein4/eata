<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Testimonial;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $testimonials = [
            [
                'name' => 'أحمد محمد',
                'title' => 'مستفيد من مشروع المساعدة',
                'content' => 'أشكركم كثيراً على المساعدة التي قدمتموها لعائلتي. لقد غيرتم حياتنا للأفضل وساعدتمونا في تخطي الأوقات الصعبة.',
                'rating' => 5,
                'is_approved' => true,
            ],
            [
                'name' => 'فاطمة علي',
                'title' => 'أم لثلاثة أطفال',
                'content' => 'بفضل مساعدتكم استطعت توفير الطعام والملابس لأطفالي. أنتم ملائكة الرحمة وأدعو لكم بالخير دائماً.',
                'rating' => 5,
                'is_approved' => true,
            ],
            [
                'name' => 'محمد حسن',
                'title' => 'متطوع في الجمعية',
                'content' => 'أعمل متطوعاً مع الجمعية منذ عامين وأشهد على مدى تأثير مساعداتكم الإيجابي على حياة الناس. العمل معكم شرف كبير.',
                'rating' => 5,
                'is_approved' => true,
            ],
            [
                'name' => 'سارة أحمد',
                'title' => 'مستفيدة من مشروع التعليم',
                'content' => 'بفضل مشروع التعليم استطعت العودة إلى المدرسة وإكمال دراستي. شكراً لكم على إعطائي فرصة ثانية في الحياة.',
                'rating' => 4,
                'is_approved' => true,
            ],
            [
                'name' => 'علي محمود',
                'title' => 'أب لأسرة مكونة من 6 أفراد',
                'content' => 'كنت أعاني من صعوبة في توفير احتياجات أسرتي، ولكن بفضل مساعدتكم استطعت تخطي هذه الأزمة. شكراً لكم من القلب.',
                'rating' => 5,
                'is_approved' => true,
            ],
            [
                'name' => 'نور الدين',
                'title' => 'مستفيد من مشروع المياه',
                'content' => 'كانت مشكلة المياه من أكبر المشاكل التي نواجهها، ولكن بفضل مشروعكم أصبح لدينا مياه نظيفة وصالحة للشرب.',
                'rating' => 4,
                'is_approved' => false,
            ],
            [
                'name' => 'ليلى كريم',
                'title' => 'معلمة متطوعة',
                'content' => 'أعمل معلمة متطوعة في مشروع التعليم وأرى يومياً كيف تغير هذه المشاريع حياة الأطفال. شكراً لكم على دعمكم.',
                'rating' => 5,
                'is_approved' => true,
            ],
        ];

        foreach ($testimonials as $testimonialData) {
            Testimonial::create($testimonialData);
        }

        $this->command->info('تم إنشاء ' . count($testimonials) . ' رأي بنجاح');
    }
}
