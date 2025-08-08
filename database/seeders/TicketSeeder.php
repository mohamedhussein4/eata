<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ticket;
use App\Models\User;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::where('role', 'user')->take(5)->get();

        if ($users->isEmpty()) {
            $this->command->warn('يجب إنشاء المستخدمين أولاً');
            return;
        }

        $tickets = [
            [
                'subject' => 'مشكلة في التبرع عبر الموقع',
                'message' => 'أحاول التبرع عبر الموقع ولكن لا يمكنني إكمال العملية، يرجى المساعدة.',
                'priority' => 'high',
                'status' => 'open',
            ],
            [
                'subject' => 'استفسار عن مشروع معين',
                'message' => 'أريد معرفة المزيد عن مشروع بناء المدرسة، متى سيبدأ وكيف يمكنني المساعدة؟',
                'priority' => 'medium',
                'status' => 'in_progress',
            ],
            [
                'subject' => 'طلب تحديث معلومات الحساب',
                'message' => 'أريد تحديث معلوماتي الشخصية في الحساب، كيف يمكنني ذلك؟',
                'priority' => 'low',
                'status' => 'closed',
            ],
            [
                'subject' => 'مشكلة في تسجيل الدخول',
                'message' => 'لا أستطيع تسجيل الدخول إلى حسابي، يرجى مساعدتي في حل هذه المشكلة.',
                'priority' => 'high',
                'status' => 'open',
            ],
            [
                'subject' => 'اقتراح لتحسين الموقع',
                'message' => 'لدي اقتراح لتحسين تجربة المستخدم في الموقع، هل يمكنني إرسال التفاصيل؟',
                'priority' => 'medium',
                'status' => 'in_progress',
            ],
            [
                'subject' => 'طلب إعادة تعيين كلمة المرور',
                'message' => 'نسيت كلمة المرور الخاصة بي، أريد إعادة تعيينها.',
                'priority' => 'low',
                'status' => 'closed',
            ],
            [
                'subject' => 'شكوى حول تأخر الرد',
                'message' => 'أرسلت رسالة منذ أسبوع ولم أتلق أي رد، أرجو الرد في أقرب وقت ممكن.',
                'priority' => 'high',
                'status' => 'open',
            ],
            [
                'subject' => 'طلب معلومات إضافية',
                'message' => 'أحتاج معلومات إضافية عن أحد المشاريع قبل التبرع، هل يمكنكم مساعدتي؟',
                'priority' => 'medium',
                'status' => 'in_progress',
            ],
        ];

        foreach ($tickets as $ticketData) {
            Ticket::create([
                'subject' => $ticketData['subject'],
                'message' => $ticketData['message'],
                'priority' => $ticketData['priority'],
                'status' => $ticketData['status'],
                'user_id' => $users->random()->id,
            ]);
        }

        $this->command->info('تم إنشاء ' . count($tickets) . ' تذكرة بنجاح');
    }
}
