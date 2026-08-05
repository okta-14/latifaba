@php
    $pengaturan = \App\Models\Pengaturan::first();

    $wa = '';

    if ($pengaturan && $pengaturan->phone) {
        $wa = preg_replace('/[^0-9]/', '', $pengaturan->phone);

        if (substr($wa, 0, 1) == '0') {
            $wa = '62' . substr($wa, 1);
        }
    }
@endphp

@extends('layouts.frontend')
@section('title', 'Home')

@section('content')

<link rel="stylesheet" href="{{ asset('css/frontend/homed.css') }}">

<!-- ================= HEADER ================= -->
<header>

    <div class="header-content">

        <h1 class="blue">{{ __('messages.home_hero_title_1') }}</h1>
        <h1 class="red">{{ __('messages.home_hero_title_2') }}</h1>

        <p>{{ __('messages.home_hero_subtitle') }}</p>

        <div class="header-button">

            <button class="btn-blue">
                <a href="#about">{{ __('messages.home_hero_more') }}</a>
                <i class="fa-solid fa-arrow-right"></i>
            </button>

            @if($wa)
        <button class="btn-red">
            <a href="https://wa.me/{{ $wa }}" target="_blank">
                {{ __('messages.home_hero_contact') }}
            </a>
            <i class="fa-solid fa-phone"></i>
        </button>
        @else
            <button class="btn-red">
                <a href="#footer">
                    {{ __('messages.home_hero_contact') }}
                </a>
                <i class="fa-solid fa-phone"></i>
            </button>
        @endif

        </div>

    </div>

</header>

<!-- ================= ABOUT ================= -->

<section class="about" id="about">
      <div class="img"><img src="{{ asset('images/about.png') }}" alt=""></div>
      <div class="content">
            <h5>{{ __('messages.home_about_title') }}</h5>

            <div class="line"></div>

            <p>{{ __('messages.home_about_text') }}</p>

      </div>
</section>

<!-- ================= GROUP ================= -->
<div class="home-member-title">
    <h2>{{ __('messages.home_members_title') }}</h2>
</div>
<section class="group">

    <div class="business-list">

        @foreach($members as $member)

            <a
                href="{{ $member->url ?: '#' }}"
                class="business-card"
                @if($member->url)
                    target="_blank"
                @endif
            >

                <img
                    src="{{ asset($member->image) }}"
                    alt="{{ $member->title }}"
                >

                <h3>{{ $member->title }}</h3>

            </a>

        @endforeach

    </div>

</section>

<!-- ================================================================
     PROJECT (PROGRAM KAMI)
================================================================ -->

<div class="content-project">
    <h2>{{ __('messages.home_program_title') }}</h2>
</div>

<section class="project">

    <div class="project-container">

        @forelse($programs as $program)

            <a href="{{ route('program') }}" class="project-link">

                <div class="project-card">

                    <div class="project-image">
                        <img
                            src="{{ $program->img ? asset($program->img) : asset('images/homed.png') }}"
                            alt="{{ $program->title }}">
                    </div>

                    <div class="project-body">

                        <h3 class="project-title">
                            {{ $program->title }}
                        </h3>

                        <p class="project-content">
                            {{ \Illuminate\Support\Str::limit(strip_tags($program->content), 120) }}
                        </p>

                        <span class="project-btn">
                            {{ __('messages.home_see_more') }}
                        </span>

                    </div>

                </div>

            </a>

        @empty

            <p class="text-center w-100">{{ __('messages.home_no_program') }}</p>

        @endforelse

    </div>

</section>


<!-- ================= NEWS (BLOG) ================= -->
<section class="news-section">

    <div class="section-header">
        <h2>{{ __('messages.nav_news') }}</h2>
        <a href="{{ route('blog') }}">{{ __('messages.home_view_all') }}</a>
    </div>

    @if($blogs->count() > 0)

        <div class="news-wrapper">

            {{-- Berita Utama (blog terbaru) --}}
            @php
                $featuredBlog = $blogs->first();
                $otherBlogs   = $blogs->slice(1, 3);
            @endphp

            <div class="featured-news">

                <img
                    src="{{ $featuredBlog->img ? asset($featuredBlog->img) : asset('images/news1.jpg') }}"
                    alt="{{ $featuredBlog->title }}">

                <div class="featured-content">

                    <span>
                        {{ \Carbon\Carbon::parse($featuredBlog->date)->translatedFormat('d F Y') }}
                    </span>

                    <h3>
                        {{ $featuredBlog->title }}
                    </h3>

                    <p>
                        {{ \Illuminate\Support\Str::limit(strip_tags($featuredBlog->content), 150) }}
                    </p>

                    <a href="{{ route('blogDetail', $featuredBlog->slug) }}">{{ __('messages.blog_read_more') }} →</a>

                </div>

            </div>

            {{-- Berita lainnya --}}
            <div class="news-list">

                @forelse($otherBlogs as $blog)

                    <a href="{{ route('blogDetail', $blog->slug) }}" class="news-item">

                        <img
                            src="{{ $blog->img ? asset($blog->img) : asset('images/news1.jpg') }}"
                            alt="{{ $blog->title }}">

                        <div>

                            <span>
                                {{ \Carbon\Carbon::parse($blog->date)->translatedFormat('d F Y') }}
                            </span>

                            <h4>
                                {{ $blog->title }}
                            </h4>

                        </div>

                    </a>

                @empty

                    <p>{{ __('messages.home_no_other_news') }}</p>

                @endforelse

            </div>

        </div>

    @else

        <p class="text-center w-100">{{ __('messages.home_no_blog') }}</p>

    @endif

