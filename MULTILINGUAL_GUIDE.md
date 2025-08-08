# دليل النظام متعدد اللغات - EATA Project

## نظرة عامة
تم إعداد مشروع EATA لدعم اللغتين العربية والإنجليزية مع نظام ترجمة شامل يشمل المحتوى الديناميكي والواجهات.

## الميزات المطبقة

### 1. إعدادات النظام الأساسية
- **اللغات المدعومة**: العربية (ar) والإنجليزية (en)
- **اللغة الافتراضية**: العربية
- **CSS ديناميكي**: Bootstrap RTL للعربية، Bootstrap عادي للإنجليزية
- **اتجاه النص**: RTL للعربية، LTR للإنجليزية

### 2. جداول الترجمة
تم إنشاء جداول ترجمة للمحتوى الديناميكي:

#### `project_translations`
- `project_id` - ربط بالمشروع الأساسي
- `locale` - كود اللغة (ar/en)
- `title` - عنوان المشروع المترجم
- `description` - وصف المشروع المترجم

#### `page_translations`
- `page_id` - ربط بالصفحة الأساسية
- `locale` - كود اللغة
- `title` - عنوان الصفحة
- `content` - محتوى الصفحة
- `meta_title` - عنوان SEO
- `meta_description` - وصف SEO

#### `testimonial_translations`
- `testimonial_id` - ربط بالرأي الأساسي
- `locale` - كود اللغة
- `title` - عنوان الرأي (اختياري)
- `content` - محتوى الرأي

#### `beneficiary_story_translations`
- `beneficiary_story_id` - ربط بالقصة الأساسية
- `locale` - كود اللغة
- `title` - عنوان القصة
- `content` - محتوى القصة
- `location` - الموقع
- `project_name` - اسم المشروع

#### `setting_translations`
- `setting_id` - ربط بالإعدادات الأساسية
- `locale` - كود اللغة
- `site_name` - اسم الموقع
- `address` - العنوان
- `copyright` - حقوق النشر
- `footer_description` - وصف التذييل
- `meta_title`, `meta_description`, `meta_keywords` - بيانات SEO

### 3. النماذج المحدثة (Models)

#### Project Model
```php
// الحصول على العنوان المترجم
$project->translated_title

// الحصول على الوصف المترجم
$project->translated_description

// حفظ ترجمة جديدة
$project->saveTranslation('en', [
    'title' => 'English Title',
    'description' => 'English Description'
]);
```

#### استخدام مشابه في النماذج الأخرى:
- `Page` - `translated_title`, `translated_content`
- `Testimonial` - `translated_title`, `translated_content`
- `BeneficiaryStory` - `translated_title`, `translated_content`
- `Setting` - `translated_site_name`, `translated_address`

### 4. التحكمات المحدثة (Controllers)

#### ProjectController
```php
// في store() و update()
// حفظ الترجمة العربية
if ($request->title || $request->description) {
    $project->saveTranslation('ar', [
        'title' => $request->title,
        'description' => $request->description,
    ]);
}

// حفظ الترجمة الإنجليزية
if ($request->title_en || $request->description_en) {
    $project->saveTranslation('en', [
        'title' => $request->title_en,
        'description' => $request->description_en,
    ]);
}
```

### 5. Middleware للغات
- `LocalizationMiddleware` - يتحكم في اللغة الحالية
- يحدد اللغة من الـ URL أو الـ Session
- يشارك متغيرات اللغة مع جميع الـ Views

### 6. مساعدات اللغة (Helpers)

#### LanguageHelper
```php
// الحصول على اللغة الحالية
LanguageHelper::getCurrentLocale()

// التحقق من الاتجاه
LanguageHelper::isRTL()
LanguageHelper::isLTR()

// الحصول على CSS المناسب
LanguageHelper::getCurrentCSS()

// تغيير اللغة
LanguageHelper::setLocale('en')

// إنشاء URL مع اللغة
LanguageHelper::localizedUrl('/projects', 'en')
```

### 7. ملفات الترجمة

#### `resources/lang/ar/messages.php`
```php
return [
    'home' => 'الرئيسية',
    'projects' => 'المشاريع',
    'donate' => 'تبرع الآن',
    // ... المزيد
];
```

#### `resources/lang/en/messages.php`
```php
return [
    'home' => 'Home',
    'projects' => 'Projects',
    'donate' => 'Donate Now',
    // ... المزيد
];
```

### 8. مكونات Blade

#### Language Switcher
```blade
@include('components.language-switcher')
```

#### Language Meta
```blade
@include('components.language-meta')
```

