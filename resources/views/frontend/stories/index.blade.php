@extends('frontend.layouts.app')

@section('title', 'قصص المستفيدين')
@section('meta_description', 'قصص ملهمة من مستفيدي منصة عطاء الخيرية')

@section('content')
<!-- صورة الخلفية والعنوان -->
<div class="breadcumb-wrapper" data-bg-src="{{ asset('assets2') }}/img/bg/breadcumb-bg.jpg" data-overlay="theme">
    <div class="container">
        <div class="breadcumb-content">
            <h1 class="breadcumb-title">قصص المستفيدين</h1>
            <ul class="breadcumb-menu">
                <li><a href="{{ route('home') }}"><i class="fa-solid fa-house me-1"></i>الرئيسية</a></li>
                <li>قصص المستفيدين</li>
            </ul>
        </div>
    </div>
</div>

<!-- القسم الرئيسي -->
<section class="space">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <div class="title-area">
                    <span class="sub-title">قصص نجاح ملهمة</span>
                    <h2 class="sec-title">تجارب حقيقية من المستفيدين</h2>
                    <p class="sec-text">اقرأ القصص المؤثرة التي تروي تجارب المستفيدين من خدماتنا وكيف أحدثت المساعدات فرقًا في حياتهم.</p>
                </div>
                @auth
                <div class="mt-4">
                    <a href="{{ route('stories.create') }}" class="th-btn">
                        <i class="fa fa-plus me-2"></i> شارك قصتك
                    </a>
                    <a href="{{ route('stories.my-stories') }}" class="th-btn style-border ms-2">
                        <i class="fa fa-user me-2"></i> قصصي
                    </a>
                </div>
                @else
                <div class="mt-4">
                    <a href="{{ route('login') }}" class="th-btn">
                        <i class="fa fa-sign-in me-2"></i> سجل دخول لمشاركة قصتك
                    </a>
                </div>
                @endauth
            </div>
        </div>

        <!-- القصص المميزة -->
        @php
            $featuredStories = $stories->where('is_featured', true)->take(2);
            $regularStories = $stories->where('is_featured', false);
        @endphp

        @if($featuredStories->count() > 0)
        <div class="featured-stories-section mb-5">
            <h3 class="featured-stories-title"><i class="fas fa-star text-warning me-2"></i>قصص مميزة</h3>
            <div class="row">
                @foreach($featuredStories as $story)
                <div class="col-lg-6 mb-4">
                    <div class="featured-story-card">
                        @if($story->hasImage())
                        <div class="story-media">
                            <img src="{{ asset('/' . $story->media_url) }}" alt="{{ $story->title }}" class="img-fluid">
                            <div class="featured-badge">
                                <i class="fas fa-star"></i> قصة مميزة
                            </div>
                        </div>
                        @elseif($story->hasVideo())
                        <div class="story-media">
                            <div class="ratio ratio-16x9">
                                @if(Str::contains($story->media_url, ['youtube', 'youtu.be']))
                                    <iframe src="{{ $story->media_url }}" allowfullscreen></iframe>
                                @else
                                    <video controls>
                                        <source src="{{ asset('/' . $story->media_url) }}" type="video/mp4">
                                        متصفحك لا يدعم تشغيل الفيديو.
                                    </video>
                                @endif
                            </div>
                            <div class="featured-badge">
                                <i class="fas fa-star"></i> قصة مميزة
                            </div>
                        </div>
                        @endif
                        <div class="story-content">
                            <div class="author-info">
                                <div class="author-image">
                                    @if($story->author_image)
                                    <img src="{{ asset('/' . $story->author_image) }}" alt="{{ $story->author_name }}">
                                    @else
                                    <img src="{{ asset('assets2/img/blog/author1.png') }}" alt="{{ $story->author_name }}">
                                    @endif
                                </div>
                                <div class="author-details">
                                    <h5 class="author-name">{{ $story->author_name }}</h5>
                                    @if($story->location)
                                    <p class="location"><i class="fas fa-map-marker-alt me-1"></i>{{ $story->location }}</p>
                                    @endif
                                </div>
                            </div>
                            <h3 class="story-title"><a href="{{ route('stories.show', $story) }}">{{ $story->title }}</a></h3>
                            <p class="story-excerpt">{{ Str::limit(strip_tags($story->content), 150) }}</p>
                            <div class="story-meta">
                                <span class="date"><i class="far fa-calendar-alt me-1"></i>{{ $story->created_at->format('Y-m-d') }}</span>
                                @if($story->project_name)
                                <span class="project"><i class="fas fa-project-diagram me-1"></i>{{ $story->project_name }}</span>
                                @endif
                            </div>
                            <a href="{{ route('stories.show', $story) }}" class="read-more-btn">اقرأ المزيد <i class="fas fa-arrow-left ms-2"></i></a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- القصص العادية -->
        <div class="row">
            @forelse($regularStories as $story)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="story-card">
                    @if($story->hasImage())
                    <div class="story-media">
                        <img src="{{ asset('/' . $story->media_url) }}" alt="{{ $story->title }}" class="img-fluid">
                    </div>
                    @elseif($story->hasVideo())
                    <div class="story-media video-media">
                        <div class="play-icon">
                            <i class="fas fa-play"></i>
                        </div>
                        <img src="{{ asset('assets2/img/blog/blog_3_3.jpg') }}" alt="{{ $story->title }}" class="img-fluid">
                    </div>
                    @endif
                    <div class="story-content">
                        <div class="author-info">
                            <div class="author-image">
                                @if($story->author_image)
                                <img src="{{ asset('/' . $story->author_image) }}" alt="{{ $story->author_name }}">
                                @else
                                <img src="{{ asset('assets2/img/blog/author1.png') }}" alt="{{ $story->author_name }}">
                                @endif
                            </div>
                            <div class="author-details">
                                <h5 class="author-name">{{ $story->author_name }}</h5>
                                @if($story->location)
                                <p class="location"><i class="fas fa-map-marker-alt me-1"></i>{{ $story->location }}</p>
                                @endif
                            </div>
                        </div>
                        <h3 class="story-title"><a href="{{ route('stories.show', $story) }}">{{ $story->title }}</a></h3>
                        <p class="story-excerpt">{{ Str::limit(strip_tags($story->content), 100) }}</p>
                        <div class="story-meta">
                            <span class="date"><i class="far fa-calendar-alt me-1"></i>{{ $story->created_at->format('Y-m-d') }}</span>
                            @if($story->project_name)
                            <span class="project"><i class="fas fa-project-diagram me-1"></i>{{ $story->project_name }}</span>
                            @endif
                        </div>
                        <a href="{{ route('stories.show', $story) }}" class="read-more-btn">اقرأ المزيد <i class="fas fa-arrow-left ms-2"></i></a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center">
                <div class="no-stories">
                    <img src="{{ asset('assets2/img/normal/no-data.svg') }}" alt="لا توجد قصص" style="max-width: 200px;">
                    <h3 class="mt-4">لا توجد قصص حالياً</h3>
                    <p>كن أول من يشارك قصته المؤثرة مع الآخرين</p>
                    <a href="{{ route('stories.create') }}" class="th-btn mt-3">
                        <i class="fa fa-plus me-2"></i> شارك قصتك
                    </a>
                </div>
            </div>
            @endforelse
        </div>

        <!-- ترقيم الصفحات -->
        <div class="row">
            <div class="col-12">
                <div class="pagination-wrapper">
                    {{ $stories->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</section>

<style>
/* تنسيقات قسم القصص */
.featured-stories-title {
    font-size: 24px;
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 2px solid var(--theme-color);
}

.featured-story-card {
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    height: 100%;
    background-color: #fff;
}

.featured-story-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.15);
}

