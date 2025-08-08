@extends('frontend.layouts.app')

@section('title', $page->meta_title ?: $page->translated_title)

@section('meta_description', $page->meta_description ?: strip_tags(substr($page->translated_content, 0, 160)))

@section('content')
    <!-- صورة الخلفية والعنوان -->
    <div class="breadcumb-wrapper" data-bg-src="{{ asset('assets2') }}/img/bg/breadcumb-bg.jpg" data-overlay="theme">
        <div class="container">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title">{{ $page->translated_title }}</h1>
                <ul class="breadcumb-menu">
                    <li><a href="{{ route('home') }}"><i class="fa-solid fa-house me-1"></i>{{ app()->getLocale() === 'ar' ? 'الرئيسية' : 'Home' }}</a></li>
                    <li>{{ $page->translated_title }}</li>
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
                        @if ($page->featured_image)
                            <div class="blog-img">
                                <img src="{{ asset('/' . $page->featured_image) }}" alt="{{ $page->translated_title }}"
                                    class="w-100">
                                <div class="blog-date">
                                    <i class="fa-regular fa-calendar-days"></i>
                                    {{ $page->created_at->format('d') }}
                                    <span>{{ $page->created_at->translatedFormat('M') }}</span>
                                </div>
                            </div>
                        @endif

                        <!-- محتوى الصفحة -->
                        <div class="blog-content">
                            <div class="blog-meta">
                                <a href="#" class="author"><i
                                        class="fa-regular fa-clock me-1"></i>{{ $page->created_at->format('Y-m-d') }}</a>
                                @if ($page->meta_title)
                                    <a href="#"><i class="fa-solid fa-tags me-1"></i>{{ $page->meta_title }}</a>
                                @endif
                            </div>

                            <h2 class="blog-title">{{ $page->translated_title }}</h2>

                            <div class="blog-text">
                                {!! $page->translated_content !!}
                            </div>

                            <!-- شارك المحتوى -->
                            <div class="share-links clearfix">
                                <div class="row justify-content-between">
                                    <div class="col-md-auto">
                                        <span class="share-links-title">مشاركة:</span>
                                        <ul class="social-links">
                                            <li>
                                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}"
                                                    target="_blank" class="social-facebook">
                                                    <i class="fab fa-facebook-f"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="https://twitter.com/intent/tweet?url={{ url()->current() }}&text={{ $page->title }}"
                                                    target="_blank" class="social-twitter">
                                                    <i class="fab fa-twitter"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="https://wa.me/?text={{ $page->title }} {{ url()->current() }}"
                                                    target="_blank" class="social-whatsapp">
                                                    <i class="fab fa-whatsapp"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ url()->current() }}&title={{ $page->title }}"
                                                    target="_blank" class="social-linkedin">
                                                    <i class="fab fa-linkedin-in"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- روابط التنقل بين الصفحات -->
                    @php
                        $prevPage = \App\Models\Page::where('is_active', true)
                            ->where('id', '<', $page->id)
                            ->orderBy('id', 'desc')
                            ->first();

                        $nextPage = \App\Models\Page::where('is_active', true)
                            ->where('id', '>', $page->id)
                            ->orderBy('id')
                            ->first();
                    @endphp

                    @if ($prevPage || $nextPage)
                        <div class="th-pagination">
                            <ul>
                                @if ($prevPage)
                                    <li>
                                        <a href="{{ route('pages.show', $prevPage->slug) }}">
                                            <i class="fa-solid fa-arrow-right me-1"></i>الصفحة السابقة
                                        </a>
                                    </li>
                                @endif

                                @if ($nextPage)
                                    <li>
                                        <a href="{{ route('pages.show', $nextPage->slug) }}">
                                            الصفحة التالية<i class="fa-solid fa-arrow-left ms-1"></i>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    @endif

                    <!-- التعليقات أو المزيد من المعلومات -->
                    <div class="as-comments-wrapper">
                        <div class="bg-smoke">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="comment-form mb-0">
                                        <div class="like-dislike-container text-center">
                                            <h5>هل كان هذا المحتوى مفيداً؟</h5>
                                            <div class="like-dislike-btns mt-3">
                                                <button class="like-btn" onclick="alert('شكراً لتقييمك الإيجابي!')"><i
                                                        class="fas fa-thumbs-up me-1"></i> نعم، مفيد</button>
                                                <button class="dislike-btn"
                                                    onclick="alert('شكراً لملاحظاتك، سنعمل على تحسين المحتوى!')"><i
                                                        class="fas fa-thumbs-down me-1"></i> لا، غير مفيد</button>
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
                            <h3 class="widget_title">بحث في الموقع</h3>
                            <form class="search-form">
                                <input type="text" placeholder="ابحث هنا..." name="s" id="s">
                                <button type="submit"><i class="fas fa-search"></i></button>
                            </form>
                        </div>

                        <!-- صفحات أخرى -->
                        <div class="widget">
                            <h3 class="widget_title">صفحات أخرى</h3>
                            <div class="recent-post-wrap">
                                @php
                                    $otherPages = \App\Models\Page::where('id', '!=', $page->id)
                                        ->where('is_active', true)
                                        ->orderBy('sort_order')
                                        ->limit(5)
                                        ->get();
                                @endphp

                                @if ($otherPages->count() > 0)
                                    @foreach ($otherPages as $otherPage)
                                        <div class="recent-post">
                                            @if ($otherPage->featured_image)
                                                <div class="media-img">
                                                    <a href="{{ route('pages.show', $otherPage->slug) }}">
                                                        <img src="{{ asset('/' . $otherPage->featured_image) }}"
                                                            alt="{{ $otherPage->title }}">
                                                    </a>
                                                </div>
                                            @endif
                                            <div class="media-body">
                                                <h4 class="post-title">
                                                    <a class="text-inherit"
                                                        href="{{ route('pages.show', $otherPage->slug) }}">{{ $otherPage->title }}</a>
                                                </h4>
                                                <div class="recent-post-meta">
                                                    <a href="{{ route('pages.show', $otherPage->slug) }}">
                                                        <i
                                                            class="fa-regular fa-calendar"></i>{{ $otherPage->created_at->format('Y-m-d') }}
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <p class="text-muted">لا توجد صفحات أخرى</p>
                                @endif
                            </div>
                        </div>

                        <!-- وسوم محتملة -->
                        <div class="widget widget_tag_cloud">
                            <h3 class="widget_title">الأقسام</h3>
                            <div class="tagcloud">
                                <a href="{{ route('home') }}">الرئيسية</a>
                                <a href="{{ route('food-donations.index') }}">التبرعات</a>
                                <a href="{{ route('contact.index') }}">الدعم الفني</a>
                                @foreach ($otherPages->take(3) as $tagPage)
                                    <a href="{{ route('pages.show', $tagPage->slug) }}">{{ $tagPage->title }}</a>
                                @endforeach
                            </div>
                        </div>

                        <!-- تواصل معنا -->
                        <div class="widget widget_contact">
                            <h3 class="widget_title">تواصل معنا</h3>
                            <div class="th-widget">
                                <div class="contact-card">
                                    <div class="contact-icon">
                                        <i class="fas fa-location-dot"></i>
                                    </div>
                                    <div class="contact-content">
                                        <h5>العنوان</h5>
                                        <p>{{ $settings->address }}</p>
                                    </div>
                                </div>
                                <div class="contact-card">
                                    <div class="contact-icon">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                    <div class="contact-content">
                                        <h5>رقم الهاتف</h5>
                                        <p><a href="tel:{{ $settings->phone }}">{{ $settings->phone }}</a></p>
                                    </div>
                                </div>
                                <div class="contact-card">
                                    <div class="contact-icon">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div class="contact-content">
                                        <h5>البريد الإلكتروني</h5>
                                        <p><a href="mailto:{{ $settings->email }}">{{ $settings->email }}</a></p>
                                    </div>
                                </div>
                            </div>
                            <div class="contact-social">
                                <a href="{{ $settings->facebook_link }}" class="social-btn facebook-btn" title="فيسبوك"><i class="fab fa-facebook-f"></i></a>
                                <a href="{{ $settings->twitter_link }}" class="social-btn twitter-btn" title="تويتر"><i class="fab fa-twitter"></i></a>
                                <a href="{{ $settings->linkedin_link }}" class="social-btn linkedin-btn" title="لينكد إن"><i class="fab fa-linkedin-in"></i></a>
                                <a href="{{ $settings->youtube_link }}" class="social-btn youtube-btn" title="يوتيوب"><i class="fab fa-youtube"></i></a>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </section>

    <style>
        /* تنسيقات إضافية للتحسين */
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
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
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
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .social-facebook {
            background-color: #3b5998;
        }

        .social-twitter {
            background-color: #1da1f2;
        }

        .social-whatsapp {
            background-color: #25d366;
        }

        .social-linkedin {
            background-color: #0077b5;
        }

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

        .like-btn,
        .dislike-btn {
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

        .like-btn:hover,
        .dislike-btn:hover {
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

        /* تنسيقات قسم تواصل معنا */
        .contact-card {
            display: flex;
            align-items: flex-start;
            margin-bottom: 15px;
            padding: 15px;
            border-radius: 10px;
            background-color: #f9f9f9;
            transition: all 0.3s ease;
        }

        .contact-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            background-color: white;
        }

        .contact-icon {
            width: 45px;
            height: 45px;
            background-color: var(--theme-color);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-left: 15px;
            flex-shrink: 0;
        }

        .contact-content {
            flex-grow: 1;
        }

        .contact-content h5 {
            margin: 0 0 5px 0;
            font-size: 16px;
            color: var(--title-color);
        }

        .contact-content p, .contact-content a {
            margin: 0;
            color: var(--body-color);
            font-size: 14px;
            transition: color 0.3s ease;
        }

        .contact-content a:hover {
            color: var(--theme-color);
        }

        .contact-social {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 20px;
        }

        .social-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            transition: all 0.3s ease;
        }

        .social-btn:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.15);
        }

        .facebook-btn { background-color: #3b5998; }
        .twitter-btn { background-color: #1da1f2; }
        .linkedin-btn { background-color: #0077b5; }
        .youtube-btn { background-color: #ff0000; }
    </style>
@endsection
