@extends('layouts.frontend')
@section('title', 'Blog')
@section('content')

<link rel="stylesheet" href="{{ asset('css/frontend/blog.css') }}">

<!-- ================= HEADER ================= -->

<header>
    <div class="header-content">
        <h1>{{ __('messages.blog_page_title') }}</h1>
        <div class="line"></div>

        <div class="subtitle">
            {{ __('messages.blog_page_subtitle') }}
        </div>

    </div>
</header>

<!-- ================= Artikel ================= -->

<div class="title-bar">

    <div class="title">
        {{ __('messages.blog_all_title') }}
    </div>

    <form action="{{ route('blog') }}" method="GET" class="search-form">

        <input type="text" name="search" placeholder="{{ __('messages.blog_search_placeholder') }}" value="{{ request('search') }}">

        <button type="submit">
            <i class="fa-solid fa-magnifying-glass"></i>
        </button>

    </form>

</div>

<section class="artikel">

@foreach($blogs as $blog)

<a href="{{ route('blogDetail', $blog->slug) }}" class="card-link">

    <div class="card-artikel">

        <div class="img">

            <img src="{{ asset($blog->img) }}" alt="{{ $blog->title }}">

            <div class="category">

                {{ $blog->category->title }}

            </div>

        </div>

        <div class="artikel-content">

            <div class="artikel-date">

                <i class="fa-regular fa-calendar-days"></i>

                <span>

                    {{ \Carbon\Carbon::parse($blog->date)->translatedFormat('d F Y') }}

                </span>

            </div>

            <div class="artikel-title">

                {{ $blog->title }}

            </div>

            <div class="ringkasan">

                {{ $blog->caption }}

            </div>

            <div class="read-more">

                {{ __('messages.blog_read_more') }}

                <i class="fa-solid fa-arrow-right"></i>

            </div>

        </div>

    </div>

</a>

@endforeach

</section>

@endsection