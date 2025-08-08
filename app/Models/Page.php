<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;

class Page extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'slug',
        'content',
        'is_active',
        'sort_order',
        'meta_title',
        'meta_description',
        'featured_image',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        // إنشاء slug من العنوان تلقائيًا عند إنشاء الصفحة
        static::creating(function ($page) {
            if (empty($page->slug)) {
                $page->slug = Str::slug($page->title);
            }
        });
    }

    /**
     * الحصول على رابط الصفحة
     */
    public function getUrlAttribute()
    {
        return url('page/' . $this->slug);
    }

    /**
     * الحصول على الصفحات النشطة
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * الحصول على الصفحات مرتبة
     */
    public function scopeSorted($query)
    {
        return $query->orderBy('sort_order', 'asc');
    }

    /**
     * العلاقة مع الترجمات
     */
    public function translations()
    {
        return $this->hasMany(PageTranslation::class);
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
