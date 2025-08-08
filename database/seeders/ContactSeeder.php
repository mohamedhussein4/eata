<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Contact;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contacts = [
            [
                'name' => 'أحمد محمد',
                'email' => 'ahmed.contact@example.com',
                'phone' => '+963991111111',
                'message' => 'أريد معرفة المزيد عن طرق التبرع وكيف يمكنني المساعدة في مشاريعكم.',
            ],
            [
                'name' => 'فاطمة علي',
                'email' => 'fatima.contact@example.com',
                'phone' => '+963992222222',
                'message' => 'أحتاج مساعدة لعائلتي، هل يمكنكم مساعدتنا في توفير الطعام والملابس؟',
            ],
            [
                'name' => 'محمد حسن',
                'email' => 'mohammed.contact@example.com',
                'phone' => '+963993333333',
                'message' => 'أريد التطوع معكم، ما هي المتطلبات وكيف يمكنني الانضمام؟',
            ],
            [
                'name' => 'سارة أحمد',
                'email' => 'sara.contact@example.com',
                'phone' => '+963994444444',
                'message' => 'أريد معرفة المزيد عن مشروع التعليم وكيف يمكنني دعمه.',
            ],
            [
                'name' => 'علي محمود',
                'email' => 'ali.contact@example.com',
                'phone' => '+963995555555',
                'message' => 'لدي شكوى حول تأخر وصول المساعدات، أرجو التحقق من الأمر.',
            ],
            [
                'name' => 'نور الدين',
                'email' => 'nour.contact@example.com',
                'phone' => '+963996666666',
                'message' => 'أقترح عليكم إضافة مشروع جديد لمساعدة كبار السن، هل يمكن تنفيذه؟',
            ],
            [
                'name' => 'ليلى كريم',
                'email' => 'layla.contact@example.com',
                'phone' => '+963997777777',
                'message' => 'أريد معرفة المزيد عن جمعيتكم وأنشطتكم، هل يمكن إرسال كتيب إعلامي؟',
            ],
            [
                'name' => 'حسن عبد الله',
                'email' => 'hassan.contact@example.com',
                'phone' => '+963998888888',
                'message' => 'أشكركم على المساعدة التي قدمتموها لعائلتي، لقد غيرتم حياتنا للأفضل.',
            ],
        ];

        foreach ($contacts as $contactData) {
            Contact::create($contactData);
        }

        $this->command->info('تم إنشاء ' . count($contacts) . ' رسالة بنجاح');
    }
}
