@extends('layouts.frontend')
@section('title', 'blog')
@section('content')

<link rel="stylesheet" href="{{ asset('css/frontend/album.css') }}">

<!-- ================= HEADER ================= -->
<Header>
      <div class="header-content">
            <h1>{{ __('messages.album_page_title') }}</h1>
            <div class="line"></div>
            <div class="subtitle">{{ __('messages.album_page_subtitle') }}</div>
      </div>
</Header>


<!-- ================= Album ================= -->
<div class="title">{{ __('messages.album_all_title') }}</div>

<section class="album">

@foreach($albums as $album)

<a href="{{ route('albumDetail', $album->slug) }}">

<div class="album-card">

    <div class="img">
        <img src="{{ asset($album->img) }}">
    </div>

    <div class="album-content">

        <div class="album-title">
            {{ $album->title }}
        </div>

        <div class="info">

            <div class="album-date">

                <i class="fa-regular fa-calendar"></i>

                <span>
                    {{ \Carbon\Carbon::parse($album->date)->translatedFormat('d F Y') }}
                </span>

            </div>

            <div class="photo-count">

                <i class="fa-regular fa-image"></i>

                <span>
                    {{ $album->fotos_count }} {{ __('messages.album_photo_count') }}
                </span>

            </div>

        </div>

    </div>

</div>

</a>

@endforeach

</section>

@endsection