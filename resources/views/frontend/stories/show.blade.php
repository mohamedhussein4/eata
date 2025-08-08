@extends('frontend.layouts.app')

@section('title', $story->title)
@section('meta_description', Str::limit(strip_tags($story->content), 160))

@section('content')
<!-- صورة الخلفية والعنوان -->
<div class="breadcumb-wrapper" data-bg-src="{{ asset('assets2') }}/img/bg/breadcumb-bg.jpg" data-overlay="theme">
    <div class="container">
        <div class="breadcumb-content">
            <h1 class="breadcumb-title">{{ $story->title }}</h1>
            <ul class="breadcumb-menu">
                <li><a href="{{ route('home') }}"><i class="fa-solid fa-house me-1"></i>الرئيسية</a></li>
                <li><a href="{{ route('stories.index') }}">قصص المستفيدين</a></li>
                <li>{{ $story->title }}</li>
            </ul>
        </div>
    </div>
</div>

<!-- القسم الرئيسي -->
<section class="as-blog-wrapper space-top space-extra2-bottom">
    <div class="container">
        <div class="row">
            <!-- المحتوى الرئيسي -->
            <div class="col-xxl-8 col-lg-7">
                <div class="as-blog blog-single has-post-thumbnail">
                    <!-- صورة الصفحة الرئيسية -->
                    @if($story->hasImage())
                    <div class="blog-img">
                        <img src="{{ asset('/' . $story->media_url) }}" alt="{{ $story->title }}" class="w-100">
                        <div class="blog-date">
                            <i class="fa-regular fa-calendar-days"></i>
                            {{ $story->created_at->format('d') }}
                            <span>{{ $story->created_at->translatedFormat('M') }}</span>
                        </div>
                    </div>
                    @elseif($story->hasVideo())
                    <div class="blog-img">
                        <div class="video-container">
                            @if(Str::contains($story->media_url, ['youtube', 'youtu.be']))
                                <iframe src="{{ $story->media_url }}" allowfullscreen></iframe>
                            @else
                                <video controls class="w-100">
                                    <source src="{{ asset('/' . $story->media_url) }}" type="video/mp4">
                                    متصفحك لا يدعم تشغيل الفيديو.
                                </video>
                            @endif
                        </div>
                        <div class="blog-date">
                            <i class="fa-regular fa-calendar-days"></i>
                            {{ $story->created_at->format('d') }}
                            <span>{{ $story->created_at->translatedFormat('M') }}</span>
                        </div>
                    </div>
                    @endif

                    <!-- محتوى القصة -->
                    <div class="blog-content">
                        <div class="blog-meta">
                            <a href="#" class="author"><i class="fa-regular fa-clock me-1"></i>{{ $story->created_at->format('Y-m-d') }}</a>
                            @if($story->project_name)
                            <a href="#"><i class="fa-solid fa-tags me-1"></i>{{ $story->project_name }}</a>
                            @endif
                            @if($story->location)
                            <a href="#"><i class="fa-solid fa-map-marker-alt me-1"></i>{{ $story->location }}</a>
                            @endif
                        </div>

                        <!-- معلومات الكاتب -->
                        <div class="author-info-box">
                            <div class="author-image">
                                @if($story->author_image)
                                <img src="{{ asset('/' . $story->author_image) }}" alt="{{ $story->author_name }}">
                                @else
                                <img src="{{ asset('assets2/img/blog/author1.png') }}" alt="{{ $story->author_name }}">
                                @endif
                            </div>
                            <div class="author-details">
                                <h4 class="author-name">{{ $story->author_name }}</h4>
                                <p class="author-bio">صاحب القصة</p>
                            </div>
                        </div>

                        <h2 class="blog-title">{{ $story->title }}</h2>

                        <div class="blog-text">
                            {!! $story->content !!}
                        </div>

                        <!-- أزرار التحكم للمالك والمسؤول -->
                        @auth
                            @if(Auth::id() == $story->user_id || (isset(Auth::user()->role) && Auth::user()->hasRole('admin')))
                            <div class="story-actions-box">
                                <h5 class="mb-3">خيارات إدارة القصة:</h5>
                                <div class="d-flex gap-3 flex-wrap">
                                    <a href="{{ route('stories.edit', $story) }}" class="th-btn style-border">
                                        <i class="fas fa-edit me-2"></i> تعديل القصة
                                    </a>
                                    <form action="{{ route('stories.destroy', $story) }}" method="POST" class="d-inline" onsubmit="return confirm('هل أنت متأكد من حذف هذه القصة؟');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="th-btn style-border danger-btn">
                                            <i class="fas fa-trash-alt me-2"></i> حذف القصة
                                        </button>
                                    </form>
                                </div>
                                @if(!$story->is_approved)
                                <div class="approval-status">
                                    <span class="awaiting-approval">
                                        <i class="fas fa-clock me-1"></i>
                                        في انتظار الموافقة من الإدارة
                                    </span>
                                </div>
                                @endif
                            </div>
                            @endif
                        @endauth

                        <!-- شارك القصة -->
                        <div class="share-links clearfix">
                            <div class="row justify-content-between">
                                <div class="col-md-auto">
                                    <span class="share-links-title">مشاركة:</span>
                                    <ul class="social-links">
                                        <li>
                                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" target="_blank" class="social-facebook">
                                                <i class="fab fa-facebook-f"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://twitter.com/intent/tweet?url={{ url()->current() }}&text={{ $story->title }}" target="_blank" class="social-twitter">
                                                <i class="fab fa-twitter"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://wa.me/?text={{ $story->title }} {{ url()->current() }}" target="_blank" class="social-whatsapp">
                                                <i class="fab fa-whatsapp"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ url()->current() }}&title={{ $story->title }}" target="_blank" class="social-linkedin">
                                                <i class="fab fa-linkedin-in"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- روابط التنقل بين القصص -->
                @php
                    $prevStory = \App\Models\BeneficiaryStory::where('is_approved', true)
                        ->where('id', '<', $story->id)
                        ->orderBy('id', 'desc')
                        ->first();

                    $nextStory = \App\Models\BeneficiaryStory::where('is_approved', true)
                        ->where('id', '>', $story->id)
                        ->orderBy('id')
                        ->first();
                @endphp

                @if($prevStory || $nextStory)
                <div class="th-pagination">
                    <ul>
                        @if($prevStory)
                        <li>
                            <a href="{{ route('stories.show', $prevStory) }}">
                                <i class="fa-solid fa-arrow-right me-1"></i>القصة السابقة
                            </a>
                        </li>
                        @endif

                        @if($nextStory)
                        <li>
                            <a href="{{ route('stories.show', $nextStory) }}">
                                القصة التالية<i class="fa-solid fa-arrow-left ms-1"></i>
                            </a>
                        </li>
                        @endif
                    </ul>
                </div>
                @endif

                <!-- هل كان المحتوى مفيداً -->
                <div class="as-comments-wrapper">
                    <div class="bg-smoke">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="comment-form mb-0">
                                    <div class="like-dislike-container text-center">
                                        <h5>هل كانت هذه القصة ملهمة؟</h5>
                                        <div class="like-dislike-btns mt-3">
                                            <button class="like-btn" onclick="alert('شكراً لتقييمك الإيجابي!')"><i class="fas fa-thumbs-up me-1"></i> نعم، ملهمة</button>
                                            <button class="dislike-btn" onclick="alert('شكراً لملاحظاتك، سنعمل على تحسين المحتوى!')"><i class="fas fa-thumbs-down me-1"></i> لا، غير ملهمة</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- الشريط الجانبي -->
            <div class="col-xxl-4 col-lg-5">
                <aside class="sidebar-area">
                    <!-- البحث -->
                    <div class="widget widget_search">
                        <h3 class="widget_title">بحث في القصص</h3>
                        <form class="search-form" action="{{ route('stories.index') }}" method="GET">
                            <input type="text" placeholder="ابحث هنا..." name="search">
                            <button type="submit"><i class="fas fa-search"></i></button>
                        </form>
                    </div>

                    <!-- قصص أخرى -->
                    @if($relatedStories->count() > 0)
                    <div class="widget">
                        <h3 class="widget_title">قصص أخرى</h3>
                        <div class="recent-post-wrap">
                            @foreach($relatedStories as $relatedStory)
                            <div class="recent-post">
                                @if($relatedStory->hasImage())
                                <div class="media-img">
                                    <a href="{{ route('stories.show', $relatedStory) }}">
                                        <img src="{{ asset('/' . $relatedStory->media_url) }}" alt="{{ $relatedStory->title }}">
                                    </a>
                                </div>
                                @endif
                                <div class="media-body">
                                    <h4 class="post-title">
                                        <a class="text-inherit" href="{{ route('stories.show', $relatedStory) }}">{{ $relatedStory->title }}</a>
                                    </h4>
                                    <div class="recent-post-meta">
                                        <a href="{{ route('stories.show', $relatedStory) }}">
                                            <i class="fa-regular fa-calendar"></i>{{ $relatedStory->created_at->format('Y-m-d') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- إضافة قصتك -->
                    <div class="widget-banner">
                        <div class="banner-content">
                            <h3>لديك قصة مؤثرة؟</h3>
                            <p>شارك قصتك مع مجتمعنا وألهم الآخرين</p>
                            <a href="{{ route('stories.create') }}" class="th-btn">شارك قصتك الآن</a>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</section>

<style>
/* تنسيقات القصة */
.blog-date {
    position: absolute;
    bottom: 20px;
    right: 20px;
    background-color: var(--theme-color);
    color: white;
    padding: 10px 15px;
    border-radius: 5px;
    text-align: center;
    font-weight: bold;
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

.blog-date span {
    display: block;
    font-size: 14px;
}

.share-links {
    margin-top: 30px;
    padding-top: 20px;
    border-top: 1px solid #eee;
}

.share-links-title {
    font-weight: 700;
    margin-left: 10px;
    font-size: 18px;
    color: var(--title-color);
}

.social-links {
    display: inline-flex;
    gap: 10px;
    padding: 0;
    margin: 0;
    list-style: none;
}

.social-links li a {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background-color: var(--theme-color);
    color: white;
    transition: all 0.3s ease;
}

.social-links li a:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.social-facebook { background-color: #3b5998; }
.social-twitter { background-color: #1da1f2; }
.social-whatsapp { background-color: #25d366; }
.social-linkedin { background-color: #0077b5; }

.like-dislike-container {
    padding: 20px;
    border-radius: 10px;
    margin: 30px 0;
}

.like-dislike-btns {
    display: flex;
    justify-content: center;
    gap: 15px;
}

.like-btn, .dislike-btn {
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: all 0.3s ease;
    font-weight: 600;
}

.like-btn {
    background-color: #e1f5e9;
    color: #28a745;
}

.dislike-btn {
    background-color: #f8d7da;
    color: #dc3545;
}

.like-btn:hover, .dislike-btn:hover {
    transform: translateY(-2px);
}

.th-pagination {
    margin-top: 30px;
    margin-bottom: 30px;
}

.th-pagination ul {
    display: flex;
    justify-content: space-between;
    padding: 0;
    margin: 0;
    list-style: none;
}

.th-pagination ul li a {
    display: inline-block;
    padding: 10px 20px;
    border-radius: 5px;
    background-color: #f5f5f5;
    color: var(--title-color);
    font-weight: 600;
    transition: all 0.3s ease;
}

.th-pagination ul li a:hover {
    background-color: var(--theme-color);
    color: white;
}

/* تنسيقات معلومات الكاتب */
.author-info-box {
    display: flex;
    align-items: center;
    margin: 20px 0;
    padding: 15px;
    background-color: #f8f9fa;
    border-radius: 10px;
}

.author-image {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    overflow: hidden;
    margin-left: 20px;
    box-shadow: 0 3px 10px rgba(0,0,0,0.1);
}

.author-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.author-name {
    margin: 0 0 5px 0;
    font-size: 18px;
    color: var(--title-color);
}

.author-bio {
    margin: 0;
    color: #777;
    font-size: 14px;
}

/* تنسيقات الفيديو */
.video-container {
    position: relative;
    width: 100%;
    padding-bottom: 56.25%; /* نسبة 16:9 */
    height: 0;
    overflow: hidden;
}

.video-container iframe,
.video-container video {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}

/* تنسيقات أزرار التحكم */
.story-actions-box {
    margin-top: 30px;
    padding: 20px;
    background-color: #f8f9fa;
    border-radius: 10px;
    border-left: 3px solid var(--theme-color);
}

.danger-btn {
    color: #dc3545 !important;
    border-color: #dc3545 !important;
}

.danger-btn:hover {
    background-color: #dc3545 !important;
    color: white !important;
}

.awaiting-approval {
    display: inline-block;
    margin-top: 15px;
    padding: 5px 15px;
    background-color: #ffeeba;
    color: #856404;
    border-radius: 5px;
    font-size: 14px;
}

/* تنسيقات البانر الجانبي */
.widget-banner {
    background-color: var(--theme-color);
    padding: 30px 25px;
    border-radius: 10px;
    text-align: center;
    position: relative;
    overflow: hidden;
    color: white;
}

.widget-banner:before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: url("{{ asset('assets2/img/shape/pattern-1.png') }}");
    opacity: 0.1;
}

.widget-banner h3 {
    color: white;
    margin-bottom: 10px;
    font-size: 22px;
}

.widget-banner p {
    margin-bottom: 20px;
    color: rgba(255, 255, 255, 0.9);
}

.widget-banner .th-btn {
    background-color: white;
    color: var(--theme-color);
}

.widget-banner .th-btn:hover {
    background-color: var(--title-color);
    color: white;
}
</style>
@endsection
