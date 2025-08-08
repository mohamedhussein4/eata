<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_name',
        'email',
        'phone',
        'address',
        'logo',
        'facebook_link',
        'twitter_link',
        'youtube_link',
        'linkedin_link',
        'copyright',
        'footer_description',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    /**
     * العلاقة مع الترجمات
     */
    public function translations()
    {
        return $this->hasMany(SettingTranslation::class);
    }

    /**
     * الحصول على الترجمة للغة الحالية
     */
    public function translation($locale = null)
    {
        $locale = $locale ?: App::getLocale();
        return $this->translations()->where('locale', $locale)->first();
    }

    /**
     * الحصول على اسم الموقع المترجم
     */
    public function getTranslatedSiteNameAttribute()
    {
        $translation = $this->translation();
        return $translation ? $translation->site_name : $this->site_name;
    }

    /**
     * الحصول على العنوان المترجم
     */
    public function getTranslatedAddressAttribute()
    {
        $translation = $this->translation();
        return $translation ? $translation->address : $this->address;
    }

    /**
     * الحصول على حقوق النشر المترجمة
     */
    public function getTranslatedCopyrightAttribute()
    {
        $translation = $this->translation();
        return $translation ? $translation->copyright : $this->copyright;
    }

    /**
     * الحصول على وصف التذييل المترجم
     */
    public function getTranslatedFooterDescriptionAttribute()
    {
        $translation = $this->translation();
        return $translation ? $translation->footer_description : $this->footer_description;
    }

    /**
     * الحصول على عنوان الميتا المترجم
     */
    public function getTranslatedMetaTitleAttribute()
    {
        $translation = $this->translation();
        return $translation ? $translation->meta_title : $this->meta_title;
    }

    /**
     * الحصول على وصف الميتا المترجم
     */
    public function getTranslatedMetaDescriptionAttribute()
    {
        $translation = $this->translation();
        return $translation ? $translation->meta_description : $this->meta_description;
    }

    /**
     * الحصول على كلمات الميتا المترجمة
     */
    public function getTranslatedMetaKeywordsAttribute()
    {
        $translation = $this->translation();
        return $translation ? $translation->meta_keywords : $this->meta_keywords;
    }

    /**
     * حفظ الترجمة
     */
    public function saveTranslation($locale, $data)
    {
        return $this->translations()->updateOrCreate(
            ['locale' => $locale],
            $data
        );
    }
}
