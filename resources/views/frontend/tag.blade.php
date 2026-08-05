@extends('layouts.frontend')

@section('title', $tag->title)

@section('content')

<link rel="stylesheet" href="{{ asset('css/frontend/blog.css') }}">

<header>

    <div class="header-content">

        <h1>{{ __('messages.tag_page_title') }} : {{ $tag->title }}</h1>

        <div class="line"></div>

        <div class="subtitle">
            {{ __('messages.tag_page_subtitle') }}
            <b>{{ $tag->title }}</b>.
        </div>

    </div>

</header>

<section class="title-bar">

    <div>
        <p>
            {{ $blogs->count() }}
            {{ __('messages.tag_article_count') }}
        </p>

    </div>

</section>

<section class="artikel">

@forelse($blogs as $blog)

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

@empty

<div style="grid-column:1/-1;text-align:center;padding:80px">

<h2>{{ __('messages.tag_no_article') }}</h2>

</div>

@endforelse

</section>

@endsection