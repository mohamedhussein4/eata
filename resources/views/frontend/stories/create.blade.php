@extends('frontend.layouts.app')

@section('title', 'شارك قصتك')
@section('meta_description', 'شارك قصتك المؤثرة مع مجتمع منصة عطاء الخيرية')

@section('styles')
<!-- Summernote CSS -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
@endsection

@section('content')
<!-- صورة الخلفية والعنوان -->
<div class="breadcumb-wrapper" data-bg-src="{{ asset('assets2') }}/img/bg/breadcumb-bg.jpg" data-overlay="theme">
    <div class="container">
        <div class="breadcumb-content">
            <h1 class="breadcumb-title">شارك قصتك</h1>
            <ul class="breadcumb-menu">
                <li><a href="{{ route('home') }}"><i class="fa-solid fa-house me-1"></i>الرئيسية</a></li>
                <li><a href="{{ route('stories.index') }}">قصص المستفيدين</a></li>
                <li>شارك قصتك</li>
            </ul>
        </div>
    </div>
</div>

<!-- القسم الرئيسي -->
<section class="space">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="create-story-wrapper">
                    <div class="create-story-header text-center mb-5">
                        <span class="sub-title">شارك مع الآخرين</span>
                        <h2 class="sec-title">اروِ قصة نجاحك</h2>
                        <p class="sec-text">شارك تجربتك مع الآخرين وكيف أحدثت المساعدات فرقاً في حياتك. قصتك يمكن أن تلهم الكثيرين وتساعد في نشر الوعي بأهمية العمل الخيري.</p>
                    </div>

                    @if ($errors->any())
                    <div class="alert alert-danger mb-4">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{ route('stories.store') }}" method="POST" enctype="multipart/form-data" class="create-story-form">
                        @csrf

                        <div class="row">
                            <div class="col-md-12 mb-4">
                                <div class="form-group">
                                    <label for="title">عنوان القصة <span class="text-danger">*</span></label>
                                    <input type="text" id="title" name="title" class="form-control" value="{{ old('title') }}" required>
                                    <small class="form-text text-muted">عنوان مميز يعبر عن قصتك (100 حرف كحد أقصى)</small>
                                </div>
                            </div>

                            <div class="col-md-6 mb-4">
                                <div class="form-group">
                                    <label for="author_name">اسمك <span class="text-danger">*</span></label>
                                    <input type="text" id="author_name" name="author_name" class="form-control" value="{{ old('author_name') ?? (Auth::check() ? Auth::user()->name : '') }}" required>
                                </div>
                            </div>

                            <div class="col-md-6 mb-4">
                                <div class="form-group">
                                    <label for="author_image">صورتك الشخصية</label>
                                    <input type="file" id="author_image" name="author_image" class="form-control" accept="image/*">
                                    <small class="form-text text-muted">صورة اختيارية تظهر بجانب اسمك (2MB كحد أقصى)</small>
                                </div>
                            </div>

                            <div class="col-md-6 mb-4">
                                <div class="form-group">
                                    <label for="location">المدينة أو المنطقة</label>
                                    <input type="text" id="location" name="location" class="form-control" value="{{ old('location') }}">
                                </div>
                            </div>

                            <div class="col-md-6 mb-4">
                                <div class="form-group">
                                    <label for="project_name">اسم المشروع أو المبادرة (إن وجد)</label>
                                    <input type="text" id="project_name" name="project_name" class="form-control" value="{{ old('project_name') }}">
                                    <small class="form-text text-muted">المشروع أو المبادرة التي استفدت منها</small>
                                </div>
                            </div>

                            <div class="col-md-12 mb-4">
                                <div class="form-group">
                                    <label for="content">محتوى القصة <span class="text-danger">*</span></label>
                                    <textarea id="content" name="content" class="form-control summernote" rows="8" required>{{ old('content') }}</textarea>
                                    <small class="form-text text-muted">اروِ قصتك وتجربتك بالتفصيل</small>
                                </div>
                            </div>

                            <div class="col-md-12 mb-4">
                                <label>نوع الوسائط المرفقة</label>
                                <div class="media-type-selector">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="media_type" id="media_image" value="image" {{ old('media_type') == 'image' ? 'checked' : '' }} checked>
                                        <label class="form-check-label" for="media_image">صورة</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="media_type" id="media_video" value="video" {{ old('media_type') == 'video' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="media_video">فيديو</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="media_type" id="media_none" value="none" {{ old('media_type') == 'none' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="media_none">بدون وسائط</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 mb-4" id="media_file_section">
                                <div class="form-group">
                                    <label for="media_file">ملف الوسائط (صورة/فيديو)</label>
                                    <input type="file" id="media_file" name="media_file" class="form-control" accept="image/*,video/*">
                                    <small class="form-text text-muted">يمكنك إرفاق صورة أو فيديو يتعلق بقصتك (20MB كحد أقصى)</small>
                                </div>
                            </div>

                            <div class="col-md-12 mb-4" id="media_url_section" style="display: none;">
                                <div class="form-group">
                                    <label for="media_url">رابط الفيديو (يوتيوب)</label>
                                    <input type="url" id="media_url" name="media_url" class="form-control" value="{{ old('media_url') }}">
                                    <small class="form-text text-muted">رابط فيديو يوتيوب متعلق بقصتك</small>
                                </div>
                            </div>

                            <div class="col-md-12 mb-4">
                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="terms_agree" required>
                                        <label class="form-check-label" for="terms_agree">
                                            أوافق على نشر هذه القصة والصور/الفيديوهات المرفقة وأؤكد صحة المعلومات
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 text-center">
                                <div class="form-note mb-4">
                                    <p><i class="fas fa-info-circle me-1"></i> سيتم مراجعة القصة من قبل الإدارة قبل نشرها على الموقع</p>
                                </div>
                                <div class="form-buttons">
                                    <button type="submit" class="th-btn">
                                        <i class="fas fa-paper-plane me-2"></i> إرسال القصة
                                    </button>
                                    <a href="{{ route('stories.index') }}" class="th-btn style-border">
                                        <i class="fas fa-times me-2"></i> إلغاء
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('scripts')
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
<!-- Summernote JS -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

<script>
    $(document).ready(function() {
        // تهيئة محرر Summernote
        $('.summernote').summernote({
            height: 300,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['link']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ],
            placeholder: 'اكتب قصتك هنا...',
            lang: 'ar-AR',
            direction: 'rtl'
        });

        // تغيير خيارات الوسائط بناءً على الاختيار
        $('input[name="media_type"]').change(function() {
            if ($(this).val() === 'video') {
                $('#media_file_section').show();
                $('#media_url_section').show();
            } else if ($(this).val() === 'image') {
                $('#media_file_section').show();
                $('#media_url_section').hide();
            } else {
                $('#media_file_section').hide();
                $('#media_url_section').hide();
            }
        });
    });
</script>

<style>
/* تنسيقات صفحة إنشاء القصة */
.create-story-wrapper {
    background-color: #fff;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 5px 25px rgba(0,0,0,0.08);
}

.create-story-form label {
    font-weight: 600;
    margin-bottom: 8px;
    color: var(--title-color);
}

.form-control {
    padding: 12px 15px;
    border: 1px solid #e9e9e9;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.form-control:focus {
    border-color: var(--theme-color);
    box-shadow: 0 0 0 0.2rem rgba(var(--theme-rgb), 0.15);
}

.media-type-selector {
    display: flex;
    gap: 15px;
    margin-bottom: 15px;
    flex-wrap: wrap;
}

.form-check-input:checked {
    background-color: var(--theme-color);
    border-color: var(--theme-color);
}

.form-text {
    color: #888;
    font-size: 12px;
    margin-top: 5px;
}

.form-note {
    background-color: #f8f9fa;
    padding: 15px;
    border-radius: 8px;
    font-size: 14px;
    border-left: 3px solid var(--theme-color);
}

.form-buttons {
    display: flex;
    justify-content: center;
    gap: 15px;
    margin-top: 10px;
}

/* Summernote تنسيقات */
.note-editor.note-frame {
    border-color: #e9e9e9;
    border-radius: 8px;
}

.note-editor.note-frame .note-statusbar {
    border-bottom-right-radius: 8px;
    border-bottom-left-radius: 8px;
}

.note-toolbar {
    border-top-right-radius: 8px;
    border-top-left-radius: 8px;
    background-color: #f8f9fa;
}
</style>
@endsection
