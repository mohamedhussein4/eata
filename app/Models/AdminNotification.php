<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminNotification extends Model
{
    use HasFactory;

    /**
     * الحقول القابلة للتعديل
     */
    protected $fillable = [
        'title',
        'message',
        'type',
        'icon',
        'record_id',
        'url',
        'is_read',
    ];

    /**
     * تحويل بعض الحقول
     */
    protected $casts = [
        'is_read' => 'boolean',
    ];

    /**
     * تعليم الإشعار كمقروء
     */
    public function markAsRead()
    {
        $this->is_read = true;
        $this->save();

        return $this;
    }

    /**
     * تعليم الإشعار كغير مقروء
     */
    public function markAsUnread()
    {
        $this->is_read = false;
        $this->save();

        return $this;
    }

    /**
     * الحصول على أيقونة الإشعار حسب النوع
     */
    public function getIconClass()
    {
        return $this->icon ?: match ($this->type) {
            'donation' => 'icon-heart',
            'sms_donation' => 'icon-message-square',
            'volunteer' => 'icon-users',
            'beneficiary' => 'icon-user-check',
            'contact' => 'icon-mail',
            'ticket' => 'icon-help-circle',
            default => 'icon-bell',
        };
    }

    /**
     * الحصول على لون الإشعار حسب النوع
     */
    public function getColorClass()
    {
        return match ($this->type) {
            'donation' => 'success',
            'sms_donation' => 'primary',
            'volunteer' => 'info',
            'beneficiary' => 'warning',
            'contact' => 'secondary',
            'ticket' => 'danger',
            default => 'dark',
        };
    }
}