### 9. Blade Directives المخصصة

```blade
@lang {{-- يعرض اللغة الحالية --}}
@direction {{-- يعرض rtl أو ltr --}}
@langcss {{-- يعرض ملف CSS المناسب --}}

@isRTL
    {{-- محتوى للغة العربية --}}
@endisRTL

@isLTR
    {{-- محتوى للغة الإنجليزية --}}
@endisLTR
```

## كيفية الاستخدام

### 1. تغيير اللغة
```
GET /language/{locale}
```
مثال: `/language/en` للتبديل للإنجليزية

### 2. في الـ Views
```blade
{{-- عرض النص المترجم --}}
<h1>{{ __('messages.welcome') }}</h1>

{{-- عرض محتوى مترجم من قاعدة البيانات --}}
<h2>{{ $project->translated_title }}</h2>
<p>{{ $project->translated_description }}</p>

{{-- CSS ديناميكي --}}
<link href="{{ asset('assets2/css/' . (app()->getLocale() === 'ar' ? 'bootstrap.rtl.min.css' : 'bootstrap.min.css')) }}" rel="stylesheet">
```

### 3. في الـ Controllers
```php
// إنشاء محتوى مع ترجمات
$project = Project::create($data);

// حفظ الترجمات
$project->saveTranslation('ar', [
    'title' => $request->title_ar,
    'description' => $request->description_ar
]);

$project->saveTranslation('en', [
    'title' => $request->title_en,
    'description' => $request->description_en
]);
```

### 4. في النماذج (Forms)
```blade
<form method="POST">
    {{-- الترجمة العربية --}}
    <div class="mb-3">
        <label>{{ __('messages.title') }} (العربية)</label>
        <input type="text" name="title" class="form-control">
    </div>
    
    <div class="mb-3">
        <label>{{ __('messages.description') }} (العربية)</label>
        <textarea name="description" class="form-control"></textarea>
    </div>
    
    {{-- الترجمة الإنجليزية --}}
    <div class="mb-3">
        <label>{{ __('messages.title') }} (English)</label>
        <input type="text" name="title_en" class="form-control">
    </div>
    
    <div class="mb-3">
        <label>{{ __('messages.description') }} (English)</label>
        <textarea name="description_en" class="form-control"></textarea>
    </div>
    
    <button type="submit">{{ __('messages.save') }}</button>
</form>
```

## الملفات المهمة

### الإعدادات
- `config/app.php` - إعدادات اللغات الأساسية
- `routes/web.php` - مسارات تغيير اللغة

### المساعدات
- `app/Helpers/LanguageHelper.php` - مساعدات اللغة
- `app/Http/Middleware/LocalizationMiddleware.php` - Middleware اللغة
- `app/Providers/BladeServiceProvider.php` - Blade Directives

### النماذج
- `app/Models/Project.php` - مع دعم الترجمات
- `app/Models/*Translation.php` - نماذج الترجمة

### الـ Views
- `resources/views/components/language-switcher.blade.php`
- `resources/views/components/language-meta.blade.php`
- `resources/views/example-multilingual.blade.php` - مثال شامل

### الترجمات
- `resources/lang/ar/messages.php`
- `resources/lang/en/messages.php`

## المهام المكتملة ✅

1. ✅ إعداد نظام اللغات في Laravel (config, middleware, helpers)
2. ✅ إنشاء جداول الترجمة للمشاريع والجداول الأخرى
3. ✅ تحديث نماذج Eloquent لدعم الترجمات
4. ✅ إنشاء ملفات الترجمة للواجهات
5. ✅ تحديث Controllers لدعم اللغات المتعددة
6. ✅ إضافة middleware للتحكم في اللغة والـ CSS
7. ✅ إنشاء مكونات Blade للغات
8. ✅ إنشاء Blade Directives مخصصة
9. ✅ إنشاء مثال شامل للاستخدام

## الخطوات التالية (اختيارية)

1. تحديث جميع الـ Views الموجودة لاستخدام النظام الجديد
2. إضافة المزيد من اللغات إذا لزم الأمر
3. تطوير واجهة إدارة للترجمات
4. إضافة تخزين مؤقت للترجمات لتحسين الأداء
5. إضافة اختبارات للنظام متعدد اللغات

## ملاحظات مهمة

- تم الحفاظ على جميع البيانات الموجودة في قاعدة البيانات
- النظام يعمل بشكل تراجعي مع المحتوى الموجود
- يمكن إضافة ترجمات تدريجياً دون تأثير على الوظائف الحالية
- النظام يدعم إضافة المزيد من اللغات بسهولة في المستقبل
