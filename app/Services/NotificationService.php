<?php

namespace App\Services;

use App\Models\AdminNotification;
use Illuminate\Support\Facades\URL;

class NotificationService
{
    /**
     * إنشاء إشعار جديد
     *
     * @param string $title عنوان الإشعار
     * @param string $message نص الإشعار
     * @param string $type نوع الإشعار
     * @param int|null $recordId معرف السجل المرتبط
     * @param string|null $url رابط الإشعار
     * @param string|null $icon أيقونة الإشعار
     * @return AdminNotification
     */
    public static function createNotification(
        string $title,
        string $message,
        string $type,
        ?int $recordId = null,
        ?string $url = null,
        ?string $icon = null
    ): AdminNotification {
        return AdminNotification::create([
            'title' => $title,
            'message' => $message,
            'type' => $type,
            'record_id' => $recordId,
            'url' => $url,
            'icon' => $icon,
            'is_read' => false,
        ]);
    }

    /**
     * إنشاء إشعار تبرع جديد
     *
     * @param mixed $donation التبرع
     * @param string $type نوع التبرع
     * @return AdminNotification
     */
    public static function newDonation($donation, string $type = 'donation'): AdminNotification
    {
        $amount = $donation->amount ?? null;
        $id = $donation->id ?? null;

        $title = 'تبرع جديد';
        $message = 'تم استلام تبرع جديد';

        if ($amount) {
            $message .= ' بقيمة ' . $amount . ' ل.س';
        }

        $url = match($type) {
            'sms_donation' => $id ? URL::route('admin.sms_donation_records.show', $id) : null,
            'donation' => $id ? URL::route('admin.donations.show', $id) : null,
            'digital_currency' => $id ? URL::route('admin.digital_currency_donations.show', $id) : null,
            'food_donation' => $id ? URL::route('admin.food-donations.show', $id) : null,
            default => null,
        };

        return self::createNotification(
            $title,
            $message,
            $type,
            $id,
            $url
        );
    }

    /**
     * إنشاء إشعار تبرع بالرسائل النصية
     *
     * @param mixed $smsDonation التبرع بالرسائل النصية
     * @return AdminNotification
     */
    public static function newSmsDonation($smsDonation): AdminNotification
    {
        return self::newDonation($smsDonation, 'sms_donation');
    }

    /**
     * إنشاء إشعار متطوع جديد
     *
     * @param mixed $volunteer المتطوع
     * @return AdminNotification
     */
    public static function newVolunteer($volunteer): AdminNotification
    {
        $name = $volunteer->name ?? 'متطوع جديد';
        $id = $volunteer->id ?? null;

        $title = 'متطوع جديد';
        $message = 'تم تسجيل متطوع جديد: ' . $name;
        $url = $id ? URL::route('admin.volunteers.show', $id) : null;

        return self::createNotification(
            $title,
            $message,
            'volunteer',
            $id,
            $url
        );
    }

    /**
     * إنشاء إشعار مستفيد جديد
     *
     * @param mixed $beneficiary المستفيد
     * @return AdminNotification
     */
    public static function newBeneficiary($beneficiary): AdminNotification
    {
        $name = $beneficiary->name ?? 'مستفيد جديد';
        $id = $beneficiary->id ?? null;

        $title = 'مستفيد جديد';
        $message = 'تم تسجيل مستفيد جديد: ' . $name;
        $url = $id ? URL::route('admin.beneficiaries.show', $id) : null;

        return self::createNotification(
            $title,
            $message,
            'beneficiary',
            $id,
            $url
        );
    }

    /**
     * إنشاء إشعار رسالة اتصال جديدة
     *
     * @param mixed $contact رسالة الاتصال
     * @return AdminNotification
     */
    public static function newContact($contact): AdminNotification
    {
        $name = $contact->name ?? 'زائر';
        $subject = $contact->subject ?? 'موضوع جديد';
        $id = $contact->id ?? null;

        $title = 'رسالة اتصال جديدة';
        $message = 'رسالة جديدة من: ' . $name . ' - ' . $subject;
        $url = $id ? URL::route('admin.contacts.show', $id) : null;

        return self::createNotification(
            $title,
            $message,
            'contact',
            $id,
            $url
        );
    }

    /**
     * إنشاء إشعار تذكرة دعم فني جديدة
     *
     * @param mixed $ticket التذكرة
     * @return AdminNotification
     */
    public static function newTicket($ticket): AdminNotification
    {
        $title = 'تذكرة دعم فني جديدة';
        $message = 'تم إنشاء تذكرة دعم فني جديدة';

        if (isset($ticket->subject)) {
            $message .= ': ' . $ticket->subject;
        }

        $id = $ticket->id ?? null;
        $url = $id ? URL::route('admin.tickets.show', $id) : null;

        return self::createNotification(
            $title,
            $message,
            'ticket',
            $id,
            $url
        );
    }

    /**
     * تعليم جميع الإشعارات كمقروءة
     */
    public static function markAllAsRead(): void
    {
        AdminNotification::where('is_read', false)
            ->update(['is_read' => true]);
    }

    /**
     * حذف جميع الإشعارات المقروءة
     */
    public static function clearReadNotifications(): int
    {
        return AdminNotification::where('is_read', true)->delete();
    }

    /**
     * الحصول على عدد الإشعارات غير المقروءة
     */
    public static function getUnreadCount(): int
    {
        return AdminNotification::where('is_read', false)->count();
    }
}