.story-card {
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    height: 100%;
    background-color: #fff;
}

.story-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.12);
}

.story-media {
    position: relative;
    height: 220px;
    overflow: hidden;
}

.story-media img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.story-card:hover .story-media img,
.featured-story-card:hover .story-media img {
    transform: scale(1.05);
}

.featured-badge {
    position: absolute;
    top: 10px;
    right: 10px;
    background-color: var(--theme-color);
    color: white;
    padding: 5px 10px;
    border-radius: 5px;
    font-size: 12px;
    font-weight: bold;
    z-index: 1;
}

.video-media .play-icon {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 60px;
    height: 60px;
    background-color: rgba(255,255,255,0.9);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    z-index: 1;
}

.video-media .play-icon i {
    color: var(--theme-color);
    font-size: 24px;
    margin-left: 4px;
}

.story-content {
    padding: 20px;
}

.author-info {
    display: flex;
    align-items: center;
    margin-bottom: 15px;
}

.author-image {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    overflow: hidden;
    margin-left: 12px;
}

.author-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.author-name {
    margin: 0;
    font-size: 16px;
    font-weight: 600;
    color: var(--title-color);
}

.location {
    font-size: 12px;
    margin: 5px 0 0 0;
    color: var(--body-color);
}

.story-title {
    font-size: 18px;
    margin-bottom: 10px;
    line-height: 1.4;
}

.story-title a {
    color: var(--title-color);
    text-decoration: none;
    transition: color 0.3s ease;
}

.story-title a:hover {
    color: var(--theme-color);
}

.story-excerpt {
    font-size: 14px;
    color: var(--body-color);
    margin-bottom: 15px;
    line-height: 1.6;
}

.story-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
    margin-bottom: 15px;
    font-size: 13px;
    color: #777;
}

.read-more-btn {
    display: inline-block;
    color: var(--theme-color);
    font-weight: 600;
    font-size: 14px;
    text-decoration: none;
    transition: all 0.3s ease;
}

.read-more-btn:hover {
    color: var(--title-color);
    transform: translateX(-5px);
}

.no-stories {
    padding: 40px 20px;
    text-align: center;
}

.pagination-wrapper {
    margin-top: 40px;
    display: flex;
    justify-content: center;
}
</style>
@endsection
