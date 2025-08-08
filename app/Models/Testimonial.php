<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Carbon\Carbon;

class Testimonial extends Model
{
    use HasFactory;

    /**
     * الخصائص التي يمكن تعيينها بشكل جماعي.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'title',
        'content',
        'image',
        'rating',
        'is_approved',
        'approved_at',
        'is_featured',
        'user_id',
        'order',
    ];

    /**
     * الخصائص التي يجب تحويلها.
     *
     * @var array
     */
    protected $casts = [
        'is_approved' => 'boolean',
        'is_featured' => 'boolean',
        'approved_at' => 'datetime',
        'rating' => 'integer',
        'order' => 'integer',
    ];

    /**
     * علاقة مع المستخدم (إذا كان موجوداً)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * قبول الرأي
     */
    public function approve()
    {
        $this->update([
            'is_approved' => true,
            'approved_at' => Carbon::now(),
        ]);
    }

    /**
     * إلغاء قبول الرأي
     */
    public function unapprove()
    {
        $this->update([
            'is_approved' => false,
            'approved_at' => null,
        ]);
    }

    /**
     * تبديل حالة التمييز
     */
    public function toggleFeatured()
    {
        $this->update([
            'is_featured' => !$this->is_featured,
        ]);
    }

    /**
     * تحديد ما إذا كان هناك صورة
     */
    public function hasImage()
    {
        return !empty($this->image);
    }

    /**
     * الحصول على الآراء المعتمدة
     */
    public function scopeApproved($query)
    {
        return $query->where('is_approved', true);
    }

    /**
     * الحصول على الآراء المميزة
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * الحصول على الآراء المعلقة
     */
    public function scopePending($query)
    {
        return $query->where('is_approved', false);
    }

    /**
     * ترتيب الآراء حسب الترتيب المخصص
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderBy('created_at', 'desc');
    }

    /**
     * العلاقة مع الترجمات
     */
    public function translations()
    {
        return $this->hasMany(TestimonialTranslation::class);
    }

    /**
     * الحصول على الترجمة الحالية
     */
    public function translation($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        return $this->translations()->where('locale', $locale)->first();
    }

    /**
     * الحصول على الاسم المترجم
     */
    public function getTranslatedNameAttribute()
    {
        return $this->translation()->name ?? $this->name;
    }

    /**
     * الحصول على المحتوى المترجم
     */
    public function getTranslatedContentAttribute()
    {
        return $this->translation()->content ?? $this->content;
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
