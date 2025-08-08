<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class BeneficiaryStory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'content',
        'author_name',
        'author_image',
        'media_type',
        'media_url',
        'location',
        'project_name',
        'is_approved',
        'is_featured',
        'approved_at'
    ];

    protected $casts = [
        'is_approved' => 'boolean',
        'is_featured' => 'boolean',
        'approved_at' => 'datetime',
    ];

    // العلاقة مع المستخدم
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // استعلام مساعد لاسترجاع القصص المعتمدة فقط
    public function scopeApproved($query)
    {
        return $query->where('is_approved', true);
    }

    // استعلام مساعد لاسترجاع القصص المميزة
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    // هل تحتوي القصة على صورة
    public function hasImage()
    {
        return $this->media_type === 'image' && $this->media_url;
    }

    // هل تحتوي القصة على فيديو
    public function hasVideo()
    {
        return $this->media_type === 'video' && $this->media_url;
    }

    /**
     * العلاقة مع الترجمات
     */
    public function translations()
    {
        return $this->hasMany(BeneficiaryStoryTranslation::class);
    }

    /**
     * الحصول على الترجمة الحالية
     */
    public function translation()
    {
        return $this->translations()->where('locale', app()->getLocale())->first();
    }

    /**
     * الحصول على العنوان المترجم
     */
    public function getTranslatedTitleAttribute()
    {
        return $this->translation()->title ?? $this->title;
    }

    /**
     * الحصول على المحتوى المترجم
     */
    public function getTranslatedContentAttribute()
    {
        return $this->translation()->content ?? $this->content;
    }

    /**
     * الحصول على الموقع المترجم
     */
    public function getTranslatedLocationAttribute()
    {
        $translation = $this->translation();
        return $translation ? $translation->location : $this->location;
    }

    /**
     * الحصول على اسم المشروع المترجم
     */
    public function getTranslatedProjectNameAttribute()
    {
        $translation = $this->translation();
        return $translation ? $translation->project_name : $this->project_name;
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
