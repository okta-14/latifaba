@php
    $tags = \App\Models\Tags::whereIn(
        'id',
        explode(';', $blog->tags)
    )->get();
@endphp

@extends('layouts.frontend')
@section('title', $blog->title)
@section('content')

<link rel="stylesheet" href="{{ asset('css/frontend/blogDetail.css') }}">

<header>

    <div class="header-content">

        <h6>{{ __('messages.nav_news') }}</h6>

        <div class="line"></div>

    </div>

</header>

<section class="blog-detail">

    <div class="detail-content">

        <div class="img">

            <img src="{{ asset($blog->img) }}" alt="{{ $blog->title }}">

        </div>

        <div class="category">

            {{ $blog->category->title }}

        </div>

        <h1 class="title">

            {{ $blog->title }}

        </h1>

        <div class="project-meta">

            <div class="meta-item">

                <i class="fa-regular fa-calendar-days"></i>

                <span>

                    {{ \Carbon\Carbon::parse($blog->date)->translatedFormat('d F Y') }}

                </span>

            </div>

            <div class="meta-item">

                <i class="fa-regular fa-user"></i>

                <span>{{ __('messages.blog_by_admin') }}</span>

            </div>

            <div class="meta-item">

                <i class="fa-regular fa-eye"></i>

                <span>{{ number_format($blog->hit) }} {{ __('messages.blog_views') }}</span>

            </div>

            @php
            $url = urlencode(request()->fullUrl());
            $title = urlencode($blog->title);
            @endphp

        <div class="share-box">

            <a href="https://www.facebook.com/sharer/sharer.php?u={{ $url }}"
            target="_blank"
            class="share facebook">
                <i class="fa-brands fa-facebook-f"></i>
                <span>{{ __('messages.blog_share') }}</span>
            </a>

            <a href="https://wa.me/?text={{ $title }}%20{{ $url }}"
            target="_blank"
            class="share whatsapp">
                <i class="fa-brands fa-whatsapp"></i>
                <span>{{ __('messages.blog_share') }}</span>
            </a>

            <a href="https://social-plugins.line.me/lineit/share?url={{ $url }}"
            target="_blank"
            class="share line">
                <i class="fa-brands fa-line"></i>
                <span>{{ __('messages.blog_share') }}</span>
            </a>

            <a href="https://t.me/share/url?url={{ $url }}&text={{ $title }}"
            target="_blank"
            class="share telegram">
                <i class="fa-brands fa-telegram"></i>
                <span>{{ __('messages.blog_share') }}</span>
            </a>

            <a href="https://twitter.com/intent/tweet?text={{ $title }}&url={{ $url }}"
            target="_blank"
            class="share twitter">
                <i class="fa-brands fa-x-twitter"></i>
                <span>{{ __('messages.blog_post') }}</span>
            </a>

            <button class="share copy-link" onclick="copyLink()">
                <i class="fa-solid fa-share-nodes"></i>
            </button>

        </div>

        </div>

        <div class="text">

            {!! $blog->content !!}

        </div>


    </div>



    <aside class="other">

        <!-- SEARCH -->
    <div class="search-wrapper">

        <form action="{{ route('blog') }}" method="GET" class="search-form">

            <input type="text" name="search" placeholder="{{ __('messages.blog_search_placeholder') }}" value="{{ request('search') }}">

            <button type="submit">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>

        </form>

    </div>

        <!-- BERITA TERBARU -->

        <div class="card-sidebar">

            <h3>{{ __('messages.blog_latest_news') }}</h3>

            <div class="line"></div>

            <div class="latest-news">

                @forelse($latestBlogs as $latest)

                    <a href="{{ route('blogDetail', $latest->slug) }}" class="latest-item">

                        <div class="latest-img">
                            <img src="{{ asset($latest->img) }}" alt="{{ $latest->title }}">
                        </div>

                        <div class="latest-title">
                            {{ Str::limit($latest->title, 80) }}
                        </div>

                    </a>

                @empty

                    <p class="empty-text">{{ __('messages.blog_no_other_news') }}</p>

                @endforelse

            </div>

        </div>


        <!-- TAG -->

        <div class="card-sidebar">

            <h3>{{ __('messages.blog_tag') }}</h3>

            <div class="line"></div>

        <div class="tag-content">

            @foreach($tags as $tag)

                <a href="{{ route('tag', $tag->slug) }}">
                    <span>{{ $tag->title }}</span>
                </a>

            @endforeach

        </div>

        </div>



        <!-- KEYWORD -->

        <div class="card-sidebar">

            <h3>{{ __('messages.blog_keyword') }}</h3>

            <div class="line"></div>

            <div class="tag-content">

                @foreach(explode(',', $blog->keyword) as $keyword)

                    <span>{{ trim($keyword) }}</span>

                @endforeach

            </div>

        </div>

    </aside>

</section>

    <script>
    function copyLink(){

        navigator.clipboard.writeText(window.location.href);

        alert("{{ __('messages.blog_link_copied') }}");
    }
    </script>

@endsection