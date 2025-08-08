<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'setting_id',
        'locale',
        'site_name',
        'address',
        'copyright',
        'footer_description',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    /**
     * العلاقة مع الإعدادات الأساسية
     */
    public function setting()
    {
        return $this->belongsTo(Setting::class);
    }
}
