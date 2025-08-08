<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmsDonationRecord extends Model
{
    use HasFactory;

    /**
     * الحقول القابلة للتعديل
     */
    protected $fillable = [
        'amount',      // قيمة التبرع
        'sms_code',    // رقم الرسالة
        'message_text', // الرسالة
        'phone_number', // رقم هاتف التبرع
        'status',      // حالة التبرع
        'notes',       // ملاحظات إضافية
    ];

    /**
     * العلاقة مع نوع التبرع (SmsDonation)
     */
    public function smsDonation()
    {
        return $this->belongsTo(SmsDonation::class, 'sms_code', 'sms_code');
    }
}
