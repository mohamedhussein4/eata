<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'content',
        'category',
        'total_amount',
        'remaining_amount',
        'status',
        'visits',
        'beneficiaries_count',
        'image_or_video',
        'is_featured',
    ];

    protected $casts = [
        'total_amount' => 'float',
        'remaining_amount' => 'float',
        'visits' => 'integer',
        'beneficiaries_count' => 'integer',
    ];

    protected $appends = [
        'translated_title',
        'translated_description',
        'translated_content',
    ];

    // العلاقة مع التبرعات
    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    /**
     * العلاقة مع الترجمات
     */
    public function translations()
    {
        return $this->hasMany(ProjectTranslation::class);
    }

    /**
     * الحصول على ترجمة بلغة معينة
     */
    public function translation($locale = null)
    {
        $locale = $locale ?: app()->getLocale();
        return $this->translations()->where('locale', $locale)->first();
    }

    /**
     * الحصول على العنوان المترجم
     */
    public function getTranslatedTitleAttribute()
    {
        $translation = $this->translation();
        return $translation ? $translation->title : $this->title;
    }

    /**
     * الحصول على الوصف المترجم
     */
    public function getTranslatedDescriptionAttribute()
    {
        $translation = $this->translation();
        return $translation ? $translation->description : $this->description;
    }

    /**
     * الحصول على المحتوى المترجم
     */
    public function getTranslatedContentAttribute()
    {
        $translation = $this->translation();
        return $translation ? $translation->content : $this->content;
    }

    /**
     * التحقق من وجود ترجمة للغة معينة
     */
    public function hasTranslation($locale = null)
    {
        $locale = $locale ?: app()->getLocale();
        return $this->translations()->where('locale', $locale)->exists();
    }
}
