<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmsDonation extends Model
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
    ];

    /**
     * العلاقة مع المستخدم
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