</section>

<!-- ================= REVIEW ================= -->

<section class="review-section">

    <div class="section-header">

        <h2>{{ __('messages.home_review_title') }}</h2>

        <a href="{{ route('review.create') }}" class="review-button">
            <i class="fa-solid fa-pen"></i>
            {{ __('messages.home_review_give') }}
        </a>

    </div>

    {{-- Notifikasi Review --}}
    @if(session('review_success'))
        <div class="review-alert">
            <i class="fa-solid fa-circle-check"></i>

            <span>
                {{ session('review_success') }}
            </span>

        </div>
    @endif

    <div class="review-container">

        @forelse($reviews as $item)

            @php
                $locale = app()->getLocale();

                $nama = $item->nama;

                // Ambil pekerjaan sesuai bahasa
                if (is_array($item->pekerjaan)) {
                    $pekerjaan =
                        $item->pekerjaan[$locale]
                        ?? $item->pekerjaan['id']
                        ?? '';
                } else {
                    $pekerjaan = $item->pekerjaan;
                }

                // Ambil review sesuai bahasa
                if (is_array($item->review)) {
                    $reviewText =
                        $item->review[$locale]
                        ?? $item->review['id']
                        ?? '';
                } else {
                    $reviewText = $item->review;
                }

                $stars = (int) $item->stars;
            @endphp

            <div class="review-card">

                <div class="review-top">

                    <div class="avatar">
                        {{ strtoupper(substr($nama ?? 'U', 0, 1)) }}
                    </div>

                    <div>

                        <h4>{{ $nama }}</h4>

                        <span>{{ $pekerjaan }}</span>

                    </div>

                </div>

                <p>
                    {{ $reviewText }}
                </p>

                <div class="star">

                    @for($i = 1; $i <= 5; $i++)

                        @if($i <= $stars)
                            <span>★</span>
                        @else
                            <span class="empty-star">☆</span>
                        @endif

                    @endfor

                </div>

            </div>

        @empty

            <div class="review-empty">

                <i class="fa-regular fa-comment-dots"></i>

                <p>
                    {{ __('messages.home_no_review') }}
                </p>

                <a href="{{ route('review.create') }}">
                    {{ __('messages.home_be_first_review') }}
                </a>

            </div>

        @endforelse

    </div>

</section>

<!-- ================= VIDEO ================= -->

<section class="video-section">

    <div class="section-header">

        <h2>{{ __('messages.galeri_video_title') }}</h2>

        <a href="{{ route('videofront') }}">{{ __('messages.home_view_all') }}</a>

    </div>

    @if($videos->count() > 0)

        @php
            function getYoutubeThumbnail($source) {
                if (preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/|youtube\.com\/embed\/|youtube\.com\/shorts\/)([A-Za-z0-9_-]{11})/', $source, $match)) {
                    return $match[1];
                }
                return null;
            }

            $mainVideo   = $videos->first();
            $otherVideos = $videos->slice(1, 3);

            $mainYoutubeId = getYoutubeThumbnail($mainVideo->source);
        @endphp

        <div class="video-wrapper">

            <!-- Video Besar -->

            <a href="{{ route('videofront') }}" class="main-video">

                <img
                    src="{{ $mainYoutubeId ? 'https://img.youtube.com/vi/'.$mainYoutubeId.'/hqdefault.jpg' : asset('images/homed.png') }}"
                    alt="{{ $mainVideo->title }}">

                <div class="play-btn">

                    ▶

                </div>

                <div class="video-info">

                    <span>
                        {{ \Carbon\Carbon::parse($mainVideo->date)->translatedFormat('d F Y') }}
                    </span>

                    <h3>

                        {{ $mainVideo->title }}

                    </h3>

                </div>

            </a>

            <!-- Daftar Video -->

            <div class="video-list">

                @forelse($otherVideos as $video)

                    @php
                        $ytId = getYoutubeThumbnail($video->source);
                    @endphp

                    <a href="{{ route('videofront') }}" class="video-item">

                        <img
                            src="{{ $ytId ? 'https://img.youtube.com/vi/'.$ytId.'/hqdefault.jpg' : asset('images/homed.png') }}"
                            alt="{{ $video->title }}">

                        <div>

                            <span>
                                {{ \Carbon\Carbon::parse($video->date)->translatedFormat('d F Y') }}
                            </span>

                            <h4>{{ $video->title }}</h4>

                        </div>

                    </a>

                @empty

                    <p>{{ __('messages.home_no_other_video') }}</p>

                @endforelse

            </div>

        </div>

    @else

        <p class="text-center w-100">{{ __('messages.home_no_video') }}</p>

    @endif

</section>



@endsection